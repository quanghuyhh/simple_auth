<?php

namespace App\Models;

use App\Helpers\Arr;

class User extends BaseModel
{
    public function preInsert(array &$data)
    {
        if (Arr::has($data, 'password') && !empty($data['password'])) {
            $data['password'] = encrypt($data['password']);
        } else {
            unset($data['password']);
        }
    }

    public function preUpdate(array &$data)
    {
        if (Arr::has($data, 'password') && !empty($data['password'])) {
            $data['password'] = encrypt($data['password']);
        } else {
            unset($data['password']);
        }
    }
}