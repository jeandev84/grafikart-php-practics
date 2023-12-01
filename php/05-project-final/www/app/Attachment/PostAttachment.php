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

      const UPLOAD_DIRECTORY = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts';

      public static function upload(Post $post)
      {
           $image = $post->getImage();
           if (empty($image) || ($post->shouldUpload() === false)) {
               return;
           }

           $directory = self::UPLOAD_DIRECTORY;

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
                  ->resize(1280, null, function ($constraint) {
                       $constraint->aspectRatio();
                  })
                 ->save($directory . DIRECTORY_SEPARATOR . $filename . "_large.jpg");

           $post->setImage($filename);
      }




      public static function detach(Post $post)
      {
          if (!empty($post->getImage())) {
              $formats = ['small', 'large'];
              foreach ($formats as $format) {
                  $file = self::UPLOAD_DIRECTORY . DIRECTORY_SEPARATOR . $post->getImage() . "_" . $format . ".jpg";
                  if (file_exists($file)) {
                      unlink($file);
                  }
              }
          }
      }


      public function move(string $target, string $filename): bool
      {
           return move_uploaded_file($target, $filename);
      }
}