<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\student */

$this->title = 'Добавить ученика';
$this->params['breadcrumbs'][] = ['label' => 'Студенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
