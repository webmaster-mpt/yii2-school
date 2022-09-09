<?php

use backend\models\Group;
use backend\models\Predmet;
use backend\models\Prepod;
use backend\models\Student;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OcenkaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оценки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocenka-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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

    <p>
        <?= Html::a('Выставить оценочку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>