<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function books()
    {
        $books = $this->bookRepository->all();

        return response()->json($books);
    }

    public function book($id)
    {
        $book = $this->bookRepository->find($id);

        return response()->json($book);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $book = $this->bookRepository->create($data);

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $book = $this->bookRepository->updateById($id, $data);

        return response()->json($book);
    }

    public function delete($id)
    {
        $book = $this->bookRepository->find($id);
        $this->bookRepository->delete($book);

        return response()->json(null, 204);
    }

    public function booksSearch($query)
    {
        $books = $this->bookRepository->searchByTitle($query);

        return response()->json($books);
    }

    public function booksByCategory($category)
    {
        $books = $this->bookRepository->findByCategory($category);

        return response()->json($books);
    }

    public function topRatedBooks($limit)
    {
        $books = $this->bookRepository->topRated($limit);

        return response()->json($books);
    }
}
