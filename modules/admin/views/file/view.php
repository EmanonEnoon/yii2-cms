<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\File */
?>
<div class="file-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'path',
            'ext',
            'mime',
            'size',
            'md5',
            'sha1',
            'location',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
