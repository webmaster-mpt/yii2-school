<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?=$name?>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="https://krot.info/uploads/posts/2020-01/1579596320_11-p-foni-s-transformerami-21.jpg" class="card-img" alt="bamblebee" width="180px" height="200px" >
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">Суздальцев Аркадий Александрович</h1>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna </p>
                    <p class="card-text">Nam tempor utamur gubergren no. Pri quas audiam virtute ut</p>
                </div>
            </div>
        </div>
    </div>


    <!--    Skills table-->
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">Навык</th>
            <th scope="col">Дата</th>
            <th scope="col">Описание</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Навык 1</td>
            <td>20.01.2020</td>
            <td>Описание 1</td>
        </tr>
        <tr>
            <td>Навык 2</td>
            <td>19.03.2020</td>
            <td>Описание 2</td>
        </tr>
        <tr>
            <td>Навык 3</td>
            <td>20.01.2018</td>
            <td>Описание 3</td>
        </tr>
        </tbody>
    </table>

    <code><?= __FILE__ ?></code>
</div>
