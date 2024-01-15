<?php
#declare(strict_types=1);

namespace Grafikart\Service\Image;

/**
 * ImageService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\ImageService
 */
class ImageService
{


    /**
     * @var int
    */
    protected int $width = 50;


    /**
     * @var int
    */
    protected int $height = 150;


    /**
     * @var int
    */
    protected int $quality = 80;


    /**
     * @var string
    */
    protected string $source;



    /**
     * @param string $source
    */
    public function __construct(string $source)
    {
         $this->source = $source;
    }



    /**
     * @param int $quality
     * @return $this
    */
    public function quality(int $quality): static
    {
        $this->quality = $quality;

        return $this;
    }


    /**
     * @param int $width
     * @param int $height
     * @return mixed
    */
    public function resize(int $width, int $height): mixed
    {
        // '_100x100';
        # We find the right file
        $pathinfo = pathinfo(rtrim($this->source, '/'));
        $output = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . $width . 'x' . $height . '.' . $pathinfo['extension'];

        # Setting defaults and meta
        $info = getimagesize($this->source);
        list($width_old, $height_old) = $info;

        # Create image resource
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($this->source);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($this->source);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($this->source);
                echo 3;
                break;
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
                $transparency_index = 255;
                $transparent_color  = imagecolorsforindex($image, $transparency_index);

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
                imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image_resized, $output, $this->quality);
                break;
            case IMAGETYPE_PNG:
                imagepng($image_resized, $output, 9);
                break;
            default:
                return false;
        }

        return true;
    }




    public function save(): void
    {

    }

}