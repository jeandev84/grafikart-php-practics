<?php
declare(strict_types=1);

namespace App\Http\Controller\Attributes\Api;

use App\Entity\Book;
use App\Http\AbstractController;
use Grafikart\Http\Parameter;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\JsonResponse;
use Grafikart\Http\Response\Response;
use Grafikart\Routing\Attributes\Route;

/**
 * BooksController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Attributes\Api
 */
#[Route(path: '/api')]
class BooksController extends AbstractController
{

    protected function getBooks(): array
    {
        return [
            1 => new Book('PHP Level1', 'description php level1', 'John brown', 24),
            2 => new Book('PHP Level2', 'description php level2', 'John Doe', 38),
            3 => new Book('PHP Level3', 'description php level3', 'Marie Susan', 47),
            4 => new Book('PHP Level4', 'description php level4', 'Martin B.', 59),
        ];
    }


    #[
        Route(path: '/books')
    ]
    public function index(ServerRequest $request): Response
    {
        return new JsonResponse($this->getBooks());
    }

    #[
        Route(path: '/books/{id}', requirements: ['id' => '\d+'])
    ]
    public function show(ServerRequest $request): Response
    {
        $id = (int)$request->getAttribute('id');

        $book = $this->getBooks()[$id] ?? null;

        return new JsonResponse($book);
    }



    #[
        Route(path: '/books/create', methods: ['GET'])
    ]
    public function create(ServerRequest $request): Response
    {
        return $this->render('attributes/api/books/create');
    }



    #[
        Route(path: '/books/store', methods: ['POST'], name: 'api.books.store')
    ]
    public function store(ServerRequest $request): Response
    {
        $parameter = new Parameter($request->getParsedBody());

        $book = new Book(
            $parameter->get('title', ''),
            $parameter->get('description', ''),
            $parameter->get('author', ''),
            (float)$parameter->get('price', 0)
        );

        return new JsonResponse([
           'message' => 'Book successfully created!',
           'book'    => $book
        ]);
    }



    #[
        Route(path: '/books/edit/{id}', methods: ['GET'])
    ]
    public function edit(ServerRequest $request, int $id): Response
    {
        $book = $this->getBooks()[$id] ?? null;

        return $this->render('attributes/api/books/edit', [

        ]);
    }



    #[
        Route(path: '/books/update', methods: ['POST', 'PUT', 'PATCH'], name: 'api.books.store')
    ]
    public function update(ServerRequest $request): Response
    {
        $parameter = new Parameter($request->getParsedBody());

        $book = new Book(
            $parameter->get('title', ''),
            $parameter->get('description', ''),
            $parameter->get('author', ''),
            (float)$parameter->get('price', 0)
        );

        return new JsonResponse([
            'message' => 'Book successfully updated!',
            'book'    => $book
        ]);
    }
}