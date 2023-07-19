<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'completed'];

    /**
     * @param array $validatedData
     * @return \PDOStatement|false
     */
    public static function fetch(int $id): \PDOStatement|bool
    {
        return DB::getRawPdo()->query(
            "select * from todos where id = $id");
    }

    public static function getById(int $id)
    {
        $statement = self::fetch($id);
        return $statement->fetch();
    }
}
