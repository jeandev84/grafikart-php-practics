<?php
declare(strict_types=1);

namespace App\Blog\Upload;


use Framework\Service\Upload;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @PostUpload
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Upload
 */
class PostUpload extends Upload
{

    /**
     * @var array
    */
    protected array $formats = [
        'thumb' => [320, 180]
    ];


    public function __construct()
    {
        parent::__construct('public/uploads/posts');
    }
}