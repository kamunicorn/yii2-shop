<?php
use yii\helpers\Url;
?>

<div class="container">
    <nav class="nav nav-menu">
        <a class="nav-link" href="/">Всё меню</a>
        <? foreach ($data as $cat) { ?>
        <a data-id="<?=$cat['cat_name']?>" class="nav-link" href="<?=Url::to(['category/view', 'cat_id'=>$cat['cat_name']])?>"><?=$cat['browser_name']?></a>
        <? } ?>
    </nav>
</div>