<?php

use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
        'value' => function ($model) {
            $prefix = str_repeat('　', ($model->level - 1) * 2);
            $tab = ($model->level == 1) ? '' : '└──';
            return $prefix . $tab . $model->name;
        }
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'parent_id',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'route',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'order',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'data',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'level',
//    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'width' => 'width:5%',
        'template' => '{create} {view} {update} {delete}',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => '查看', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => '更新', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => '删除',
            'data-confirm' => false, 'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => '确认？',
            'data-confirm-message' => '确认要删除这些内容吗',
            'data-confirm-ok' => '确认',
            'data-confirm-cancel' => '取消',
        ],
        'buttons' => [
            'create' => function ($url, $model, $key) {
                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-plus"]);
                $url = Url::to(['create', 'parent_id' => $key]);
                $options = ['role' => 'modal-remote', 'title' => '新增', 'data-toggle' => 'tooltip'];
                return Html::a($icon, $url, $options);
            }
        ]
    ],

];   