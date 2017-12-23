<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/19
 * Time: 19:09
 */

namespace app\controllers;


use app\models\Category;
use app\models\searches\DocumentSearch;
use Yii;
use yii\web\Controller;

/**
 * Class ArchiveController
 * @package app\controllers
 */
class ArchivesController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => Category::findOne(1),
        ]);
    }
}