<?php
declare(strict_types=1);

namespace Grafikart\Service\Image\CackePHP;

/**
 * ImageHelper
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Image\CackePHP
 */
class ImageHelperRefactor
{

    /**
     * @var array|string[]
    */
    public array $helpers = ['Html', 'Form'];


    /**
     * @var int
    */
    public int $quality = 80;



    /**
     * @param string $image
     * @param array $options
     * @return string <img> tag
     */
    public function renderImage(string $image, array $options = []): string
    {
        return sprintf('<img src="%s" alt="">', $image);
    }



    /**
     * @param $image
     * @param $with
     * @param $height
     * @param array $options
     * @return string <img> tag
    */
    public function resize($image, $with, $height, array $options = []): string
    {
         $options['with']   = $with;
         $options['height'] = $height;
         return $this->resize($image, $with, $height);
    }


    /**
     * @param $file
     * @param $width
     * @param $height
     * @return mixed
     */
    public function resizedUrl($file, $width, $height): mixed
    {
        // '_100x100';
        # We find the right file
        $pathinfo = pathinfo(trim($file, '/'));
        $output = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . $width . 'x' . $height . '.' . $pathinfo['extension'];

        if (!file_exists($output)) {

            # Setting defaults and meta
            $info = getimagesize($file);
            list($width_old, $height_old) = $info;


            # Create image resource
            switch ($info[2]) {
                case IMAGETYPE_GIF: $image = imagecreatefromgif($file); break;
                case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file); break;
                case IMAGETYPE_PNG: $image = imagecreatefrompng($file); break;
                default: return false;
            }

            # We find the right ratio to resize the image before cropping
            $height_ratio = $height_old / $height;
            $width_ratio = $width_old / $width;

            $optimal_ratio = $width_ratio;
            if ($height_ratio < $width_ratio) {
                $optimal_ratio = $height_ratio;
            }

            $height_crop = ($height_old / $optimal_ratio);
            $width_crop = ($width_old / $optimal_ratio);


            # The two image resources needed
            # (image resized with the good aspect ratio, and the one with the exact good dimensions)
            $image_crop = imagecreatetruecolor($width_crop, $height_crop);
            $image_resized = imagecreatetruecolor($width, $height);

            # This is the resizing/resampling/transparency-preserving magic
            if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {

                $transparency = imagecolortransparent($image);

                if ($transparency >= 0) {

                    $transparent_color = imagecolorsforindex($image, $trnprt_indx);

                    $transparency = imagecolorallocate(
                        $image_crop,
                        $transparent_color['red'],
                        $transparent_color['green'],
                        $transparent_color['blue']
                    );

                    imagefill($image_crop, 0, 0, $transparency);
                    imagecolortransparent($image_crop, $transparency);

                    imagefill($image_resized, 0, 0, $transparency);
                    imagecolortransparent($image_resized, $transparency);

                } elseif ($info[2] == IMAGETYPE_PNG) {

                    imagealphablending($image_crop, false);
                    imagealphablending($image_resized, false);

                    $color = imagecolorallocatealpha($image_crop, 0, 0, 0, 127);

                    imagefill($image_crop, 0, 0, $color);
                    imagesavealpha($image_crop, true);

                    imagefill($image_resized, 0, 0, $color);
                    imagesavealpha($image_resized, true);
                }
            }

            imagecopyresampled($image_crop, $image, 0, 0, 0, 0, $width_crop, $height_crop, $width_old, $height_old);
            imagecopyresampled(
                $image_resized,
                $image_crop,
                0, 0,
                ($width_crop - $width) / 2,
                ($height_crop - $height) / 2,
                $width, $height, $width, $height);

            # Writing image according to type to the output destination and image quality
            switch ($info[2]) {
                case IMAGETYPE_GIF:
                    imagegif($image_resized, $output, $this->quality);
                    break;
                case IMAGETYPE_JPEG:
                    imagejpeg($image_resized, $output, $this->quality);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($image_resized, $output, $this->quality);
                    break;
                default:
                    return false;
            }
        }

        return true;
    }
}