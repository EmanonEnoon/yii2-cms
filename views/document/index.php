<?php

/* @var $this yii\web\View */
/* @var $groupByYear array */
/* @var $category \app\models\Category */
/* @var $categories \app\models\Category[] */

?>
<div class="row">
    <div class="col-md-9">
        <?php foreach ($groupByYear as $year => $documents) { ?>
            <?= $year ?>
            <hr>
            <?php foreach ($documents as $document) { ?>
                <?= $document->title ?>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="col-md-3">
        <div class="list-group">
            <?php foreach ($categories as $category) { ?>
                <a href="#" class="list-group-item"><?= $category->title ?></a>
            <?php } ?>
        </div>
    </div>
</div>