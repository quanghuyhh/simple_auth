<?php

namespace App\Http\Controllers;

use App\Helpers\Arr;
use App\Models\User;

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
            echo view('profile', ['user' => $user]);
        } catch (\Throwable $throwable) {
            flash($throwable->getMessage())->error()->important();
            redirect('/');
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
            flash('Updated profile successfully!')->success()->important();
            redirect('/my-profile');
        } catch (\Throwable $throwable) {
            flash($throwable->getMessage())->error()->important();
            back();
        }
    }
}