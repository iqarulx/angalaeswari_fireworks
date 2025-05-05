

function show_godown_magazine(product_group) {

    if (jQuery('input[name="product_group"]').length > 0) {
        product_group = jQuery('select[name="product_group"]').val();
        jQuery('input[name="product_group"]').val(product_group);
    }
    if (product_group == "1") {
        if ($(".div_selected_godown").length > 0) {
            $(".div_selected_godown").removeClass("d-none")
        }
        if ($(".div_selected_magazine").length > 0) {
            $(".div_selected_magazine").addClass("d-none")
        }
        if ($("select[name='selected_magazine_id']").length > 0) {
            $("select[name='selected_magazine_id']").val("").trigger("change")
        }
    }
    else if (product_group == "2") {
        if ($(".div_selected_magazine").length > 0) {
            $(".div_selected_magazine").removeClass("d-none")
        }
        if ($(".div_selected_godown").length > 0) {
            $(".div_selected_godown").addClass("d-none")
        }
        if ($("select[name='selected_godown_id']").length > 0) {
            $("select[name='selected_godown_id']").val("").trigger("change")
        }
    }
}

function location_type_value() {

    if (jQuery('input[name="location_type"]').length > 0) {
        location_type = jQuery('select[name="location_type"]').val();
        jQuery('input[name="location_type"]').val(location_type);
    }
}

function show_product(product_group) {

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "action_changes.php?show_purchase_product=1&selected_product_group=" + product_group;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {

                            if ($("select[name='product']").length > 0) {
                                $("select[name='product']").html(result);
                            }
                        }
                    }
                });
            }
        }
    });
}


function GetProdetails() {
    var product = $("select[name='product']").val();
    var selected_magazine_id = "";
    if ($("select[name='selected_magazine_id']").length > 0) {
        selected_magazine_id = $("select[name='selected_magazine_id']").val();
    }
    if ($("select[name='selected_godown_id']").length > 0) {
        selected_godown_id = $("select[name='selected_godown_id']").val();
    }
    if ($("select[name='contains']").length > 0) {
        $("select[name='contains']").html('');
    }
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "stock_adjustment_table.php?change_product_id=" + product + "&selected_magazine_id=" + selected_magazine_id + "&selected_godown_id=" + selected_godown_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            result = result.split("$$");
                            if ($("select[name='selected_unit_type']").length > 0) {
                                $("select[name='selected_unit_type']").empty().append(result[0]);
                            }
                            window.globalVar = result[1].split("%%");
                            if (result[4] != "" && result[4] != "NULL") {
                                $("#contents_div").removeClass("d-none");
                                if (result[2] != "" && result[2] != "NULL") {
                                    if ($("select[name='contains']").length > 0) {
                                        $("select[name='contains']").html(result[2]);
                                    }
                                }
                            } else {
                                $("input[name='content']").val("");
                                $("#contents_div").addClass("d-none");
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

                        }
                        GetStockLimit();

                    }
                });
            }
        }
    });
}
function GetStockLimit() {


    var product = $('select[name="product"]').val();
    var unit_type = jQuery('select[name="selected_unit_type"]').val();
    var content = ""; var product_group = ""; var selected_magazine_id = ""; var selected_godown_id = "";
    if ($('select[name="contains"]').length > 0) {
        content = $('select[name="contains"]').val();
    }
    if ($('select[name="product_group"]').length > 0) {
        product_group = $('select[name="product_group"]').val();
    }
    if ($('select[name="selected_magazine_id"]').length > 0) {
        selected_magazine_id = $('select[name="selected_magazine_id"]').val();
    }
    if ($('select[name="selected_godown_id"]').length > 0) {
        selected_godown_id = $('select[name="selected_godown_id"]').val();
    }
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "stock_adjustment_table.php?get_limit_product=" + product + "&unit_type=" + unit_type + "&content=" + content + "&product_group=" + product_group + "&selected_godown_id=" + selected_godown_id + "&selected_magazine_id=" + selected_magazine_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            if (jQuery('input[name="stock_limit"]').length > 0) {
                                jQuery('input[name="stock_limit"]').val(result);
                            }
                            if (product != "") {

                                if (jQuery('#qty_limit').length > 0) {
                                    jQuery('#qty_limit').html("Current Stock : <span class='text-danger' style='font-weight:bold'>" + result + "</span>");
                                }
                            } else {
                                if (jQuery('#qty_limit').length > 0) {
                                    jQuery('#qty_limit').html('');
                                }
                            }
                        } else {
                            if (jQuery('#qty_limit').length > 0) {
                                jQuery('#qty_limit').html('');
                            }
                        }
                    }
                });
            }
        }
    });
}


// function AddStockAdjustmentProducts() {
//     var check_login_session = 1; var all_errors_check = 1;
// 	var post_url = "dashboard_changes.php?check_login_session=1";
// 	jQuery.ajax({
// 		url: post_url, success: function (check_login_session) {
// 			if (check_login_session == 1) {
//                 if(jQuery('#qty_limit').length > 0) {
//                     jQuery('#qty_limit').html('');
//                 }

// 				if (jQuery('.infos').length > 0) {
// 					jQuery('.infos').each(function() { jQuery(this).remove(); });
// 				}

//                 var category_id = "";
//                 if(jQuery('select[name="category_id"]').length > 0) {
//                     category_id = jQuery('select[name="category_id"]').val();
//                     category_id = jQuery.trim(category_id);
//                     if(typeof category_id == "undefined" || category_id == "" || category_id == 0) {
//                         all_errors_check = 0;
//                     }
//                 }

//                 var godown_id = "";
//                 if(jQuery('select[name="godown_id"]').is(":visible")) {
//                     if(jQuery('select[name="godown_id"]').length > 0) {
//                         godown_id = jQuery('select[name="godown_id"]').val();
//                         godown_id = jQuery.trim(godown_id);
//                         if(typeof godown_id == "undefined" || godown_id == "" || godown_id == 0) {
//                             all_errors_check = 0;
//                         }
//                     }
//                 }

//                 var magazine_id = "";
//                 if(jQuery('select[name="magazine_id"]').is(":visible")) {
//                     if(jQuery('select[name="magazine_id"]').length > 0) {
//                         magazine_id = jQuery('select[name="magazine_id"]').val();
//                         magazine_id = jQuery.trim(magazine_id);
//                         if(typeof magazine_id == "undefined" || magazine_id == "" || magazine_id == 0) {
//                             all_errors_check = 0;
//                         }
//                     }
//                 }

//                 var selected_product_id = "";
//                 if(jQuery('select[name="selected_product_id"]').is(":visible")) {
//                     if(jQuery('select[name="selected_product_id"]').length > 0) {
//                         selected_product_id = jQuery('select[name="selected_product_id"]').val();
//                         selected_product_id = jQuery.trim(selected_product_id);
//                         if(typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
//                             all_errors_check = 0;
//                         }
//                     }
//                 }

//                 var selected_unit_id = "";
//                 if(jQuery('select[name="selected_unit_id"]').length > 0) {
//                     selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
//                     selected_unit_id = jQuery.trim(selected_unit_id);
//                     if(typeof selected_unit_id == "undefined" || selected_unit_id == "" || selected_unit_id == 0) {
//                         all_errors_check = 0;
//                     }
//                 }

//                 var selected_quantity = "";
//                 if(jQuery('input[name="selected_quantity"]').length > 0) {
//                     selected_quantity = jQuery('input[name="selected_quantity"]').val();
//                     selected_quantity = jQuery.trim(selected_quantity);
//                     if(typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
//                         all_errors_check = 0;
//                     }
//                     else if(price_regex.test(selected_quantity) == false) {
//                         all_errors_check = 0;
//                     }
//                     else if(parseFloat(selected_quantity) > 99999) {
//                         all_errors_check = 0;
//                     }
//                 }

//                 var selected_stock_action = "";
//                 if(jQuery('select[name="selected_stock_action"]').length > 0) {
//                     selected_stock_action = jQuery('select[name="selected_stock_action"]').val();
//                     selected_stock_action = jQuery.trim(selected_stock_action);
//                     if(typeof selected_stock_action == "undefined" || selected_stock_action == "" || selected_stock_action == 0) {
//                         all_errors_check = 0;
//                     }
//                 }

//                 if(parseFloat(all_errors_check) == 1) {
//                     var add = 1;
//                     if(selected_product_id != "") {
//                         if(jQuery('input[name="product_id[]"]').length > 0) {
//                             jQuery('.stockadjustment_product_table tbody').find('tr').each(function () {
//                                 var prev_product_id = ""; var prev_unit_id = "";
//                                 prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
//                                 if(jQuery(this).find('input[name="unit_id[]"]').length > 0) {
//                                     prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
//                                 }
//                                 if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id) {
//                                     add = 0;
//                                 }
//                             });
//                         }
//                     }
//                     if(parseFloat(add) == 1) {
//                         var product_count = 0;
//                         product_count = jQuery('input[name="product_count"]').val();
//                         product_count = parseInt(product_count) + 1;
//                         jQuery('input[name="product_count"]').val(product_count);

//                         var post_url = "stock_adjustment_table.php?product_row_index="+product_count+"&selected_product_id="+selected_product_id+"&selected_unit_id="+selected_unit_id+"&selected_quantity="+selected_quantity+"&selected_stock_action="+selected_stock_action;

//                         jQuery.ajax({
//                             url: post_url, success: function (result) {
//                                 if (jQuery('.stockadjustment_product_table tbody').find('tr').length > 0) {
//                                     jQuery('.stockadjustment_product_table tbody').find('tr:first').before(result);
//                                 }
//                                 else {
//                                     jQuery('.stockadjustment_product_table tbody').append(result);
//                                 }
//                                 if(jQuery('select[name="category_id"]').length > 0) {
//                                     jQuery('select[name="category_id"]').attr('disabled', true);
//                                 }
//                                 if(jQuery('input[name="category_id"]').length > 0) {
//                                     jQuery('input[name="category_id"]').attr('disabled', false);
//                                     jQuery('input[name="category_id"]').val(category_id);
//                                 }
//                                 if(jQuery('select[name="godown_id"]').length > 0) {
//                                     jQuery('select[name="godown_id"]').attr('disabled', true);
//                                     if(jQuery('input[name="godown_id"]').length > 0) {
//                                         if(godown_id != "") {
//                                             jQuery('input[name="godown_id"]').attr('disabled', false);
//                                             jQuery('input[name="godown_id"]').val(godown_id);
//                                         }
//                                     }
//                                 }

//                                 if(jQuery('select[name="magazine_id"]').length > 0) {
//                                     jQuery('select[name="magazine_id"]').attr('disabled', true);
//                                     if(jQuery('input[name="magazine_id"]').length > 0) {
//                                         if(magazine_id != "") {
//                                             jQuery('input[name="magazine_id"]').attr('disabled', false);
//                                             jQuery('input[name="magazine_id"]').val(magazine_id);
//                                         }
//                                     }
//                                 }
//                                 if(jQuery('#qty_limit').length > 0) {
//                                     jQuery('#qty_limit').html('');
//                                 }

//                                 if(jQuery('select[name="selected_product_id"]').length > 0) {
//                                     jQuery('select[name="selected_product_id"]').val('').trigger('change').select2('open');
//                                 }
//                                 if(jQuery('select[name="selected_unit_id"]').length > 0) {
//                                     jQuery('select[name="selected_unit_id"]').val('').trigger('change');
//                                 }
//                                 if(jQuery('input[name="selected_quantity"]').length > 0) {
//                                     jQuery('input[name="selected_quantity"]').val('');
//                                 }
//                                 if(jQuery('select[name="selected_stock_action"]').length > 0) {
//                                     jQuery('select[name="selected_stock_action"]').val('').trigger('change');
//                                 }
//                                 calTotal();
//                             }
//                         });
//                     }
//                     else {
//                         jQuery('.stockadjustment_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product Already Exists</span>');
//                     }
//                 }
//                 else {
//                     jQuery('.stockadjustment_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product Details</span>');
//                 }
// 			}
// 			else {
// 				window.location.reload();
// 			}
// 		}
// 	});
// }

function AddStockAdjustmentProducts() {
    var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1;
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

                var product_group = "";
                if (jQuery('select[name="product_group"]').length > 0) {
                    product_group = jQuery('select[name="product_group"]').val();
                    product_group = jQuery.trim(product_group);
                    if (typeof product_group == "undefined" || product_group == "" || product_group == 0) {
                        all_errors_check = 0;
                    }
                }

                var location_type = ""; var error = "";
                if (jQuery('select[name="location_type"]').length > 0) {
                    location_type = jQuery('select[name="location_type"]').val();
                    location_type = location_type.trim();
                    if (typeof location_type == "undefined" || location_type == "" || location_type == 0) {
                        all_errors_check = 0;
                        error = "Select Location Type";
                    }
                }

                if (product_group == 1) {
                    var selected_godown_id = ""; var error = "";
                    if (jQuery('select[name="selected_godown_id"]').length > 0) {
                        selected_godown_id = jQuery('select[name="selected_godown_id"]').val();
                        selected_godown_id = selected_godown_id.trim();
                        if (typeof selected_godown_id == "undefined" || selected_godown_id == "" || selected_godown_id == 0) {
                            all_errors_check = 0;
                            error = "Select Godown";
                        }
                        location_id = selected_godown_id;
                    }
                    if (selected_godown_id == "") {
                        if (jQuery('[name="selected_godown_id"]').length > 0) {
                            selected_godown_id = jQuery('input[name="selected_godown_id"]').val();
                            selected_godown_id = selected_godown_id.trim();
                            if (typeof selected_godown_id == "undefined" || selected_godown_id == "" || selected_godown_id == 0) {
                                all_errors_check = 0;
                                error = "Select Godown";
                            }
                        }
                        location_id = selected_godown_id;
                    }

                } else {
                    var selected_magazine_id = ""; var error = "";
                    if (jQuery('select[name="selected_magazine_id"]').length > 0) {
                        selected_magazine_id = jQuery('select[name="selected_magazine_id"]').val();
                        selected_magazine_id = selected_magazine_id.trim();
                        if (typeof selected_magazine_id == "undefined" || selected_magazine_id == "" || selected_magazine_id == 0) {
                            all_errors_check = 0;
                            error = "Select Magazine";
                        }
                        location_id = selected_magazine_id;
                    }
                    if (selected_magazine_id == "") {
                        if (jQuery('[name="selected_magazine_id"]').length > 0) {
                            selected_magazine_id = jQuery('input[name="selected_magazine_id"]').val();
                            selected_magazine_id = selected_magazine_id.trim();
                            if (typeof selected_magazine_id == "undefined" || selected_magazine_id == "" || selected_magazine_id == 0) {
                                all_errors_check = 0;
                                error = "Select Godown";
                            }
                        }
                        location_id = selected_magazine_id;
                    }

                }


                var product = "";
                if (jQuery('select[name="product"]').is(":visible")) {
                    if (jQuery('select[name="product"]').length > 0) {
                        product = jQuery('select[name="product"]').val();
                        product = jQuery.trim(product);
                        if (typeof product == "undefined" || product == "" || product == 0) {
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

                var content = "";
                if (jQuery('select[name="contains"]').is(":visible")) {

                    if (jQuery('select[name="contains"]').is(":visible")) {
                        if (jQuery('select[name="contains"]').length > 0) {
                            content = jQuery('select[name="contains"]').val();
                            content = jQuery.trim(content);
                            if ((typeof content == "undefined" || content == "" || content == 0)) {
                                all_errors_check = 0;
                            }
                            else if (numbers_regex.test(content) == false) {
                                all_errors_check = 0;
                            }
                            else if (parseFloat(content) > 99999) {
                                all_errors_check = 0;
                            }
                        }
                    }
                }
                var selected_stock_action = "";
                if (jQuery('select[name="selected_stock_action"]').length > 0) {
                    selected_stock_action = jQuery('select[name="selected_stock_action"]').val();
                    selected_stock_action = jQuery.trim(selected_stock_action);
                    if (typeof selected_stock_action == "undefined" || selected_stock_action == "" || selected_stock_action == 0) {
                        all_errors_check = 0;
                    }
                }

                if (parseFloat(all_errors_check) == 1 && parseFloat(unit_sub_error) == 1) {
                    var add = 1;
                    if (product != "" && selected_unit_type != "") {
                        if (jQuery('input[name="location_id[]"]').length > 0) {
                            if (jQuery('input[name="product_id[]"]').length > 0) {
                                if (jQuery('input[name="unit_type[]"]').length > 0) {
                                    if (jQuery('input[name="content[]"]').length > 0) {
                                        jQuery('.stockadjustment_product_table tbody').find('tr').each(function () {
                                            var prev_product_id = ""; var prev_unit_type = ""; var prev_location_id = ""; var prev_content = "";
                                            prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                            prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                                            prev_location_id = jQuery(this).find('input[name="location_id[]"]').val();
                                            prev_content = jQuery(this).find('input[name="content[]"]').val();
                                            if (jQuery('select[name="contains"]').is(":visible")) {
                                                if (prev_product_id == product && prev_unit_type == selected_unit_type && prev_location_id == location_id && prev_content == content) {
                                                    add = 0;
                                                }
                                            } else {
                                                if (prev_product_id == product && prev_unit_type == selected_unit_type && prev_location_id == location_id) {
                                                    add = 0;
                                                }
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    }
                    if (parseFloat(add) == 1) {

                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);

                        var post_url = "stock_adjustment_table.php?product_row_index=" + product_count + "&product=" + product + "&unit_type=" + selected_unit_type + "&selected_quantity=" + selected_quantity + "&content=" + content + "&unit_subunit=" + globalVar + "&product_group=" + product_group + "&selected_stock_action=" + selected_stock_action + "&selected_magazine_id=" + selected_magazine_id + "&selected_godown_id=" + selected_godown_id;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.stockadjustment_product_table tbody').find('tr').length > 0) {
                                    jQuery('.stockadjustment_product_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.stockadjustment_product_table tbody').append(result);
                                }
                                var location_type = "";
                                if ($("select[name='location_type']").length > 0) {
                                    $("select[name='location_type']").attr("disabled", true)
                                    location_type = $("select[name='location_type']").val();
                                    $("select[name='product_group']").attr("disabled", true)
                                    $("input[name='product_group']").attr("disabled", false)
                                    $("input[name='location_type']").attr("disabled", false)
                                    $("input[name='product_group']").val(product_group)
                                    $("input[name='location_type']").val(location_type)



                                    if (location_type == "1") {
                                        if (product_group == "1") {
                                            $("select[name='selected_godown_id']").attr("disabled", true)
                                        }
                                        else if (product_group == "2") {
                                            $("select[name='selected_magazine_id']").attr("disabled", true)
                                        }
                                    }
                                    else if (location_type == "2") {
                                        if (product_group == "1") {
                                            $("select[name='selected_godown_id']").attr("disabled", false)
                                        }
                                        else if (product_group == "2") {
                                            $("select[name='selected_magazine_id']").attr("disabled", false)
                                        }
                                    }
                                }
                                if (location_type == "1") {
                                    if (selected_godown_id != "") {
                                        $("select[name='selected_godown_id']").attr("disabled", true)
                                        $("input[name='selected_godown_id']").attr("disabled", false)

                                        if (jQuery('input[name="selected_godown_id"]').length > 0) {
                                            jQuery('input[name="selected_godown_id"]').val(selected_godown_id);
                                        }
                                    }
                                } else {
                                    if (jQuery('select[name="selected_godown_id"]').length > 0) {
                                        jQuery('select[name="selected_godown_id"]').val('');
                                    }
                                    if (jQuery('select[name="selected_magazine_id"]').length > 0) {
                                        jQuery('select[name="selected_magazine_id"]').val('');
                                    }
                                }

                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('select[name="product"]').length > 0) {
                                    jQuery('select[name="product"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="contains"]').length > 0) {
                                    jQuery('select[name="contains"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_unit_type"]').length > 0) {
                                    jQuery('select[name="selected_unit_type"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_stock_action"]').length > 0) {
                                    jQuery('select[name="selected_stock_action"]').val('').trigger('change');
                                }
                                if (jQuery('#qty_limit').length > 0) {
                                    jQuery('#qty_limit').html('');
                                }
                                calcTotalQuantity();
                            }
                        });

                    }
                    else {
                        if (error == "") {
                            if (jQuery('select[name="contains"]').is(":visible")) {

                                jQuery('.stockadjustment_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product ,Unit & Contains Already Exists</span>');
                            } else {
                                jQuery('.stockadjustment_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product ,Unit Already Exists</span>');
                            }
                        }
                        else {
                            jQuery('.stockadjustment_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">' + error + '</span>');
                        }
                    }
                }
                else {
                    if (all_errors_check == 0) {
                        jQuery('.stockadjustment_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product & Qty Details</span>');
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
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


function calcTotalQuantity() {
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

function DeleteStockAdjRow(row_index, id_name) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }

                if (id_name == 'product_row') {
                    if (jQuery('.product_row').length == 0) {
                        if (jQuery('select[name="product_group"]').length > 0) {
                            if (jQuery('input[name="product_group"]').length > 0) {
                                jQuery('input[name="product_group"]').val('');
                                jQuery('input[name="product_group"]').attr('disabled', true);
                            }
                            jQuery('select[name="product_group"]').attr('disabled', false);
                        }
                        if (jQuery('select[name="location_type"]').length > 0) {
                            if (jQuery('input[name="location_type"]').length > 0) {
                                jQuery('input[name="location_type"]').val('');
                                jQuery('input[name="location_type"]').attr('disabled', true);
                            }
                            jQuery('select[name="location_type"]').attr('disabled', false);
                        }
                        if (jQuery('select[name="selected_godown_id"]').length > 0) {
                            if (jQuery('input[name="selected_godown_id"]').length > 0) {
                                jQuery('input[name="selected_godown_id"]').val('');
                                jQuery('input[name="selected_godown_id"]').attr('disabled', true);
                            }
                            jQuery('select[name="selected_godown_id"]').attr('disabled', false);
                        }
                        if (jQuery('select[name="selected_magazine_id"]').length > 0) {
                            if (jQuery('input[name="selected_magazine_id"]').length > 0) {
                                jQuery('input[name="selected_magazine_id"]').val('');
                                jQuery('input[name="selected_magazine_id"]').attr('disabled', true);
                            }
                            jQuery('select[name="selected_magazine_id"]').attr('disabled', false);
                        }
                    }
                }
                calcTotalQuantity();
            }
            else {
                window.location.reload();
            }
        }
    });
}
