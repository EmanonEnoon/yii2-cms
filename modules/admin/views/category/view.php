<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
?>
<div class="category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            'parent_id',
            'order',
            'meta_title',
            'keywords',
            'description',
            'model',
            'type',
            'link_id',
            'allow_publish',
            'display',
            'reply',
            'check',
            'reply_model',
            'extend',
            'created_at:datetime',
            'updated_at:datetime',
            'status',
            'icon_id',
        ],
    ]) ?>

</div>
