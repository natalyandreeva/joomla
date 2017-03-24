function increase_qty(formid) {

	var qty = jQuery("#updatecart_form"+formid+" input[id=quantity]");

	var new_qty = parseInt(qty.val()) + 1;
	qty.val(new_qty);

	recalculate_cart();
}

function decrease_qty(formid) {

	var qty = jQuery("#updatecart_form"+formid+" input[id=quantity]");

	var new_qty = parseInt(qty.val()) - 1;
    if (new_qty < 1)
	    new_qty = 1;
	qty.val(new_qty);

	recalculate_cart();
}

function recalculate_cart() {
	var total = 0;
	jQuery(".cart-summary form").each(function () {
		var k = jQuery(this).attr("rel");
		var price = (jQuery("#updatecart_form"+k+" input[id=price]").val());
		var qty = parseInt(jQuery("#updatecart_form"+k+" input[id=quantity]").val());
		var new_price = qty*price;
		jQuery("#pricediv-"+k + " span.PricesalesPrice").html(new_price.toFixed(2) + " руб.");

		total += new_price;
	});
	jQuery(".cart-totalcost span.PricesalesPrice").html(total.toFixed(2) + " руб.");
}