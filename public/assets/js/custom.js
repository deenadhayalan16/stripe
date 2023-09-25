$(function () {

    $(".productqty").on("click", function () {

        let product_val = $(this).val();
        let product_price = $(this).attr("data-price");

        if (product_val > 0) {
            $(".btn-primary").show();
            $(".p_price").text("(" + product_price * product_val + ")");
            $(".product-price").val(product_price * product_val);
            
        } else {
            $(".btn-primary").hide();
        }



    });
    $(".productqty").on("keyup", function () {

        let product_val = $(this).val();
        let product_price = $(this).attr("data-price");
        if (product_val > 0) {
            $(".btn-primary").show();
            $(".p_price").text("(" + product_price * product_val + ")");
            $(".product-price").val(product_price * product_val);
            
        } else {
            $(".btn-primary").hide();
        }
    });

    $(".p_price").text("(" + $(".productqty").attr('data-price') + ")");
    $(".product-price").val($(".productqty").attr('data-price'));
});