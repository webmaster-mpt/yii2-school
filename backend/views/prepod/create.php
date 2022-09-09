<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\prepod */

$this->title = 'Добавить преподователя';
$this->params['breadcrumbs'][] = ['label' => 'Преподователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prepod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
