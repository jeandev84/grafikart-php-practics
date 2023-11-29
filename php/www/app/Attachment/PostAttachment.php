<?php
declare(strict_types=1);

namespace App\Attachment;


use App\Entity\Post;
use Intervention\Image\ImageManager;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @PostAttachment
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Attachment
 */
class PostAttachment
{
      public static function upload(Post $post)
      {
           $image = $post->getImage();
           if (empty($image) || ($post->shouldUpload() === false)) {
               return;
           }

           $directory = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts';
           if (! is_dir($directory)) {
               mkdir($directory, 0777, true);
           }

           if (!empty($post->getOldImage())) {
                 $formats = ['small', 'large'];
                 foreach ($formats as $format) {
                     $oldFile = $directory . DIRECTORY_SEPARATOR . $post->getOldImage() . "_" . $format . ".jpg";
                     if (file_exists($oldFile)) {
                         unlink($oldFile);
                     }
                 }
           }

           # $filename = uniqid("", true) .'.jpg';
           $filename = uniqid("", true);

           // driver: [imagik / gd ]
           $manager = new ImageManager(['driver' => 'gd']);
           $manager->make($image)
                   ->fit(350, 200)
                   ->save($directory . DIRECTORY_SEPARATOR . $filename . "_small.jpg");

          $manager->make($image)
                  ->fit(1280)
                 ->save($directory . DIRECTORY_SEPARATOR . $filename . "_large.jpg");

           $post->setImage($filename);
      }




      public function move(string $target, string $filename): bool
      {
           return move_uploaded_file($target, $filename);
      }
}