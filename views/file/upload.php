<?php
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'action' => ['upload']
]) ?>

<?= FileInput::widget([
    'name' => 'cover',
    'options'=>[
        'multiple'=>true
    ],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['/file/upload']),
        'uploadExtraData' => [
            'album_id' => 20,
            'cat_id' => 'Nature'
        ],
        'maxFileCount' => 10
    ]
]); ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>