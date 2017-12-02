<?php

use app\assets\CrudAsset;
use app\widgets\DocumentIndexPageButton;
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $category \app\models\Category */

$this->title = Yii::t('cms', $category->title);
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="document-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => [
                [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'width' => '20px',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'id',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'title',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'type',
                    'value' => 'typeLabel',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'level',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'updated_by',
                    'value' => 'updatedBy.username',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'status',
                    'value' => 'statusLabel',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'view',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
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
                        'data-confirm-title' => '确认',
                        'data-confirm-message' => '确认要删除这些内容吗',
                        'data-confirm-ok' => '确认',
                        'data-confirm-cancel' => '取消',
                    ],
                ],

            ],
            'toolbar' => [
                [
                    'content' => DocumentIndexPageButton::widget(['category' => $category])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> ' . $category->title . '列表',
                'before' => '<em>* 拖动表格边缘来进行缩放.</em>',
                'after' => BulkButtonWidget::widget([
                        'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; 全部删除',
                            ["bulk-delete"],
                            [
                                "class" => "btn btn-danger btn-xs",
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => '确认',
                                'data-confirm-message' => '确认要删除这些内容吗'
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
