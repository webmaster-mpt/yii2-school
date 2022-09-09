<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ocenka */

$this->title = 'Выставление оценок';
$this->params['breadcrumbs'][''] = ['label' => 'Оценки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocenka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'Student' => $Student,
        'groups' => $groups,
        'predmets' => $predmets,
        'prepods' => $prepods,
//        'dataStudent' => $dataStudent,
        'studs' => $studs,
        'items' => $items,
    ]) ?>

</div>