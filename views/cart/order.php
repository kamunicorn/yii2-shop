<? use yii\widgets\ActiveForm; ?>

<h2 style="padding: 10px; text-align: center">Оформление заказа</h2>

<? $form = ActiveForm::begin() ?>

<?= $form->field($order, 'name') ?>
<?= $form->field($order, 'email') ?>
<?= $form->field($order, 'phone') ?>
<?= $form->field($order, 'address') ?>
<div class="modal-buttons" style="display: flex; padding: 15px; justify-content: space-around">
    <button class="btn btn-success">Оформить заказ</button>
</div>

<? $form = ActiveForm::end() ?>
