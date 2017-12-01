<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/1
 * Time: 22:35
 */

namespace app\modules\admin\controllers;

use app\models\Database;
use app\models\DatabaseBackup;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DatabaseController extends Controller
{
    /**
     * 数据表列表
     * @return string
     */
    public function actionIndexExport()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => Database::findAll(),
            'pagination' => false,
        ]);

        return $this->render('index-export', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 数据备份列表
     * @return string
     */
    public function actionIndexImport()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => DatabaseBackup::findAll(),
            'key' => 'create_time',
            'pagination' => false,
        ]);

        return $this->render('index-import', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 优化表
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionOptimize()
    {
        $id = Yii::$app->request->post('id');
        Database::optimizeAll($id);

        return [];
    }

    /**
     * 修复表
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionRepair()
    {
        $id = Yii::$app->request->post('id');
        Database::repairAll($id);

        return [];
    }

    /**
     * 删除备份
     * @param int $time
     * @return mixed
     */
    public function actionDelete($time)
    {
        $pattern = date('Ymd-His', $time) . '-*.sql*';
        DatabaseBackup::deleteAll($pattern);

        return [];
    }
}