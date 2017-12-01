<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Model */
?>
<div class="model-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
