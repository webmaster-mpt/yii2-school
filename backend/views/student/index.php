<?php

use backend\models\Group;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ученики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute'=>'surname',
                'label'=>'ФИО',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->fname . ' ' . $model->name . ' ' . $model->sname), Url::to(['view', 'id' => $model->id]));
                },
                'format' => 'raw',
            ],
            [
                'attribute'=>'group_id',
                'filter'=> Group::find()->select(['name','id'])->indexBy('id')->column(),
                'value' => 'group.name',
                'label'=>'Группа'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить студента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>