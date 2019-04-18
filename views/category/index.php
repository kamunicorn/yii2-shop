<?=\app\widgets\MenuWidget::widget()?>
<?use yii\helpers\Url;?>

<div class="container justify-content-center">
    <div class="row">

        <? foreach ($goods as $good) { ?>
        <div class="col-md-6 col-lg-4">
            <div class="product">
                <div class="product-img">
                    <img src="/img/<?=$good['img']?>" alt="<?=$good['name']?>">
                </div>
                <div class="product-name"><?=$good['name']?></div>
                <div class="product-descr">Состав: <?=$good['composition']?></div>
                <div class="product-price"><?=$good['price']?></div>
                <div class="product-buttons">
                    <button type="button" class="product-button__add btn btn-success">Заказать</button>
                    <a href="<?=Url::to(['good/index', 'name' => $good['link_name']])?>" type="button" class="product-button__more btn btn-primary">Подробнее</a>
                </div>
            </div><!-- /.product -->
        </div><!-- /.col-4 -->
        <? } ?>

    </div><!-- /.row -->
</div><!-- /.container -->