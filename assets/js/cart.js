const $ = require('jquery'); // подключение jQuery

// обработчик для добаления в корзину
$('.js-add-to-cart').on('click', function (event) {
    let headerCart = $('#header-cart');

    event.preventDefault();
    //ajax zapros
    $.get(this.href, function (data) {
        headerCart.html(data);
    });
});

// обработчик события увеличение к-ва заказов в корзине (аналогичен кнопке)
$('body').on('input', '.js-cart-count', function (event) {
    let $me = $(this);

    $.post(
        $me.data('href'),
        {'count': $me.val()},
        function (data) {
            $('#cartTable').html(data);
        }
    );
});