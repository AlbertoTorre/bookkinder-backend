<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository extends BaseRepository
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function searchByTitle(string $title)
    {
        return $this->model->where('title', 'LIKE', "%$title%")->get();
    }

    public function findByCategory(string $category)
    {
        return $this->model->where('category', $category)->get();
    }

    public function topRated(int $limit)
    {
        return $this->model->orderBy('rating', 'desc')->limit($limit)->get();
    }
}
