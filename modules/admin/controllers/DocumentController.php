<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\Document;
use app\models\Model;
use app\models\searches\DocumentSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'accessControl' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        // 是否允许在当前分类操作指定模型
                        'actions' => ['create'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return Category::findOne(Yii::$app->request->get('category_id'))
                                ->allowModel(Yii::$app->request->get('model_id'));
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Document models by category.
     * @param $category_id
     * @return mixed
     */
    public function actionIndex($category_id)
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => Category::findOne($category_id),
        ]);
    }

    /**
     * Lists all Document models by login user.
     * @return string
     */
    public function actionMy()
    {
        $searchModel = new DocumentSearch([
            'created_by' => Yii::$app->user->id,
            'status' => [
                Document::STATUS_ACTIVE,
                Document::STATUS_EXAMINE,
                Document::STATUS_DISABLE,
            ]
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Document models by login user.
     * @return string
     */
    public function actionDraftBox()
    {
        $searchModel = new DocumentSearch(['status' => Document::STATUS_DRAFT]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('draft-box', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Document models by login user.
     * @return string
     */
    public function actionExamine()
    {
        $searchModel = new DocumentSearch(['status' => Document::STATUS_EXAMINE]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('examine', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Document models by login user.
     * @return string
     */
    public function actionRecycle()
    {
        $searchModel = new DocumentSearch(['status' => Document::STATUS_DELETE]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('recycle', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $modelInfo = Document::findOne($id)->model;
        $model = $this->findModel($modelInfo->namespace, $id);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Document #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                    'modelInfo' => $modelInfo,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $model,
                'modelInfo' => $modelInfo,
            ]);
        }
    }

    /**
     * Creates a new Document model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category_id, $model_id)
    {
        $request = Yii::$app->request;
        $modelInfo = Model::findOne($model_id);
        $modelClass = $modelInfo->namespace;
        /** @var \app\models\Document $model */
        $model = new $modelClass();
        $model->loadDefaultValues();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "新增{$modelInfo->title}",
                    'content' => '<span class="text-success">Create Document success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "新增{$modelInfo->title}",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'modelInfo' => $modelInfo,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'modelInfo' => $modelInfo,
                ]);
            }
        }

    }

    /**
     * Updates an existing Document model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $modelInfo = Document::findOne($id)->model;
        $model = $this->findModel($modelInfo->namespace, $id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Document #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'modelInfo' => $modelInfo,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update Document #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'modelInfo' => $modelInfo,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'modelInfo' => $modelInfo,
                ]);
            }
        }
    }

    /**
     * Delete an existing Document model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = Document::findOne($id)->model;
        $modelInfo = $model->model;
        $this->findModel($modelInfo->namespace, $id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    /**
     * Delete multiple existing Document model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        $model = Document::findOne(reset($pks))->model;
        $modelInfo = $model->model;
        foreach ($pks as $pk) {
            $model = $this->findModel($modelInfo->namespace, $pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    public function actionEmptyTrash()
    {
        $request = Yii::$app->request;
        Document::emptyTrash();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['recycle']);
        }
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $modelClass
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($modelClass, $id)
    {
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
