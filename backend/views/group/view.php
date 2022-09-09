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
    <h1>Ученики обучающиеся в группе</h1>
    <table class="table table-striped table-bordered detail-view" id="w3">
        <tbody>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>Предмет</th>
            <th>Преподаватель</th>
            <th>Оценка</th>
            <th></th>
        </tr>
        <?php $count = 1;?>
        <?php foreach($ocenkas as $ocenka){ ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td>
                    <a href="/student/view?id=<?= $ocenka->student_id ?>" target="_blank"><?php echo $ocenka->student->fullName ?></a>
                </td>
                <td>
                    <a href="/predmet/view?id=<?= $ocenka->predmet_id ?>" target="_blank"><?php echo $ocenka->predmet->name ?></a>
                </td>
                <td>
                    <a href="/prepod/view?id=<?= $ocenka->prepod_id ?>" target="_blank"><?php echo $ocenka->prepod->fullName ?></a>
                </td>
                <td>
                    <a href="/ocenka/view?id=<?= $ocenka->id ?>" target="_blank"><?php echo $ocenka->mark ?></a>
                </td>
                <td>
                    <a href="/ocenka/update?id=<?= $ocenka->id ?>" target="_blank">✏️</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <p>
        <?= Html::a('Добавить новую группу', ['group/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить ученика', ['student/create'], ['class' => 'btn btn-light']) ?>
    </p>
</div>