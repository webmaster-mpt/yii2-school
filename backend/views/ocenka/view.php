<?php

use backend\models\Group;
use backend\models\Ocenka;
use backend\models\Student;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ocenka */
$this->title = ArrayHelper::getValue($model,'group.name');
$this->params['breadcrumbs'][] = ['label' => 'Оценка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ocenka-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить оценку?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'Группа',
                'value' => function ($model) {
                    return $model->group->name;
                },
                'format' => 'raw',
            ],
            [
                'label'=>'Студент',
                'attribute'=> 'student.fullName',
                'value'=> ArrayHelper::getValue($model,'student.fullName'),
            ],
            [
                'label'=>'Преподователь',
                'attribute'=>'prepod.fullName',
                'value'=> ArrayHelper::getValue($model,'prepod.fullName'),
            ],
            [
                'label'=>'Предмет',
                'attribute'=>'predmet.name',
                'value'=> ArrayHelper::getValue($model,'predmet.name'),
            ],
            'date',
            'mark',
        ],
    ]) ?>

</div>