<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DownloadAddon */
?>
<div class="download-addon-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parse',
            'content',
            'file_id',
            'download',
            'size',
        ],
    ]) ?>

</div>
