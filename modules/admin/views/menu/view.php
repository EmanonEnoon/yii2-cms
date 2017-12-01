<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
?>
<div class="menu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'parent_id',
            'route',
            'order',
            'data',
            'level',
        ],
    ]) ?>

</div>
