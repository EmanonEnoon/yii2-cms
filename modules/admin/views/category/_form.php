<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= TabsX::widget([
        'items' => [
            [
                'label' => '基础',
                'content' => $this->render('_form_basic', [
                    'form' => $form,
                    'model' => $model,
                ]),
            ],
            [
                'label' => '高级',
                'content' => $this->render('_form_advanced', [
                    'form' => $form,
                    'model' => $model,
                ]),
            ]
        ]
    ]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
