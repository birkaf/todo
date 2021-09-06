<?php

namespace App;

abstract class Model
{

    const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }
    public static function findById($id)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            [':id' => $id],
            static::class
        )[0];
    }

    public static function deleteByID($id)
    {
        $db = \App\Db::instance();
        return $db->query(
            'DELETE FROM ' . static::TABLE . ' WHERE id=:id',
            [':id' => $id],
            static::class
        )[0];
    }
    public function isNew()
    {
        return empty($this->id);
    }
    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':'.$k] = $v;
        }
        $sql = '
                INSERT INTO ' . static::TABLE . '
                (' . implode(',', $columns) . ')
                VALUES
                (' . implode(',', array_keys($values)) . ')
                        ';
        $db = Db::instance();
        $db->execute($sql, $values);
    }
    public function update()
    { 
        $columns=[]; 
        $values=[]; 
        foreach ($this as $k => $v ){ 
            $columns[]=$k.'=:'.$k; 
            $values[':'.$k]=$v; 
        } 
        $sql = 'UPDATE '.static::TABLE.' SET '. implode(',', $columns).' WHERE id=:id';
        $db = Db::instance();
        $db->execute($sql, $values); 
    }
    public static function serverAnswer($status,$message){
        $jsonArr["status"] = $status;
        $jsonArr["message"] = $message;
        echo json_encode($jsonArr);
    }
}