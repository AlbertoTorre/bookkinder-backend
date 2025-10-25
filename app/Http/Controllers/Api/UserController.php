<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function users()
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }

    public function user($id)
    {
        $user = $this->userRepository->find($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = $this->userRepository->create([...$data, 'password' => 'password']);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->userRepository->updateById($id, $data);

        return response()->json($user);
    }

    public function delete($id)
    {
        $user = $this->userRepository->find($id);
        $this->userRepository->delete($user);

        return response()->json(null, 204);
    }

    public function usersSearch($query)
    {
        $books = $this->userRepository->searchByName($query);

        return response()->json($books);
    }
}
