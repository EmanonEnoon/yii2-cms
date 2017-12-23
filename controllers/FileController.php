<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 2:29
 */

namespace app\controllers;


use osenyursa\fileupload\UploadAction;
use yii\web\Controller;

class FileController extends Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => UploadAction::className(),
                'rules' => ['skipOnEmpty' => false, 'maxFiles' => 4],
                'name' => 'cover',
                'savePath' => 'upload/' . date('Y-m-d') . '/',
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('upload');
    }
}