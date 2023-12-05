<?php
declare(strict_types=1);

namespace App\Blog\Actions;




use App\Blog\Repository\PostRepository;
use Framework\Actions\RouterAwareAction;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Session\SessionInterface;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
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
         $id     = (int)$request->getAttribute('id');
         $item   = $this->postRepository->find($id);
         $errors = [];

         if ($request->getMethod() === 'POST') {
               $params = $this->getParams($request);
               $params['updated_at'] = date('Y-m-d H:i:s');
               $validator = $this->getValidator($request);
               if ($validator->isValid()) {
                   $this->postRepository->update($params, $item->id);
                   $this->flash->success("L' article a bien ete modifie");
                   return $this->redirect('blog.admin.index');
               }
               $errors = $validator->getErrors();
               $params['id'] = $item->id;
               $item         = $params;
         }

         return $this->renderer->render("@blog/admin/edit", compact('item', 'errors'));
    }


    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request): mixed
    {
        $errors = [];

        if ($request->getMethod() === 'POST') {

            $params = $this->getParams($request);
            $params = array_merge($params, [
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $validator = $this->getValidator($request);

            if ($validator->isValid()) {
                $this->postRepository->insert($params);
                $this->flash->success("L' article a bien ete cree");
                return $this->redirect('blog.admin.index');
            }

            $item   = $params;
            $errors = $validator->getErrors();
        }

        return $this->renderer->render("@blog/admin/create", compact('item', 'errors'));
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



    private function getValidator(Request $request): Validator
    {
         return (new Validator($request->getParsedBody()))
                ->required('content', 'name', 'slug')
                ->length('content', 10)
                ->length('name', 2, 250)
                ->length('slug', 2, 50)
                ->slug('slug');
    }
}