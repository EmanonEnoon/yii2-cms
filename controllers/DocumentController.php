<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\Document;
use app\models\searches\DocumentSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DocumentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex($category_id)
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $groupByYear = ArrayHelper::index($dataProvider->models, 'id', function ($item) {
            return date('Y', $item->created_at);
        });

        return $this->render('index', [
            'groupByYear' => $groupByYear,
            'category' => Category::findOne($category_id),
            'categories' => Category::find()->all(),
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render("{$model->category->name}.view.php", [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return null|Document
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}