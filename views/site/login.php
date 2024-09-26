<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';

?>
<div class="qwe">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля для входа в систему:</p>


    <div class="qwerty">

        <?php $form = ActiveForm::begin()?>

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>


        <div class="fzxcasd">

            <?= Html::submitButton('войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <a href="https://praktik.kpk45.ru/praktik/web/index.php?r=site%2Fregistr">Регестрация</a>

        </div>

        <?php ActiveForm::end(); ?>


    </div>
</div>

<style>



    .qwe{
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 670px;
        align-items: center;
        justify-content: center;
    }

    .qwerty{
        width: 400px;
        text-align: center;

    }

    .fzxcasd{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }



</style>