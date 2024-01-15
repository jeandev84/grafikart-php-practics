<?php

/**
 * Image transormation class
 *
 * @author artoodetoo
 */
class ImageHelper
{
    const POS_LEFT          = 1;
    const POS_RIGHT         = 2;
    const POS_TOP           = 4;
    const POS_BOTTOM        = 8;
    const POS_HCENTER       = 3;
    const POS_VCENTER       = 12;
    const POS_CENTER        = 15;
    const POS_BOTTOM_RIGHT  = 10;

    private $fill_color  = 0xFFFFFF;
    private $jpg_quality = 85;
    private $png_quality = 9;
    private $padding     = 5;
    private $image;
    private $width;
    private $height;
    private $type;


    public function __construct(array $options = [], $filename = '')
    {
        foreach ($options as $key => $val) {
            $this->$key = $val;
        }
        if (strlen($filename)) {
            $this->load($filename);
        }
    }

    public function __destruct()
    {
        $this->destroy();
    }

    public function load($filename)
    {
        $this->destroy();
        if (!($size = @getimagesize($filename))) {
            return false;
        }
        $this->type = substr($size['mime'], strpos($size['mime'], '/') + 1);
        $func = 'imagecreatefrom'.$this->type;
        if (!function_exists($func)) {
            return false;
        }
        list($this->width, $this->height) = $size;
        $this->image = $func($filename);

        return $this;
    }

    public function save($filename)
    {
        switch ($this->type) {
            case 'jpeg':
                imagejpeg($this->image, $filename, $this->jpg_quality);
                break;
            case 'png':
                imagepng($this->image, $filename, $this->png_quality, PNG_NO_FILTER);
                break;
            default:
                $func = 'image'.$this->type;
                $func($this->image, $filename);
                break;
        }

        return $this;
    }

    public function render()
    {
        header('Content-Type: image/'.$this->type);
        switch ($this->type) {
            case 'jpeg':
                imagejpeg($this->image, null, $this->jpg_quality);
                break;
            case 'png':
                imagepng($this->image, null, $this->png_quality, PNG_NO_FILTER);
                break;
            default:
                $ifunc = 'image'.$this->type;
                $ifunc($this->image);
                break;
        }

        return $this;
    }

    public function destroy()
    {
        if (isset($this->image)) {
            imagedestroy($this->image);
        }
        unset($this->image, $this->type, $this->width, $this->height);

        return $this;
    }

    /**
     * Fit image to given rectange (no crop)
     * @param int $maxWidth
     * @param int $maxHeight
     * @return \ImageHelper
     */
    public function fit($maxWidth, $maxHeight)
    {
        $k = max($this->width / $maxWidth, $this->height / $maxHeight);
        $newWidth  = floor($this->width  / $k);
        $newHeight = floor($this->height / $k);
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagefill($newImage, 0, 0, $this->fill_color);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $this->width, $this->height);

        imagedestroy($this->image);
        $this->image = $newImage;
        $this->width = $newWidth;
        $this->height = $newHeight;

        return $this;
    }

    /**
     * Cover given rectangle by image (crop when required)
     * @param int $maxWidth
     * @param int $maxHeight
     * @return \ImageHelper
     */
    public function cover($maxWidth, $maxHeight)
    {
        $ratio = $maxWidth / $maxHeight;
        $x = 0;
        $y = 0;
        $w = $this->width;
        $h = $this->height;
        if ($this->width / $ratio <= $this->height) {
            $h = $w / $ratio;
            $y = round(($this->height - $maxHeight * ($this->width / $maxWidth)) / 2);
        } else {
            $w = $h * $ratio;
            $x = round(($this->width - $maxWidth * ($this->height / $maxHeight)) / 2);
        }
        $newImage = imagecreatetruecolor($maxWidth, $maxHeight);
        imagefill($newImage, 0, 0, $this->fill_color);
        imagecopyresampled($newImage, $this->image, 0, 0, $x, $y, $maxWidth, $maxHeight, $w, $h);

        imagedestroy($this->image);
        $this->image = $newImage;
        $this->width = $maxWidth;
        $this->height = $maxHeight;

        return $this;
    }

    /**
     * The same as fit() but crop too wide image
     * @param int $maxWidth
     * @param int $maxHeight
     * @return \ImageHelper
     */
    public function fitToHeight($maxWidth, $maxHeight)
    {
        if ($maxWidth / $maxHeight > $this->width / $this->height) {
            return $this->fit($maxWidth, $maxHeight);
        }
        return $this->cover($maxWidth, $maxHeight);
    }

    /**
     * The same as fit() but crop too high image
     * @param int $maxWidth
     * @param int $maxHeight
     * @return \ImageHelper
     */
    public function fitToWidth($maxWidth, $maxHeight)
    {
        if ($maxWidth / $maxHeight < $this->width / $this->height) {
            return $this->fit($maxWidth, $maxHeight);
        }
        return $this->cover($maxWidth, $maxHeight);
    }

    public function addWatermark(ImageHelper $wm, $pos = self::POS_BOTTOM_RIGHT)
    {
        $wmWidth = $wm->getWidth();
        $wmHeight = $wm->getHeight();
        $x = $y = $this->padding;
        if (($pos & self::POS_HCENTER) == self::POS_HCENTER) {
            $x = ($this->width - $wmWidth) / 2;
        } elseif ($pos & self::POS_RIGHT) {
            $x = $this->width - ($wmWidth + $this->padding);
        }
        if (($pos & self::POS_VCENTER) == self::POS_VCENTER) {
            $y = ($this->height - $wmHeight) / 2;
        } elseif ($pos & self::POS_BOTTOM) {
            $y = $this->height - ($wmHeight + $this->padding);
        }
        imagealphablending($this->image, true);
        imagecopy($this->image, $wm->getImage(), $x, $y, 0, 0, $wmWidth, $wmHeight );

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getImage()
    {
        return $this->image;
    }
}
