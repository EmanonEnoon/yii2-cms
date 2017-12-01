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
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GController extends Controller
{
    public $table;
    public $model;

    public function options($actionID)
    {
        return array_merge(parent::options($actionID), [
            'table', 'model'
        ]);
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionM()
    {
        if ($this->table) {
            Yii::$app->runAction('gii/model', [
                'interactive' => false,
                'tableName' => $this->table,
                'modelClass' => Inflector::camelize($this->table),
                'ns' => 'app\models\gii',
                'generateLabelsFromComments' => true,
                'useTablePrefix' => true,
            ]);
        } else {
            $tables = Yii::$app->db->createCommand('show tables')->queryAll();
            $tables = ArrayHelper::getColumn($tables, 'Tables_in_yii2basic');
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
    }

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

    public function actionR()
    {
        Yii::$app->runAction('migrate/down', ['interactive' => false, 'migrationPath' => '@yii/rbac/migrations']);
        Yii::$app->runAction('migrate/down', ['interactive' => false, 'migrationPath' => '@yii/rbac/migrations']);
        Yii::$app->runAction('migrate/down', ['interactive' => false]);

        Yii::$app->runAction('migrate/up', ['interactive' => false]);
        Yii::$app->runAction('migrate/up', ['interactive' => false, 'migrationPath' => '@yii/rbac/migrations']);
    }
}
