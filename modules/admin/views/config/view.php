<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
?>
<div class="config-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'type',
            'title',
            'group',
            'extra',
            'value:ntext',
            'comment',
            'order',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
