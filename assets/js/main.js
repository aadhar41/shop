$(document).ready(function () {
    /* Calculating the total price of the products in the cart. */
    var totalPrice = 0;
    $(".js-quantity").each(function (index, element) {
        // element == this
        var id = this.id;
        var value = this.value;
        var uid = $("#" + id).attr("data-uid");
        var price = parseInt($("#price_" + uid).val());
        var quantity = $("#quantity_" + uid).val();
        var singleProductPrice = (parseFloat(price) * parseInt(quantity));

        $("#total_unit_price__" + uid).html(singleProductPrice);
        $("#total_unit_price_" + uid).val(singleProductPrice);

        totalPrice += parseFloat(price);
    });

    $("#js-total-amount").html("$ " + totalPrice);
    $("#total_amount").val(totalPrice);

    /* This is the code that is responsible for updating the total price of the products in the cart. */
    $(".js-quantity").change(function (e) {
        e.preventDefault();
        var id = this.id;
        var value = this.value;
        var uid = $("#" + id).attr("data-uid");
        var price = parseInt($("#price_" + uid).val());

        var total_unit_price = (parseFloat(price) * parseFloat(value));
        $("#total_unit_price_" + uid).val(total_unit_price);
        $("#total_unit_price__" + uid).html(total_unit_price);

        var totalPrice = 0;
        $(".total_unit_price").each(function (index, element) {
            // element == this
            totalPrice += parseFloat(element.value);
        });
        $("#js-total-amount").html("$ " + totalPrice);
        $("#total_amount").val(totalPrice);
    });
});