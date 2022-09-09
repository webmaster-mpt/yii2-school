<?php

use backend\models\Predmet;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PrepodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Преподователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prepod-index">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'fname',
            'name',
            'sname',
            [
                'label'=>'Предмет',
                'attribute'=>'predmet_id',
                'filter'=> Predmet::find()->select(['name','id'])->indexBy('id')->column(),
                'value' => 'predmet.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>     
        <?= Html::a('Добавить препода', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
