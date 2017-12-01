<?php

use johnitvn\ajaxcrud\BulkButtonWidget;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Database';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="database-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'columns' => [
                [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'width' => '20px',
                ],
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'width' => '30px',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'name',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'rows',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => ['shortSize'],
                    'attribute' => 'data_length',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'create_time',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        return Url::to([$action, 'id' => $key]);
                    },
                    'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
                    'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
                    'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
                        'data-confirm' => false, 'data-method' => false,// for overide yii data api
                        'data-request-method' => 'post',
                        'data-toggle' => 'tooltip',
                        'data-confirm-title' => '确认',
                        'data-confirm-message' => 'Are you sure want to delete this item'],
                ],

            ],
            'toolbar' => [
                ['content' =>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role' => 'modal-remote', 'title' => 'Create new Models', 'class' => 'btn btn-default']) .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Reset Grid']) .
                    '{toggleData}' .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Models listing',
                'before' => '<em>* 拖动表格边缘来进行缩放.</em>',
                'after' => BulkButtonWidget::widget([
                        'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                            ["bulk-delete"],
                            [
                                "class" => "btn btn-danger btn-xs",
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => '确认',
                                'data-confirm-message' => 'Are you sure want to delete this item'
                            ]),
                    ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
