<?php

namespace App\Models;

use App\Common\SimpleOrm;

class BaseModel extends SimpleOrm
{
    public function fill($params): static
    {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
        return $this;
    }

    public function toArray(): array
    {
        return $this->getLoadData();
    }

    public static function find(int $id): object
    {
        return static::retrieveByPK($id);
    }

    public static function firstWhere($key, $value)
    {
        return static::retrieveByField($key, $value, SimpleOrm::FETCH_ONE);
    }

    /**
     * @throws \Exception
     */
    public static function findOrFail(int $id): object
    {
        if (!$model = static::find($id)) {
            throw new \Exception('Model not found!');
        }
        return $model;
    }
}