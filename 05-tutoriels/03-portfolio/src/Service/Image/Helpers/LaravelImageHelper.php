<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function compressImage($source_path, $quality) 
    {
        $info = getimagesize($source_path);
        $destination_path = 'tmp/tmp.jpg';

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_path);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_path);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_path);

        imagejpeg($image, $destination_path, $quality);

        return $destination_path;
    }

    public static function storagePutTmpFile($storageDirName, $tmp_file)
    {
        $file_path = Storage::disk('local')->putFile($storageDirName, new File($tmp_file));

        return $file_path;
    }

    public static function deleteStorageFile($file_path)
    {
        return Storage::delete($file_path);
    }
}