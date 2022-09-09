<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\prepod */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Преподователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prepod-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'fname',
            'name',
            'sname',
            [
                'attribute'=>'predmet.name',
                'value'=> ArrayHelper::getValue($model,'predmet.name'),
            ],
        ],
    ]) ?>

    <h1>Предметы</h1>
    <table class="table table-striped table-bordered detail-view" id="w3">
        <tbody>
        <tr>
            <th>№</th>
            <th>Название</th>
        </tr>
        <?php $count = 1;?>
        <?php foreach($predmets as $predmet){ ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td>
                    <a href="/predmet/view?id=<?= $predmet->id ?>" target="_blank"><?php echo $predmet->predmet->name ?></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <p>
        <?= Html::a('Добавить преподавателя', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить новый предмет', ['predmet/create'], ['class' => 'btn btn-light']) ?>
    </p>

</div>