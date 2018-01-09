<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

/**
 * 开发工具
 *
 */
class GController extends Controller
{
    /**
     * @var string
     */
    public $table;

    /**
     * @var string
     */
    public $model;

    public function options($actionID)
    {
        return array_merge(parent::options($actionID), [
            'table', 'model'
        ]);
    }

    protected function getTables()
    {
        $tables = Yii::$app->db->createCommand('show tables')->queryAll();
        $tables = ArrayHelper::getColumn($tables, function ($element) {
            return reset($element);
        });

        return $tables;
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    /**
     * 生成model
     */
    public function actionM()
    {
        if ($this->table) {
            $tables[] = $this->table;
        } else {
            $tables = $this->getTables();
        }

        foreach ($tables as $table) {
            Yii::$app->runAction('gii/model', [
                'interactive' => false,
                'tableName' => $table,
                'modelClass' => Inflector::camelize($table),
                'ns' => 'app\models\gii',
                'generateLabelsFromComments' => true,
                'useTablePrefix' => true,
            ]);
        }
    }

    /**
     * 生成ajax的控制器和视图
     */
    public function actionAjaxCrud()
    {
        if ($this->model) {
            Yii::$app->runAction('gii/ajaxcrud', [
                'interactive' => false,
                'modelClass' => 'app\models\\' . $this->model,
                'controllerClass' => 'app\modules\admin\controllers\\' . $this->model . 'Controller',
                'viewPath' => '@app/modules/admin/views/' . Inflector::camel2id($this->model),
                'searchModelClass' => 'app\models\searches\\' . $this->model . 'Search',
            ]);
        } else {
            $fs = new \FilesystemIterator(Yii::$app->basePath . '/models');
            foreach ($fs as $f) {
                $fileName = $f->getBaseName('.php');
                Yii::$app->runAction('gii/ajaxcrud', [
                    'interactive' => false,
                    'modelClass' => 'app\models\\' . $fileName,
                    'controllerClass' => 'app\modules\admin\controllers\\' . $fileName . 'Controller',
                    'viewPath' => '@app/modules/admin/views/' . Inflector::camel2id($fileName),
                    'searchModelClass' => 'app\models\searches\\' . $fileName . 'Search',
                ]);
            }
        }
    }

    /**
     * 重新安装数据库
     */
    public function actionFresh()
    {
        Yii::$app->runAction('migrate/down', [2, 'interactive' => false, 'migrationPath' => '@yii/rbac/migrations']);
        Yii::$app->runAction('migrate/down', ['interactive' => false]);

        Yii::$app->runAction('migrate/up', ['interactive' => false]);
        Yii::$app->runAction('migrate/up', ['interactive' => false, 'migrationPath' => '@yii/rbac/migrations']);
    }
}
