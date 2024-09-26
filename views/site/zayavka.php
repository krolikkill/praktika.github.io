<?php

use app\models\Categ;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>


<?php if (!Yii::$app->user->isGuest) :?>

<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>

<?php echo $form->field($model, 'category_id')->dropdownList(
    Categ::find()->select(['name', 'id'])->indexBy('id')->column(),
    ['prompt'=>'Выберите категорию']
);?>

    <?= $form->field($model, 'name')->textInput(['autofocus'=>true]) ?>

    <?= $form->field($model, 'body')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('отправить', ['class'=>'btn btn-primary','name'=>'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end();?>

<div style="text-align: center">


        <div class="qwe">
            <div class="qwerty">

                <?php $form = ActiveForm::begin()?>
                
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    <?php else: echo 'чтобы оставить свой проект, нужно'?>
    <a href="http://praktik/web/index.php?r=site%2Flogin">авторизоваться</a>
    <?php endif;?>
</div>







