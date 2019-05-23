const $ = require('jquery'); // подключение jQuery

let $headerCart = $('#header-cart'); // вывели в переменную// вместо дублирования кода
let $body = $('body');      // вместо дублирования кода

// обработчик для добаления в корзину
$('.js-add-to-cart').on('click', function (event) {

    event.preventDefault(); // запрет на переход по своей ссылке

    //ajax zapros
    $.get(this.href, function (data) {
        $headerCart.html(data);
    });
});

// обработчик события увеличение к-ва заказов в корзине (аналогичен кнопке)
$body.on('input', '.js-cart-count', function (event) {
    let $me = $(this);

    $.post($me.data('href'), {'count': $me.val()}, updateCart);
});

// обработчик события для удаление товара
$body.on('click', '.js-cart-delete', function (event) {  // обработчик, рагируем по событию клик, ид, ф-я
    event.preventDefault();     // запрет на переход по своей ссылке

    //ajax zapros
    if (confirm('Вы действительно хотите удалить товар из корзины?')) {  //
        $.post(this.href, updateCart);
    }
});

// вместо дублирования кода
function updateCart(data) {
    $('#cartTable').html(data);

    let amount = $('#orderAmount').html();
    $headerCart.html(amount);
}