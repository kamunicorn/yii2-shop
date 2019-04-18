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

$('.product-button__add').on('click', function (event) {
    'use strict';
    event.preventDefault();
    let name = $(this).data('name');

    $.ajax({
        url: '/cart/add',
        data: {name: name},
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            openCart(event);
        },
        error: function () {
            alert('error');
        }
    });
});