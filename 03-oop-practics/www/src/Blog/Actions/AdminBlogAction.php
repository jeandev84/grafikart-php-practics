<?php
declare(strict_types=1);

namespace App\Blog\Actions;




use App\Blog\Repository\PostRepository;
use Framework\Actions\RouterAwareAction;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Session\SessionInterface;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @AdminBlogAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin\Actions
 */
class AdminBlogAction
{
    protected RendererInterface $renderer;

    protected Router $router;

    protected PostRepository $postRepository;

    protected FlashService $flash;

    use RouterAwareAction;

    public function __construct(
        RendererInterface $renderer,
        Router $router,
        PostRepository $postRepository,
        FlashService $flash
    )
    {
        $this->renderer  = $renderer;
        $this->router    = $router;
        $this->postRepository = $postRepository;
        $this->flash = $flash;
    }



    public function __invoke(Request $request)
    {
        // BAD practics
        $requestUri = (string)$request->getUri();

        if ($request->getMethod() === 'DELETE') {
            return $this->delete($request);
        }

        if (substr($requestUri, -3) === 'new') {
              return $this->create($request);
        }
        if ($request->getAttribute('id')) {
            return $this->edit($request);
        }

        return $this->index($request);
    }


    public function index(Request $request): string
    {
        $params  = $request->getQueryParams();
        $page    = (int)($params['p'] ?? 1);
        $items   = $this->postRepository->findPaginated(12, $page);

        return $this->renderer->render('@blog/admin/index', compact('items'));
    }






    /**
     * @param Request $request
     *
     * @return mixed
    */
    public function edit(Request $request): mixed
    {
         $id   = (int)$request->getAttribute('id');
         $item = $this->postRepository->find($id);

         if ($request->getMethod() === 'POST') {
               $params = $this->getParams($request);
               $params['updated_at'] = date('Y-m-d H:i:s');
               $this->postRepository->update($params, $item->id);
               $this->flash->success("L' article a bien ete modifie");
               return $this->redirect('blog.admin.index');
         }

         return $this->renderer->render("@blog/admin/edit", compact('item'));
    }


    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request): mixed
    {
        if ($request->getMethod() === 'POST') {
            $params = $this->getParams($request);
            $params = array_merge($params, [
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $this->postRepository->insert($params);
            $this->flash->success("L' article a bien ete cree");
            return $this->redirect('blog.admin.index');
        }

        return $this->renderer->render("@blog/admin/create");
    }



    public function delete(Request $request): mixed
    {
        $this->postRepository->delete((int)$request->getAttribute('id'));

        return $this->redirect('blog.admin.index');
    }





    /**
     * @param Request $request
     *
     * @return array
    */
    private function getParams(Request $request): array
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['name', 'slug', 'content']);
        }, ARRAY_FILTER_USE_KEY);
    }
}