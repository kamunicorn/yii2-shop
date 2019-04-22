<h3>Ваш заказ под номером <?=$order->id?> принят.</h3>
Ваш телефон: <?=$order->phone?>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($session['cart'] as $id => $item) {?>
        <tr>
            <td><?=$item['name']?></td>
            <td><?=$item['price']?></td>
            <td><?=$item['goodQuantity']?> рублей</td>
            <td><?= $item['price']*$item['goodQuantity']?> рублей</td>
        </tr>
        <?}?>
        <tr>
            <td colspan="3">Итого:</td>
            <td><?=$session['cart.totalQuantity']?> шт.</td>
        </tr>
        <tr>
            <td colspan="3">На сумму:</td>
            <td><b><?=$session['cart.totalSum']?></b> рублей</td>
        </tr>
        </tbody>
    </table>
</div>