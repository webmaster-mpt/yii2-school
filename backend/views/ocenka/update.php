<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ocenka */

$this->title = 'Изменить оценку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Оценки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="ocenka-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropDownList($groups,[
        'prompt'=>'Выбрать группу',
        'onchange'=>'
        $.post("'.Yii::$app->urlManager->createUrl('ocenka/lists?id=').
            '"+$(this).val(),function( data ) 
            {
                $( "select#ocenka-student_id" ).html( data ).attr("disabled", false);
            });'])

    ?>

    <?= $form->field($model, 'student_id')->
    dropDownList($studs,['prompt'=>'Выбрать ученика']) ?>

    <?= $form->field($model, 'prepod_id')->dropDownList($prepods,[
        'prompt'=>'Выбрать преподователя',
        'onchange'=>'
        $.post("'.Yii::$app->urlManager->createUrl('ocenka/predmets?id=').
            '"+$(this).val(),function( data ) 
            {
                $( "select#ocenka-predmet_id" ).html( data ).attr("disabled", false);
            });
            '])?>

    <?= $form->field($model, 'predmet_id')->dropDownList($predmets,['prompt'=>'Выбрать предмет']) ?>

    <?= $form->field($model, 'date')->input('date');?>

    <?= $form->field($model, 'mark')->dropDownList($items,['prompt' => 'Выбрать оценку/присутствие'])?>

    <div class="form-group">
        <?= Html::submitButton('Выставить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
