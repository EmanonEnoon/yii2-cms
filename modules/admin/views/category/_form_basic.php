<?php

use app\models\Category;
use app\models\Model;
use app\models\Document;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */

$model->parent_id = $model->parent_id ?: Yii::$app->request->get('parent_id');
?>


<?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title'), ['prompt' => '', 'disabled' => 'true']) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 30]) ?>

<?= $form->field($model, 'allow_publish')->radioList(Category::$allowPublishes, ['inline' => true]) ?>

<?= $form->field($model, 'check')->radioList(Category::$checks, ['inline' => true]) ?>

<?= $form->field($model, 'modelsID')->checkboxList(ArrayHelper::map(Model::find()->asArray()->all(), 'id', 'title'), ['inline' => true]) ?>

<?= $form->field($model, 'typesID')->checkboxList(Document::$typeLabels, ['inline' => true]) ?>


