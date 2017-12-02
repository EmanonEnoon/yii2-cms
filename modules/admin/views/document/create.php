<?php


/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $modelInfo app\models\Model */

$this->title = '新增' . $modelInfo->title;
?>
<div class="document-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelInfo' => $modelInfo,
    ]) ?>
</div>
