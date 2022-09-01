<?php

namespace App\Models;

use App\Helpers\Arr;

class User extends BaseModel
{
    public function preInsert(array &$data)
    {
        $this->preparePassword($data);
        parent::preInsert($data);
    }

    public function preUpdate(array &$data)
    {
        $this->preparePassword($data);
    }

    public function preparePassword(array &$data)
    {
        if (Arr::has($data, 'password') && !empty($data['password']) && !hashed($data['password'])) {
            $data['password'] = encrypt($data['password']);
        } else {
            unset($data['password']);
        }
    }
}