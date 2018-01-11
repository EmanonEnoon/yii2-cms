<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NavChannel */
?>
<div class="nav-channel-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'type',
            'title',
            'url:url',
            'order',
            'target',
        ],
    ]) ?>

</div>
