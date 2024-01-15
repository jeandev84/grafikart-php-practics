<?php

use App\Entity\Image;


/**
 * ImageService helper with automatic image resize and cache
 *
 * @author Roman Ozana, ozana@omdesign.cz
 * @link www.omdesign.cz
 *
 *
 * add to presenter before render function
 *
 * $this->template->registerHelper('resize', 'ImageHelper::resize');
 * $this->template->registerHelper('resize', 'ImageHelper::gallery');
 *
 * in template
 * {= 'media/image.jpg'|resize:40}
 * {= 'media/image.jpg'|resize:?x20}
 * {= 'media/image.jpg'|resize:40:'alt'}
 * {= 'media/image.jpg'|resize:40:'alt':'title'}
 *
 * gallery link
 * {= 'media/image.jpg'|gallery}
 *
 */
abstract class ImageHelper
{
    /**
     * Set yout folder in public WWW_DIR directory
     */
    const cache_dir = 'cache';


    /**
     * Helper for simple image tag with resize
     *
     * @param string $filename
     * @param int $width
     * @param int $height
     */
    public static function resize($filename, $dimensions = '100x?', $alt = null, $title = null)
    {
        $info = pathinfo($filename);

        $title = !is_null($alt) && is_null($title) ? $alt : $title;
        $alt = is_null($alt) ? basename($filename, '.' . $info['extension']) : $alt;

        list($src, $width, $height) = self::resizeImageWithCache($filename, $dimensions);

        return Html::el('img')->src($src)->width($width)->height($height)->alt($alt)->title($title);
    }


    /**
     * Render gallery image with anchor to bigger sized image
     * @param string $filename
     * @param string $dimensions
     * @param string $alt
     * @param string $title
     * @param string $big
     */
    public static function gallery($filename, $alt = null, $title = null, $dimensions = '120x70', $full_dimensions = '640x480')
    {
        $img = self::resize($filename, $dimensions, $alt, $title);
        list($src, $width, $height) = self::resizeImageWithCache($filename, $full_dimensions);
        return Html::el('a')->href($src)->title($title)->add($img);
    }


    /**
     * Resize image and save thumbs to cache
     * @param string $original
     * @param string $dimensions
     * @param string $subfolder
     * @param string $public_root
     * @return array
     */
    public static function resizeImageWithCache($original, $dimensions, $subfolder = 'cache', $public_root = WWW_DIR)
    {
        if (!is_file($public_root . DIRECTORY_SEPARATOR . $original)) {
            return array($original, null, null); // check if file exist
        }

        ////////////////////////////////////////
        // check internal cache for image
        ////////////////////////////////////////

        $cache = Environment::getCache('images');
        $key = md5($original . $dimensions . $subfolder . $public_root);

        if (isset($cache[$key])) {
            return $cache[$key];
        }

        $info = pathinfo($original);

        ////////////////////////////////////////
        // read dimensions
        ////////////////////////////////////////

        $dim = explode('x', $dimensions, null);
        $newWidth = isset($dim[0]) ? $dim[0] : null;
        $newHeight = isset($dim[1]) ? $dim[1] : null;

        ////////////////////////////////////////
        // check public cache directory
        ////////////////////////////////////////

        if (!is_dir($public_root . DIRECTORY_SEPARATOR . $subfolder) || !is_writable($public_root . DIRECTORY_SEPARATOR . $subfolder)) {
            InvalidStateException('Thumbnail path ' . $subfolder . ' does not exists or is not writable.');
        }

        try {

            $cache_path = $subfolder . DIRECTORY_SEPARATOR . md5(dirname($original));
            if (!is_dir($public_root . DIRECTORY_SEPARATOR . $cache_path)) {
                mkdir($public_root . DIRECTORY_SEPARATOR . $cache_path);
            }

            $image = Image::fromFile($public_root . DIRECTORY_SEPARATOR . $original);
            $cache_file = String::webalize(basename($original, '.' . $info['extension']) . '-' . $image->getWidth() . 'x' . $image->getHeight()) . '.' . $info['extension'];
            $image->resize((int)$newWidth, (int)$newHeight)->save($cache_path . DIRECTORY_SEPARATOR . $cache_file);

            ////////////////////////////////////////
            // resize image name
            ////////////////////////////////////////

            $resize = $subfolder . '/' . md5(dirname($original)) . '/' . $cache_file;
            $result = array($resize, $image->getWidth(), $image->getHeight());

            ////////////////////////////////////////
            // save result to internal cache
            ////////////////////////////////////////

            $cache->save($key, $result,
                array('files' => $public_root . DIRECTORY_SEPARATOR . $original)); // 'exire' => time() + 60 * 60)

            return $result;
        } catch (Exception $e) {
            return array($original, null, null);
        }
    }


}