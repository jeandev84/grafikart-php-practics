<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @BlogAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Actions
 */
class BlogAction
{


    protected RendererInterface $renderer;


    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }



    public function __invoke(Request $request)
    {
         $slug = $request->getAttribute('slug');
         if ($slug) {
             return $this->show($slug);
         }

         return $this->index();
    }


    public function index(): string
    {
        return $this->renderer->render('@blog/index');
    }


    public function show(string $slug): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $slug
        ]);
    }
}