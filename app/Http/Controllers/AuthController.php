<?php

namespace App\Http\Controllers;

use App\Common\SimpleOrm;
use App\Core\Hash;
use App\Models\User;

class AuthController extends BaseController
{
    public function signIn()
    {
        echo view('auth.login');
    }

    public function signOut()
    {
        session(['user' => null]);
        redirect('/auth/login');
    }

    public function signup()
    {
        echo view('auth.register');
    }

    public function processSignup()
    {
        try {
            $params = $this->request->all();
            if (User::firstWhere('email', $params['email'])) {
                throw new \Exception("Exists an account with email {$params['email']}");
            }
            if ($params['password'] !== $params['confirm_password']) {
                throw new \Exception("Password and confirmation password not match!");
            }
            $user = new User();
            $user->fill($this->request->all());
            $user->save();
            flash('Create account successfully!')->success()->important();
            redirect('/auth/login');
        } catch (\Throwable $throwable) {
            flash($throwable->getMessage())->error()->important();
            back();
        }
    }

    public function processSignIn()
    {
        try {
            $params = $this->request->all();
            $user = User::firstWhere('email', $params['email']);
            if (empty($user)) {
                throw new \Exception("User with ${params['email']} does not exists!");
            }

            if (!Hash::check($params['password'], $user->password)) {
                throw new \Exception('Invalid username or password');
            }
            session(['user' => $user->toArray()]);
            flash('Login successfully!')->success()->important();
            redirect('/');
        } catch (\Throwable $throwable) {
            flash($throwable->getMessage())->error()->important();
            back();
        }
    }
}