<?php

/* @var $this yii\web\View */
/* @var $configs app\models\Config[] */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="config-form">

    <?php foreach ($configs as $config) { ?>
        <?php switch ($config->type) {
            case 0:
            case 1:
                echo $form->field($config, "[$config->id]value")->textInput()->label($config->title);
                break;
            case 2:
            case 3:
                echo $form->field($config, "[$config->id]value")->textarea(['rows' => 6])->label($config->title);
                break;
            case 4:
                echo $form->field($config, "[$config->id]value")->dropDownList($config->items)->label($config->title);
                break;
        } ?>
    <?php } ?>

</div>
