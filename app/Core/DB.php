<?php

namespace App\Core;

use App\Common\SimpleOrm;

class DB
{
    public static function beginTransaction()
    {
        SimpleOrm::getConnection()->begin_transaction();
    }

    public static function commit()
    {
        SimpleOrm::getConnection()->commit();
    }

    public static function rollback()
    {
        SimpleOrm::getConnection()->rollback();
    }
}