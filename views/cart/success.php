<? $this->title = 'Заказ принят'; ?>

<div class="container">
    <h1>Ваш заказ под номером <?=$_SESSION['lastOrderId']?> принят!</h1>
<!--    <h1>Ваш заказ под номером --><?//=$currentId?><!-- принят!</h1>-->
<!--    --><?// var_dump($_SESSION)?>
    <a href="/" class="btn btn-success">Вернуться на главную</a>
</div>