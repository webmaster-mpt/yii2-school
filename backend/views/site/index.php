<?php

/* @var $this yii\web\View */

use backend\models\Group;
use backend\models\Predmet;
use backend\models\Prepod;
use backend\models\Student;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Школа';
?>
<style>
    #students{
        color:white;
        font-size: 16px;
        font-weight: 300;
    }
    #students:hover{
        color:white;

    }
    #groups{
        color:white;
        font-size: 16px;
        font-weight: 300;
    }
    #groups:hover{
        color:white;

    }
</style>
<div class="site-index">
    <h1>Журнал оценок</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'group_id',
                'filter'=> $group,
                'value' => function ($model) {
                    return Html::a(Html::encode($model->group->name), \yii\helpers\Url::to(['/group/view', 'id' => $model->group_id]));
                },
                'format' => 'raw',
                'label'=>'Группа'
            ],
            [
                'attribute'=>'student_id',
                'filter'=> $student,
                'value' => function ($model) {
                    return Html::a(Html::encode($model->student->fullName), \yii\helpers\Url::to(['/student/view', 'id' => $model->student_id]));
                },
                'format' => 'raw',
                'label'=>'Ученик'
            ],
            [
                'attribute'=>'prepod_id',
                'filter'=> $prepod,
                'value' => function ($model) {
                    return Html::a(Html::encode($model->prepod->fullName), \yii\helpers\Url::to(['/prepod/view', 'id' => $model->prepod_id]));
                },
                'format' => 'raw',
                'label'=>'Преподователь'
            ],
            [
                'attribute'=>'predmet_id',
                'filter'=> $predmet,
                'value' => function ($model) {
                    return Html::a(Html::encode($model->predmet->name), \yii\helpers\Url::to(['/predmet/view', 'id' => $model->predmet_id]));
                },
                'format' => 'raw',
                'label'=>'Предмет'
            ],
            'date',
            'mark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>