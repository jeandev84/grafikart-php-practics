<?php
declare(strict_types=1);

namespace App\Blog\Widgets;

use App\Admin\Widgets\AdminWidgetInterface;
use App\Blog\Repository\PostRepository;
use Framework\Templating\Renderer\RendererInterface;


/**
 * Created by PhpStorm at 06.12.2023
 *
 * @BlogWidget
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Widgets
 */
class BlogWidget implements AdminWidgetInterface
{


    /**
     * @var RendererInterface
    */
    protected RendererInterface $renderer;


    /**
     * @var PostRepository
    */
    protected PostRepository $postRepository;


    /**
     * @param RendererInterface $renderer
     *
     * @param PostRepository $postRepository
    */
    public function __construct(RendererInterface $renderer, PostRepository $postRepository)
    {
        $this->renderer = $renderer;
        $this->postRepository = $postRepository;
    }




    public function render(): string
    {
         $count = $this->postRepository->count();
         return $this->renderer->render("@blog/admin/widget", compact('count'));
    }

    public function renderMenu(): string
    {
        return $this->renderer->render("@blog/admin/menu");
    }
}