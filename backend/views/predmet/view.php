<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Prepod;

/* @var $this yii\web\View */
/* @var $model backend\models\predmet */
/* @var $model backend\models\prepod */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Предметы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="predmet-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?$models= new Prepod();?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
        ],
    ]) ?>
    <h1>Преподаватели</h1>
    <table class="table table-striped table-bordered detail-view" id="w3">
        <tbody>
        <tr>
            <th>№</th>
            <th>ФИО</th>
        </tr>
        <?php $count = 1;?>
        <?php foreach($prepods as $prepod){ ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td>
                    <a href="/prepod/view?id=<?= $prepod->id ?>" target="_blank"><?php echo $prepod->fname . ' ' . $prepod->name . ' ' . $prepod->sname ?></a>
                </td>
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
        <?= Html::a('Создать новый предмет', ['predmet/create'], ['class' => 'btn btn-light']) ?>
        <?= Html::a('Добавить преподавателя', ['prepod/create'], ['class' => 'btn btn-light']) ?>
    </p>

</div>