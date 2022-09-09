<?php

use backend\models\Group;
use backend\models\Predmet;
use backend\models\Prepod;
use backend\models\Student;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ocenka */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ocenka-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropDownList($groups,[
        'prompt'=>'Выбрать группу',
        'onchange'=>'
        $.post("'.Yii::$app->urlManager->createUrl('ocenka/lists?group_id=').
            '"+$(this).val(),function( data ) 
            {
                $( "select#ocenka-student_id" ).html( data ).attr("disabled", false);
            });'])

    ?>

    <?= $form->field($model, 'student_id')->
    dropDownList($studs,['prompt'=>'Выбрать ученика','disabled' => 'disabled']) ?>

    <?= $form->field($model, 'predmet_id')->dropDownList($predmets,[
        'prompt'=>'Выбрать предмет',
        'onchange'=>'
        $.post("'.Yii::$app->urlManager->createUrl('ocenka/predmets?prepod_id=').
            '"+$(this).val(),function( data ) 
            {
                $( "select#ocenka-prepod_id" ).html( data ).attr("disabled", false);
            });
            '])?>

    <?= $form->field($model, 'prepod_id')->dropDownList($prepods,['prompt'=>'Выбрать преподователя','disabled' => 'disabled']) ?>

    <?= $form->field($model, 'date')->textInput(['value' => date("d.m.Y"),'disabled' => 'disabled']);?>

    <?= $form->field($model, 'mark')->dropDownList($items,['prompt' => 'Выбрать оценку/присутствие'])?>

    <div class="form-group">
        <?= Html::submitButton('Выставить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>