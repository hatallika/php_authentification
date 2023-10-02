<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    //здесь прослойка для обращения в БД от классов - сущностей (по таблицам)
    //по паттерну ActiveRecords

    abstract protected static function getTableName();

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]); //вернет массив
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class()); //static::class //вернет объект
    }

    public static function getOneWhere($columnName, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$columnName}=:{$columnName}";
        return Db::getInstance()->queryOneObject($sql, [$columnName => $value], static::class);
    }

    //SELECT * FROM tablename WHERE login:= login OR emeil:=email OR ...
    public static function getOneWhereOr($params)
    {
        $tableName = static::getTableName();
        $columns = [];

        foreach ($params as $key => $value) {
            $columns[] .= "`{$key}`=:{$key}";
        }
        $columns = implode(" OR ", $columns);
        $sql = "SELECT * FROM {$tableName} WHERE {$columns}";
        return Db::getInstance()->queryOneObject($sql, $params, static::class);
    }


    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";

        return Db::getInstance()->queryAllLimit($sql, $limit);
    }

    public function delete()
    {
        $tableName = static::getTableName();
        var_dump($this->id);

        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    //'INSERT INTO user (`name`,`description`,`price`) VALUES (:name,:description,:price)
    public function insert(): Model
    {
        $tableName = static::getTableName();
        $params = [];

        foreach ($this->props as $key => $value) {
            $params[$key] = $this->$key;
        }

        $columns = " (`" . implode("`,`", array_keys($params)) . "`)";
        $values = " (:" . implode(",:", array_keys($params)) . ")";

        $sql = "INSERT INTO {$tableName} {$columns} VALUES {$values}";

        DB::getInstance()->execute($sql, $params);
        $this->id = DB::getInstance()->lastInsertID();

        return $this;
    }

    //'UPDATE products SET`name`=:name, `description`=:description, `price`=:price WHERE id = :id'
    public function update(): Model
    {

        $params = [];
        $columns = [];
        foreach ($this->props as $key => $value) {

            if (!$value) continue;
            $params["{$key}"] = $this->$key;
            $columns[] .= "`{$key}`=:{$key}";
            //сброс параметров на изменение
            $this->props[$key] = false;
        }

        $columns = implode(", ", $columns);
        $params['id'] = $this->id;
        $tableName = static::getTableName();

        $sql = "UPDATE {$tableName} SET {$columns}  WHERE `id` = :id";

        Db::getInstance()->execute($sql, $params);
        return $this;

    }

    public function save()
    {
        if (is_null($this->id)) {
            return $this->insert();
        }
        return $this->update();
    }

    //WHERE name = 'alex' return 5
    public static function getCountWhere($name, $value){
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` =:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }


}