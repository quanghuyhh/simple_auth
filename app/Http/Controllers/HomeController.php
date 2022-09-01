<?php

namespace App\Http\Controllers;

use App\Core\JWT;
use App\Core\Response;
use App\Helpers\Arr;
use App\Models\User;
use Throwable;

class HomeController extends BaseController
{
    public function index()
    {
        echo view('index');
    }

    public function profile()
    {
        try {
            $user = User::findOrFail(auth()['id']);
            response(['user' => $user], Response::HTTP_OK)->json();
        } catch (Throwable $throwable) {
            response([], Response::HTTP_BAD_REQUEST, $throwable->getMessage())->json();
        }
    }

    public function updateProfile()
    {
        try {
            $params = Arr::except($this->request->all(), ['email']);
            if ($this->request->hasFile('avatar')) {
                $params['avatar'] = upload_image($this->request->file('avatar'));
            }

            $user = User::findOrFail(auth()['id']);
            $user->fill($params);
            $user->save();

            response(['user' => $user], Response::HTTP_OK, 'Updated profile successfully!')->json();
        } catch (Throwable $throwable) {
            response(['user' => $user], Response::HTTP_BAD_REQUEST, $throwable->getMessage())->json();
        }
    }
}