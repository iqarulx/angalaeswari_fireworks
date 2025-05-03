// material Transfer screen js
let previousFromLocation = null;
let previousFromLocationText = null;
var numbers_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;
var percentage_regex = /^(?:\d{1,2}(?:\.\d{1,2})?)%?$/;
var letter_regex = /^[a-zA-Z\s ]+$/;

function locationChange() {
    var location = $("select[name='location']").val();
    var to_option = ""; var from_option = ""
    if (location == 1) {
        from_option = "<option value=''>Select From-godown</option>";
        to_option = "<option value=''>Select To-godown</option>";
    } else if (location == 2) {
        from_option = "<option value=''>Select From-magazine</option>";
        to_option = "<option value=''>Select To-magazine</option>";
    }
    if (jQuery('select[name="location"]').length > 0) {
        var location = jQuery('select[name="location"]').val();
    }
    if (jQuery('input[name="location"]').length > 0) {
        jQuery('input[name="location"]').val(location);
    }
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "material_action_changes.php?get_location_change=" + location;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            var result = result.split("$$$");
                            if (result.length != 1) {
                                if ($("select[name='from_location']").length > 0) {
                                    $("select[name='from_location']").empty().append(from_option + result[1]);
                                }
                                if ($("select[name='to_location']").length > 0) {
                                    $("select[name='to_location']").empty().append(to_option + result[0]);
                                }
                            } else {
                                if ($("select[name='from_location']").length > 0) {
                                    $("select[name='from_location']").empty().append(from_option + result[0]);
                                }
                                if ($("select[name='to_location']").length > 0) {
                                    $("select[name='to_location']").empty().append(to_option + result[0]);
                                }
                            }


                            previousFromLocation = null;
                            previousFromLocationText = null;
                        }
                    }
                });
            }
        }
    });
}

function FromLocationChange() {
    var from_location = $("select[name='from_location']").val();

    if (jQuery('input[name="from_location"]').length > 0) {
        jQuery('input[name="from_location"]').val(from_location);
    }
    if (previousFromLocation && previousFromLocationText) {
        if ($("select[name='to_location'] option[value='" + previousFromLocation + "']").length === 0) {
            $("select[name='to_location']").append(
                $("<option></option>")
                    .attr("value", previousFromLocation)
                    .text(previousFromLocationText)
            );
        }
    }

    $("select[name='to_location']").val('');

    if (from_location !== "") {
        let optionToRemove = $("select[name='to_location'] option[value='" + from_location + "']");
        previousFromLocationText = optionToRemove.text();
        previousFromLocation = from_location;
        optionToRemove.remove();
    } else {
        previousFromLocation = null;
        previousFromLocationText = null;
    }

    loadProductForFromLocation();
}
function ToLocationId() {
    var to_location = "";
    if (jQuery('select[name="to_location"]').length > 0) {
        to_location = jQuery('select[name="to_location"]').val();
    }

    if (jQuery('input[name="to_location"]').length > 0) {
        jQuery('input[name="to_location"]').val(to_location);
    }
}
function loadProductForFromLocation() {
    var from_location = $("select[name='from_location']").val();
    var location = $("select[name='location']").val();

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "material_action_changes.php?get_product_from_location=" + from_location + "&location=" + location;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            console.log(result);
                            if (jQuery('select[name="selected_product"]').length > 0) {
                                jQuery('select[name="selected_product"]').empty().append(result)
                            }

                        }
                    }
                });
            }
        }
    });
}

function GetProductdetails() {
    if (jQuery('#qty_limit').length > 0) {
        jQuery('#qty_limit').html('');
    }
    var product = $("select[name='selected_product']").val();
    var location = $("select[name='location']").val();
    var from_location = $("select[name='from_location']").val();
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "material_action_changes.php?GetProductdetails=" + product + "&location=" + location + "&from_location=" + from_location;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            result = result.split("$$");
                            console.log(result);
                            if ($("select[name='selected_unit_type']").length > 0) {
                                $("select[name='selected_unit_type']").empty().append(result[0]);
                            }
                            window.globalVar = result[1].split("%%");
                            if (result[2] != "") {
                                if ($("select[name='selected_content']").length > 0) {
                                    $("#contents_div").removeClass("d-none");
                                    $("select[name='selected_content']").empty().append(result[2]);
                                }
                            } else {
                                if ($("select[name='selected_content']").length > 0) {
                                    $("#contents_div").addClass("d-none");
                                    $("select[name='selected_content']").val('');
                                }
                            }
                            if (result[3] != "") {
                                if ($("input[name = 'stock_negative']").length > 0) {
                                    $("input[name = 'stock_negative']").val(result[3]);
                                }
                            } else {
                                if ($("input[name = 'stock_negative']").length > 0) {
                                    $("input[name = 'stock_negative']").val(0);
                                }
                            }
                            GetProductStockLimit();
                        }
                    }
                });
            }
        }
    });
}

function GetProductStockLimit() {
    if (jQuery('#qty_limit').length > 0) {
        jQuery('#qty_limit').html('');
    }
    var location = $("select[name='location']").val();
    var product = $('select[name="selected_product"]').val();
    var from_location = $("select[name='from_location']").val();
    var unit_type = $('select[name="selected_unit_type"]').val();
    var content = "";
    if (jQuery('select[name="location"]').is(":visible") && $('select[name="selected_content"]').length > 0) {
        content = $('select[name="selected_content"]').val();
    }
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "material_action_changes.php?get_product_stock_limit=" + product + "&unit_type=" + unit_type + "&content=" + content + "&location=" + location + "&from_location=" + from_location;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            if (product != "") {
                                if (jQuery('input[name="stock_limit"]').length > 0) {
                                    jQuery('input[name="stock_limit"]').val(result);
                                }
                                if (jQuery('#qty_limit').length > 0) {
                                    jQuery('#qty_limit').html("Current Stock : <span class='text-danger' style='font-weight:bold'>" + result + "</span>");
                                }
                            }
                        }
                    }
                });
            }
        }
    });
}

function AddMaterialProducts() {
    var check_login_session = 1; var all_errors_check = 1; var limit_errors_check = 1;
    var limit = "";
    var negative = "";
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                if (jQuery('#qty_limit').length > 0) {
                    jQuery('#qty_limit').html('');
                }
                var location = "";
                if (jQuery('select[name="location"]').is(":visible")) {
                    if (jQuery('select[name="location"]').length > 0) {
                        location = jQuery('select[name="location"]').val();
                        location = jQuery.trim(location);
                        if (typeof location == "undefined" || location == "" || location == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var from_location = "";
                if (jQuery('select[name="from_location"]').is(":visible")) {
                    if (jQuery('select[name="from_location"]').length > 0) {
                        from_location = jQuery('select[name="from_location"]').val();
                        from_location = jQuery.trim(from_location);
                        if (typeof from_location == "undefined" || from_location == "" || from_location == 0) {
                            all_errors_check = 0;
                        }
                    }
                }
                if (from_location == "") {
                    if (jQuery('input[name="from_location"]').length > 0) {
                        from_location = jQuery('input[name="from_location"]').val();
                        from_location = jQuery.trim(from_location);
                        if (typeof from_location == "undefined" || from_location == "" || from_location == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var to_location = "";
                if (jQuery('select[name="to_location"]').is(":visible")) {
                    if (jQuery('select[name="to_location"]').length > 0) {
                        to_location = jQuery('select[name="to_location"]').val();
                        to_location = jQuery.trim(to_location);
                        if (typeof to_location == "undefined" || to_location == "" || to_location == 0) {
                            all_errors_check = 0;
                        }
                    }
                }
                if (to_location == "") {
                    if (jQuery('input[name="to_location"]').length > 0) {
                        to_location = jQuery('input[name="to_location"]').val();
                        to_location = jQuery.trim(to_location);
                        if (typeof to_location == "undefined" || to_location == "" || to_location == 0) {
                            all_errors_check = 0;
                        }
                    }
                }


                var selected_product = "";
                if (jQuery('select[name="selected_product"]').is(":visible")) {
                    if (jQuery('select[name="selected_product"]').length > 0) {
                        selected_product = jQuery('select[name="selected_product"]').val();
                        selected_product = jQuery.trim(selected_product);
                        if (typeof selected_product == "undefined" || selected_product == "" || selected_product == 0) {
                            all_errors_check = 0;
                        }
                    }
                }
                var selected_unit_type = "";
                if (jQuery('select[name="selected_unit_type"]').is(":visible")) {
                    if (jQuery('select[name="selected_unit_type"]').length > 0) {
                        selected_unit_type = jQuery('select[name="selected_unit_type"]').val();
                        selected_unit_type = jQuery.trim(selected_unit_type);
                        if (typeof selected_unit_type == "undefined" || selected_unit_type == "" || selected_unit_type == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_content = "";
                if (jQuery('select[name="selected_content"]').is(":visible")) {
                    if (jQuery('select[name="selected_content"]').length > 0) {
                        selected_content = jQuery('select[name="selected_content"]').val();
                        selected_content = jQuery.trim(selected_content);
                        if (typeof selected_content == "undefined" || selected_content == "" || selected_content == 0) {
                            all_errors_check = 0;
                        }
                    }
                }
                var selected_quantity = "";
                if (jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if (typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(selected_quantity) == false) {
                        all_errors_check = 0;
                    }
                    else if (parseFloat(selected_quantity) > 99999) {
                        all_errors_check = 0;
                    }
                }
                if (selected_quantity > 0 && selected_quantity != "") {
                    limit = $('input[name = "stock_limit"]').val();
                    negative = $('input[name = "stock_negative"]').val();
                    if (parseFloat(selected_quantity) > parseFloat(limit) && negative == 0) {
                        limit_errors_check = 0;
                    }
                }
                if (parseFloat(limit_errors_check) == 1 && parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (selected_product != "" && selected_unit_type != "" && godown != "") {
                        if (jQuery('input[name="product_id[]"]').length > 0) {
                            if (jQuery('input[name="unit_type[]"]').length > 0) {
                                jQuery('.product_material_table tbody').find('tr').each(function () {
                                    var prev_product_id = ""; var prev_unit_type = ""; var prev_content = "";
                                    prev_content = jQuery(this).find('input[name="content[]"]').val();
                                    prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                    prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                                    if (prev_product_id == selected_product && prev_unit_type == selected_unit_type) {
                                        if (selected_content != "") {
                                            if (prev_content == selected_content) {
                                                add = 0;
                                            }
                                        } else {
                                            add = 0;
                                        }
                                    }

                                });
                            }
                        }
                    }

                    if (parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);
                        var post_url = "material_action_changes.php?product_material_row_index=" + product_count + "&selected_product=" + selected_product + "&selected_unit_type=" + selected_unit_type + "&selected_quantity=" + selected_quantity + "&unit_subunit=" + globalVar + "&selected_content=" + selected_content + "&limit=" + limit + "&negative=" + negative;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                console.log(result);
                                if (jQuery('.product_material_table tbody').find('tr').length > 0) {
                                    jQuery('.product_material_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.product_material_table tbody').append(result);
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('select[name="selected_product"]').length > 0) {
                                    jQuery('select[name="selected_product"]').val('').trigger('change');
                                }
                                if (jQuery('.Product_Fix_field').length > 0) {
                                    jQuery('.Product_Fix_field').attr('disabled', true);
                                }
                                if (jQuery('#qty_limit').length > 0) {
                                    jQuery('#qty_limit').html('');
                                }

                                if (jQuery('select[name="location"]').length > 0) {
                                    if (jQuery('input[name="location"]').length > 0) {
                                        jQuery('input[name="location"]').attr('disabled', false);
                                        jQuery('input[name="location"]').val(location);
                                    }
                                    jQuery('select[name="location"]').attr('disabled', true);
                                }
                                if (jQuery('select[name="from_location"]').length > 0) {
                                    if (jQuery('input[name="from_location"]').length > 0) {
                                        jQuery('input[name="from_location"]').attr('disabled', false);
                                        jQuery('input[name="from_location"]').val(from_location);
                                    }
                                    jQuery('select[name="from_location"]').attr('disabled', true);
                                }
                                if (jQuery('select[name="to_location"]').length > 0) {
                                    if (jQuery('input[name="to_location"]').length > 0) {
                                        jQuery('input[name="to_location"]').attr('disabled', false);
                                        jQuery('input[name="to_location"]').val(to_location);

                                    }
                                    jQuery('select[name="to_location"]').attr('disabled', true);
                                }
                                calQtyTotal();
                            }
                        });
                    }
                    else {
                        jQuery('.product_material_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product & Type Already Exists</span>');
                    }
                }
                else {
                    if (all_errors_check == 0) {
                        jQuery('.product_material_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product & Qty Details</span>');
                    }
                    if (limit_errors_check == 0) {
                        jQuery('.product_material_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Stock Limit Exceeded</span>');
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function DeleteMaterialTransferRow(row_index, id_name) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                console.log(id_name + row_index);
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                // if (jQuery('#'+id_name+row_index).length == 0) {
                // 	if(jQuery('.Product_Fix_field').length > 0) {
                // 		jQuery('.Product_Fix_field').attr('disabled', false);
                // 	}
                // }
                if (id_name == 'product_row') {
                    if (jQuery('.product_row').length == 0) {
                        if (jQuery('select[name="location"]').length > 0) {
                            if (jQuery('input[name="location"]').length > 0) {
                                jQuery('input[name="location"]').val('');
                                jQuery('input[name="location"]').attr('disabled', true);
                            }
                            jQuery('select[name="location"]').attr('disabled', false);
                        }
                        if (jQuery('select[name="from_location"]').length > 0) {
                            if (jQuery('input[name="from_location"]').length > 0) {
                                jQuery('input[name="from_location"]').val('');
                                jQuery('input[name="from_location"]').attr('disabled', true);
                            }
                            jQuery('select[name="from_location"]').attr('disabled', false);
                        }
                        if (jQuery('select[name="to_location"]').length > 0) {
                            if (jQuery('input[name="to_location"]').length > 0) {
                                jQuery('input[name="to_location"]').val('');
                                jQuery('input[name="to_location"]').attr('disabled', true);
                            }
                            jQuery('select[name="to_location"]').attr('disabled', false);
                        }
                    }
                }
                calQtyTotal();
            }
            else {
                window.location.reload();
            }
        }
    });
}

function calcTotalQuantity() {
    var total = 0;
    jQuery('.product_material_table tbody').find('tr').each(function () {
        var quantity = jQuery(this).find('input[name="quantity[]"]').val();

        total = parseFloat(total) + parseFloat(quantity);
    });

    $('.total_quantity').html(total);
}

function DisableProduct_Fix_field() {
    if (jQuery('.Product_Fix_field').length > 0) {
        jQuery('.Product_Fix_field').attr('disabled', true);
    }
}

function SnoCalculation() {
    if (jQuery('.sno').length > 0) {
        var row_count = 0;
        row_count = jQuery('.sno').length;
        if (typeof row_count != "undefined" && row_count != null && row_count != 0 && row_count != "") {
            var j = 1;
            var sno = document.getElementsByClassName('sno');
            for (var i = row_count - 1; i >= 0; i--) {
                sno[i].innerHTML = j;
                j = parseInt(j) + 1;
            }
        }
    }
}

function calQtyTotal() {
    SnoCalculation();

    if (jQuery('.overall_qty').length > 0) {
        jQuery('.overall_qty').html('');
    }
    var quantity_total = 0;
    if (jQuery('.product_row').length > 0) {
        jQuery('.product_row').each(function () {
            var quantity = 0;
            if (jQuery(this).find('input[name="quantity[]"]').length > 0) {
                quantity = jQuery(this).find('input[name="quantity[]"]').val();
                quantity = jQuery.trim(quantity);
            }
            if (typeof quantity != "undefined" && quantity != "" && quantity != 0 && price_regex.test(quantity) == true) {
                quantity_total = parseFloat(quantity_total) + parseFloat(quantity);
            }
        });
        if (typeof quantity_total != "undefined" && quantity_total != "" && quantity_total != 0 && price_regex.test(quantity_total) == true) {
            quantity_total = quantity_total.toFixed(2);
            if (jQuery('.overall_qty').length > 0) {
                jQuery('.overall_qty').html(quantity_total);
            }
        }
    }
}