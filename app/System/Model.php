<?php

namespace App\System;

use \PDO;

abstract class Model
{
    protected static $table;

    public static function all()
    {
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM ' . static::$table);

        return $req->fetchAll(PDO::FETCH_OBJ);

    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $id = intval($id);
        $query = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';

        $req = $db->prepare($query);

        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_OBJ);

    }

    protected static function _buildSet($keyword, $constraint, $glue = 'AND')
    {
        if ($constraint) {
            $arr = [];

            foreach ($constraint as $param => $value) {
                $arr[] = "{$param}=:{$param}";
            }
            return " {$keyword} " . implode(" {$glue} ", $arr);
        }
    }

    public static function where($constraint)
    {
        $db = Db::getInstance();
        $query = 'SELECT * FROM ' . static::$table . static::_buildSet('WHERE', $constraint);

        $req = $db->prepare($query);
        $req->execute($constraint);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public static function orWhere($constraint)
    {
        $db = Db::getInstance();
        $query = 'SELECT * FROM ' . static::$table . static::_buildSet('WHERE', $constraint, 'OR');

        $req = $db->prepare($query);
        $req->execute($constraint);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insert($set)
    {
        $db = Db::getInstance();
        $query = 'INSERT INTO ' . static::$table . ' (' . implode(',', array_keys($set)) . ') VALUES (:' . implode(', :', array_keys($set)) . ')';

        $req = $db->prepare($query);
        $req->execute($set);
    }

    public static function update($set, $constraint)
    {
        $db = Db::getInstance();
        $query = 'UPDATE ' . static::$table . ' SET ' . static::_buildSet('', $set, ', ') . static::_buildSet('WHERE', $constraint);

        $req = $db->prepare($query);
        $req->execute(array_merge($set, $constraint));

    }

    public static function delete($constraint)
    {
        $db = Db::getInstance();
        $query = 'DELETE FROM ' . static::$table . static::_buildSet('WHERE', $constraint);

        $req = $db->prepare($query);
        $req->execute($constraint);

    }

    public static function oneToOne($relationName, $items)
    {
        $relation = static::$relationName();

        if ($items) {
            foreach ($items as $value) {
                $ids[] = $value->{$relation[1]};
            }
            $db = Db::getInstance();
            $query = 'SELECT * FROM ' . $relation[0] . ' WHERE id IN (' . implode(',', $ids) . ')';

            $req = $db->prepare($query);
            $req->execute();
            $relationData = $req->fetchAll(PDO::FETCH_OBJ);
            $relationData = keyBy($relationData, $relation[2]);

            foreach ($items as &$value) {
                $value->{$relationName} = $relationData[$value->{$relation[1]}] ?? null;
            }
            unset($value);
        }
        return $items;
    }

}