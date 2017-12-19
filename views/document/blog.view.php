<?php

/* @var $this yii\web\View */
/* @var $model \app\models\Article */
?>

<h1><?= $model->title ?></h1>
<p><?= $model->createdBy->username ?></p>
<p><?= Yii::$app->formatter->asDatetime($model->created_at) ?></p>
<p>分类：<?= $model->category->title ?></p>
<p>上一篇：<?= $model->prev->title ?? '没有了' ?></p>
<p>下一篇：<?= $model->next->title ?? '没有了' ?></p>
<hr>
<div>
    <?= $model->addon->content ?>
</div>
