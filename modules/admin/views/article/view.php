<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
?>
<div class="article-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            'category_id',
            'description',
            'root',
            'pid',
            'model_id',
            'type',
            'position',
            'link_id',
            'cover_id',
            'display',
            'deadline',
            'attach',
            'view',
            'comment',
            'extend',
            'level',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
