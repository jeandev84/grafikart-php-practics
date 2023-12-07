<?php
declare(strict_types=1);

namespace Framework\Actions;


use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use Framework\Database\ORM\EntityRepository;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CrudAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Actions
 */
class CrudAction
{

    protected RendererInterface $renderer;

    protected Router $router;

    protected EntityRepository $repository;

    protected FlashService $flash;


    /**
     * @var string
     */
    protected string $viewPath;


    /**
     * @var string
    */
    protected string $routePrefix;


    protected array $messages = [
        'create' => "L' element a bien ete cree",
        'edit'   => "L' element a bien ete modifie"
    ];



    use RouterAwareAction;

    public function __construct(
        RendererInterface $renderer,
        Router            $router,
        EntityRepository  $repository,
        FlashService      $flash
    )
    {
        $this->renderer   = $renderer;
        $this->router     = $router;
        $this->repository = $repository;
        $this->flash      = $flash;
    }



    public function __invoke(Request $request)
    {
        // Add Gloabals variables
        $this->renderer->addGlobal('viewPath', $this->viewPath);
        $this->renderer->addGlobal('routePrefix', $this->routePrefix);

        // Request
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
        $items   = $this->repository->findPaginated(12, $page);

        return $this->renderer->render("$this->viewPath/index", compact('items'));
    }






    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function edit(Request $request): mixed
    {
        $id     = (int)$request->getAttribute('id');
        $item   = $this->repository->find($id);
        $errors = [];

        if ($request->getMethod() === 'POST') {
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $this->repository->update($this->getParams($request), $item->id);
                $this->flash->success($this->messages['edit']);
                return $this->redirect("{$this->routePrefix}.index");
            }

            $errors = $validator->getErrors();
            $params = $request->getParsedBody();
            $params['id'] = $item->id;
            $item         = $params;
        }

        return $this->renderer->render(
            "$this->viewPath/edit",
             $this->formParams(compact('item', 'errors'))
        );
    }





    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request): mixed
    {
        $errors = [];
        $item = $this->getNewEntity();

        if ($request->getMethod() === 'POST') {
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $this->repository->insert($this->getParams($request));
                $this->flash->success($this->messages['create']);
                return $this->redirect("{$this->routePrefix}.index");
            }

            $item   = $request->getParsedBody();
            $errors = $validator->getErrors();
        }

        return $this->renderer->render(
            "$this->viewPath/create",
            $this->formParams(compact('item', 'errors'))
        );
    }



    public function delete(Request $request): mixed
    {
        $this->repository->delete((int)$request->getAttribute('id'));

        return $this->redirect("{$this->routePrefix}.index");
    }





    /**
     * @param Request $request
     *
     * @return array
     */
    protected function getParams(Request $request): array
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, []);
        }, ARRAY_FILTER_USE_KEY);
    }



    protected function getValidator(Request $request): Validator
    {
        $params = array_merge($request->getParsedBody(), $request->getUploadedFiles());
        return new Validator($params);
    }


    protected function getNewEntity(): mixed
    {
         return [];
    }


    /**
     * Traiter les parametres a envoyer a la vue
     *
     * @param array $params
     * @return array
    */
    protected function formParams(array $params): array
    {
        return $params;
    }
}