<?php
declare(strict_types=1);

namespace Tests\Framework\Service;


use Framework\Service\Upload;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @UploadTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Service
 */
class UploadTest extends TestCase
{


    protected Upload $upload;

     protected function setUp(): void
     {
        $this->upload = new Upload('uploads');
     }




     public function testUpload()
     {
         $uploadedFile = $this->getMockBuilder(UploadedFileInterface::class)->getMock();

         $uploadedFile->expects($this->any())
                      ->method('getClientFilename')
                      ->willReturn('demo.jpg');

         $uploadedFile->expects($this->once())
                     ->method('moveTo')
                     ->willReturn('uploads/demo.jpg');

         $this->assertEquals('demo.jpg', $this->upload->upload($uploadedFile));
     }





    public function testUploadWithExistingFile()
    {
        $uploadedFile = $this->getMockBuilder(UploadedFileInterface::class)->getMock();

        $uploadedFile->expects($this->any())
                     ->method('getClientFilename')
                     ->willReturn('demo.jpg');

        touch('uploads/demo.jpg');

        $uploadedFile->expects($this->once())
                    ->method('moveTo')
                    ->willReturn('uploads/demo_copy.jpg');

        $this->assertEquals('demo.jpg', $this->upload->upload($uploadedFile));
    }





    public function tearDown(): void
    {
        if (file_exists('uploads/demo.jpg')) {
            unlink('uploads/demo.jpg');
        }
    }
}