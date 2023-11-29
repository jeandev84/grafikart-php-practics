<?php
declare(strict_types=1);

namespace App\Attachment;


use App\Entity\Post;

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
                 $oldFile = $directory . DIRECTORY_SEPARATOR . $post->getOldImage();
                 if (file_exists($oldFile)) {
                     unlink($oldFile);
                 }
           }

           $filename = uniqid("", true) .'.jpg';
           move_uploaded_file($image, $directory . DIRECTORY_SEPARATOR . $filename);
           $post->setImage($filename);
      }
}