<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Группа', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$numbercolumn = 0;
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute'=>'name',
                'label'=>'Наименование'
            ],
        ],
    ]) ?>
    <h1>Студенты обучающиеся в группе</h1>
    <table class="table table-striped table-bordered detail-view" id="w3">
        <tbody>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>Предмет</th>
            <th>Преподаватель</th>
            <th>Оценка</th>
        </tr>
        <?php $count = 1;?>
        <?php foreach($groups as $group){ ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $group->student->fullName ?></td>
                <td><?php echo $group->predmet->name ?></td>
                <td><?php echo $group->prepod->fullName ?></td>
                <td><?php echo $group->mark ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Создать новую группу', ['group/create'], ['class' => 'btn btn-light']) ?>
        <?= Html::a('Добавить студента', ['student/create'], ['class' => 'btn btn-light']) ?>
    </p>
</div>