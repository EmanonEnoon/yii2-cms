<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/1
 * Time: 22:40
 */

namespace app\models;

use Yii;

class Database extends \yii\base\Model
{
    public $name;
    public $engine;
    public $version;
    public $row_format;
    public $rows;
    public $avg_row_length;
    public $data_length;
    public $max_data_length;
    public $index_length;
    public $data_free;
    public $auto_increment;
    public $create_time;
    public $update_time;
    public $check_time;
    public $collation;
    public $checksum;
    public $create_options;
    public $comment;

    public function attributeLabels()
    {
        return [
            'name' => '表名',
            'engine' => 'engine',
            'version' => 'version',
            'row_format' => 'row_format',
            'rows' => '数据量',
            'avg_row_length' => 'avg_row_length',
            'data_length' => '数据大小',
            'max_data_length' => 'max_data_length',
            'index_length' => 'index_length',
            'data_free' => 'data_free',
            'auto_increment' => 'auto_increment',
            'create_time' => '创建时间',
            'update_time' => 'update_time',
            'check_time' => 'check_time',
            'collation' => 'collation',
            'checksum' => 'checksum',
            'create_options' => 'create_options',
            'comment' => 'comment',
        ];
    }

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function findAll()
    {
        $result = [];
        $tableStatus = static::getDb()->createCommand('SHOW TABLE STATUS')->queryAll();
        $tableStatus = array_map('array_change_key_case', $tableStatus);
        foreach ($tableStatus as $row) {
            $model = new static();
            $model->setAttributes($row, false);
            $result[] = $model;
        }
        return $result;
    }

    public static function exportAll()
    {

    }

    /**
     * 批量修复数据表
     * @param $tableNames
     * @return int
     * @throws \yii\db\Exception
     */
    public static function repairAll($tableNames)
    {
        $tableNames = implode(',', $tableNames);

        return static::getDb()
            ->createCommand('REPAIR TABLE :table')
            ->bindValue([':table' => $tableNames])
            ->execute();
    }

    /**
     * 批量优化数据表
     * @param $tableNames
     * @return int
     * @throws \yii\db\Exception
     */
    public static function optimizeAll($tableNames)
    {
        $tableNames = implode(',', $tableNames);

        return static::getDb()
            ->createCommand('OPTIMIZE TABLE :table')
            ->bindValue([':table' => $tableNames])
            ->execute();
    }

    public static function importAll()
    {

    }
}