<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            [
                    'attribute' => 'status',
                'value' => $model->statusLabel
            ],
            'created_at:datetime',
//            'updated_at:datetime',
        ],
    ]) ?>

</div>
