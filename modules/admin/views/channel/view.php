<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Channel */
?>
<div class="channel-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'title',
            'url:url',
            'order',
            'target',
        ],
    ]) ?>

</div>
