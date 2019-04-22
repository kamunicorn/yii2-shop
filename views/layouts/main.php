<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= ($this->title)
            ? Html::encode($this->title) . ' | Sushi Company'
            : 'Sushi Company' ?>
    </title>
    <?php $this->head() ?>
    <?php $this->registerLinkTag([
        'rel' => 'shortcut icon',
        'type' => 'image/x-icon',
        'href' =>  '/web/favicon.png',
    ]);?>
</head>
<body>
<?php $this->beginBody() ?>

<section class="body">
    <header>
        <div class="container">
            <div class="header">
                <a href="/">На главную</a>
                <a href="#">Вход в админку</a>
                <a onclick="openCart(event)" href="#">Корзина <span class="menu-quantity">
                        (<?= (isset($_SESSION['cart.totalQuantity']))
                            ? $_SESSION['cart.totalQuantity']
                            : '0' ?>)</span></a>
                <form class="search" action="<?=Url::to(['category/search'])?>" method="get">
                    <input type="text" placeholder="Поиск..." name="text">
                </form>
            </div>
        </div>
    </header>

    <?= $content ?>

    <footer>
        <div class="container">
            <div class="footer">
                &copy; Все права защищены или типа того
            </div>
        </div>
    </footer>
</section>

<div id="cart" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content"></div>
    </div>
</div>

<div id="order" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="padding-left: 15px;padding-right: 15px;"></div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
