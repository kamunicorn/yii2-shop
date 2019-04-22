// Добавление класса active (выделение жирным) текущей категории в меню
let split = window.location.href.split('/'),
    cat = split[split.length - 1],
    nav = $('.nav-link');

for (let i = 0; i < nav.length; i++) {
    if ($(nav[i]).data('id') == cat) {
        $(nav[i]).addClass('active');
        break;
    } else if (!cat) {
        $(nav[0]).addClass('active');
        break;
    }
}

// Открыть корзину (кнопка Корзина в Меню)
function openCart(event) {
    event.preventDefault;
    $.ajax({
        url: '/cart/open',
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            $('#cart').modal('show');
        },
        error: function () {
            alert('error');
        }
    });
}

// Кнопка Очистить корзину
function clearCart(event) {
    if (confirm('Вы действительно хотите очистить корзину?')) {
        event.preventDefault;
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                $('#cart .modal-content').html(res);
                $('.menu-quantity').html('(0)');
            },
            error: function () {
                alert('error');
            }
        });
    }
}

// Кнопка Заказать в карточке товара (во всех view)
$('.product-button__add').on('click', function (event) {
    event.preventDefault();
    let name = $(this).data('name');

    $.ajax({
        url: '/cart/add',
        data: {name: name},
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            $('.menu-quantity').html('('+ $('.total-quantity').html() +')');
        },
        error: function () {
            alert('error');
        }
    });
});

// Оформление заказа - кнопка в корзине
$('.modal-content').on('click', '.btn-next', function () {
    $.ajax({
        url: '/cart/order',
        type: 'GET',
        success: function (res) {
            $('#order .modal-content').html(res);
            $('#cart').modal('hide');
            $('#order').modal('show');
        },
        error: function () {
            alert('error');
        }
    });
});

// Удаление товара из корзины - кнопка крестик
$('.modal-content').on('click', '.delete', function () {
    let id = $(this).data('id');
    // console.log(id);
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            if ($('.total-quantity').html()) {
                $('.menu-quantity').html('('+ $('.total-quantity').html() +')');
            } else {
                $('.menu-quantity').html('(0)');
            }
        },
        error: function () {
            alert('error');
        }
    });
});
// Нажатие на кнопку Начать покупки (или продолжить)
$('.modal-content').on('click', '.btn-close', function () {
    $('#cart').modal('hide');
});