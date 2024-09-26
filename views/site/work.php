<ul>
    <?php use yii\bootstrap5\Html;
    use yii\bootstrap5\LinkPager;
    use yii\widgets\ActiveForm;

    foreach ($them as $cat):?>
        <a class="info" href="<?php echo \yii\helpers\Url::to(['site/work', 'id'=>$cat['id']])?>">
            <?php echo $cat['name']?>
        </a>
    <?php endforeach;?>
</ul>



<div class="carrt">
    <?php
    foreach ($tours as $tourq):
        ?>
        <div class="cart">
            <h4 class="bb"><?php echo $tourq['name']?></h4>
            <p class="text"><?php echo yii\helpers\StringHelper::truncateWords(\yii\helpers\Html::encode($tourq['body']), 10) ?></p>
            <div class="dapri">
                <a href="../web/uploads/<?php echo $tourq['file'] ?>">скачать</a>

    <?php endforeach?>

</div>

<div class="qwerty">
    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);?>
</div>

<div>
    <a href="https://praktik.kpk45.ru/praktik/web/index.php?r=site%2Fzayavka">хотите отправить вашу работу?</a>
</div>


<style>

    .info{
        text-decoration: none !important;
    }

    .qwerty{
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-top: 47px !important;
    }
    .bb{

        margin-top: 11px !important;

    }

    .carrt{

        display: flex !important;
    }

    .card{

        display: flex !important;
        width: 150px !important;
    }


</style>



