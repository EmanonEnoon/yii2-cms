<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/1
 * Time: 23:31
 */

namespace app\models;

use FilesystemIterator;
use Yii;

class DatabaseBackup extends \yii\base\Model
{
    public $name;
    public $part;
    public $compress;
    public $size;
    public $create_time;

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'file_name' => '备份名称',
            'part' => '卷数',
            'compress' => '压缩',
            'size' => '数据大小',
            'create_time' => '备份时间',
        ];
    }

    /**
     * @return static[] array
     */
    public static function findAll()
    {
        $result = [];
        $path = Yii::$app->params;
        $path = 'D:\wamp64\www\template\onethink\Data';

        $fIterator = new FilesystemIterator($path, FilesystemIterator::KEY_AS_FILENAME);
        /** @var \DirectoryIterator $file */
        foreach ($fIterator as $name => $file) {
            if (preg_match('/^\d{8}-\d{6}-\d+\.sql(?:\.gz)?$/', $name)) {
                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[6];
                $key = $date . ' ' . $time;

                if (isset($result[$key])) {
                    $result[$key]['part'] = max($result[$key]['part'], $part);
                    $result[$key]['size'] += $file->getSize();
                } else {
                    $row['name'] = date('Ymd-His', strtotime($key));
                    $row['create_time'] = $file->getCTime();
                    $row['part'] = $part;
                    $row['compress'] = $file->getExtension();
                    if ($row['compress'] == 'sql') {
                        $row['compress'] = '-';
                    }
                    $row['size'] = $file->getSize();
                    $result[$key] = $row;
                }
            }

        }

        $result = static::populateRecord($result);

        return $result;
    }

    /**
     * 填充一条数据模型
     * @param $rows
     * @return array
     */
    private static function populateRecord($rows)
    {
        $result = [];
        foreach ($rows as $row) {
            $model = new static();
            $model->setAttributes($row, false);
            $result[] = $model;
        }

        return $result;
    }

    /**
     * 导入备份文件
     * @param $path
     */
    public function import($path)
    {

    }

    /**
     * 删除备份文件
     * ```
     * 删除指定文件
     * DatabaseBackup::deleteAll('abc.sql');
     * 匹配模式删除
     * DatabaseBackup::deleteAll('20170304-*.sql');
     * ```
     * @param string $pattern
     * @return array
     */
    public static function deleteAll($pattern)
    {
        return array_map('unlink', glob($pattern));
    }
}