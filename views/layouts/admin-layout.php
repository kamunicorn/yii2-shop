<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAppAsset;
use yii\helpers\Url;

AdminAppAsset::register($this);
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
                <? if (!Yii::$app->user->isGuest) { ?>
                    <a href="/admin/logout">Выход из админки</a>
                <? } ?>
                <form class="search" action="<?=Url::to(['category/search'])?>" method="get">
                    <input type="text" placeholder="Поиск..." name="text">
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <?= $content ?>
    </div>

    <footer>
        <div class="container">
            <div class="footer">
                &copy; Все права защищены или типа того
            </div>
        </div>
    </footer>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
