const $ = require('jquery'); // подключение jQuery

$('.js-add-to-cart').on('click', function (event) {
    let headerCart = $('#header-cart');

    event.preventDefault();

    //ajax zapros
    $.get(this.href, function (data) {
        headerCart.html(data);
    });
});