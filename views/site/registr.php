<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;


?>
<div class="class">



    <div class="qwe">
        <div class="qwerty">

            <?php $form = ActiveForm::begin()?>

            <?= $form->field($model, 'username')->textInput() ?>

            <div class="name">

                <?= $form->field($model, 'surname')->textInput() ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'patronymic')->textInput() ?>

            </div>
            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>



            <div class="fzxcasd">
                <?= Html::submitButton('регестрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <a href="http://praktik/web/index.php?r=site%2Flogin">Авторизация</a>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>

<style>

    .class{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qwe{
        display: flex;
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
        width: 400px;
        justify-content: space-between;
        align-items: center;
    }

    .name{
        display: flex;
    }



</style>

