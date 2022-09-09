<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Predmet;

/* @var $this yii\web\View */
/* @var $model backend\models\student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ученики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$img_format = function ($model) {
    if ($model->photo)
        return ['image', ['width' => '250', 'height' => '200']];
    else {
        return 'raw';
    }
}
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'fname',
            'name',
            'sname',
            [
                'attribute'=>'group.name',
                'value'=> ArrayHelper::getValue($model,'group.name'),
            ],
            [
                'attribute' => 'photo',
                'value' => function ($model) {
                    if ($model->photo)
                        return '/uploads/' . $model->photo;
                    else {
                        return '(Нет изображения)';
                    }
                },
                'format' => $img_format($model),
            ]
        ],
    ]) ?>

    <h2>Список оценок</h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $allMarksProvider,
    ]) ?>
    <h2>Средние оценки по предметам</h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $allMeanMarksProvider,
    ]) ?>
    <h2>Общий средний балл <?=$mean?></h2>

    <p>
        <?= Html::a('Добавить нового студента', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
