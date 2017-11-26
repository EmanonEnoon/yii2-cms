<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Download */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="download-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'root')->textInput() ?>

    <?= $form->field($model, 'pid')->textInput() ?>

    <?= $form->field($model, 'model_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'link_id')->textInput() ?>

    <?= $form->field($model, 'cover_id')->textInput() ?>

    <?= $form->field($model, 'display')->textInput() ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'attach')->textInput() ?>

    <?= $form->field($model, 'view')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput() ?>

    <?= $form->field($model, 'extend')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
