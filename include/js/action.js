// Product , contractor, purchase Entry, Consumption Entry screens js
var price_regex = /^(\d*\.)?\d+$/;
function GetContractorProdetails() {
    if (jQuery("select[name='product']").length > 0) {
        var product = jQuery("select[name='product']").val();
    }
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery("select[name='godown']").length > 0) {
                    var godown = jQuery("select[name='godown']").val();
                }
                post_url = "action_changes.php?change_product_id=" + product + "&godown_id=" + godown;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            result = result.split("$$");
                            if (jQuery("select[name='selected_unit_type']").length > 0) {
                                jQuery("select[name='selected_unit_type']").empty().append(result[0]);
                            }
                            if (jQuery("select[name='purchase_per_type']").length > 0) {
                                jQuery("select[name='purchase_per_type']").empty().append(result[0]);
                            }
                            window.globalVar = result[1].split("%%");
                            if (result[2] != "") {
                                if (jQuery("select[name='selected_consumption_content']").length > 0) {
                                    jQuery("#contents_div").removeClass("d-none");
                                    jQuery("select[name='selected_consumption_content']").empty().append(result[2]);
                                    GetStockLimit();
                                }
                            } else {
                                if (jQuery("select[name='selected_consumption_content']").length > 0) {
                                    jQuery("#contents_div").addClass("d-none");
                                }
                            }
                            if (result[3] != "") {
                                if (jQuery("input[name = 'stock_negative']").length > 0) {
                                    jQuery("input[name = 'stock_negative']").val(result[3]);
                                }
                            } else {
                                if (jQuery("input[name = 'stock_negative']").length > 0) {
                                    jQuery("input[name = 'stock_negative']").val(0);
                                }
                            }
                        }
                    }
                });
            }
        }
    });
}


function GetProdetails() {
    if (jQuery('.current_stock_div').length > 0) {
        jQuery('.current_stock_div').html('');
    }
    if (jQuery('.contains_div').length > 0) {
        jQuery('.contains_div').addClass('d-none');
    }

    if (jQuery("select[name='product']").length > 0) {
        var product_id = jQuery("select[name='product']").val();
    }


    if (jQuery('select[name="godown_type"]').length > 0) {
        godown_type = jQuery('select[name="godown_type"]').val();
    }

    var godown_id = "";
    if (godown_type == 1) {
        if (jQuery('select[name="overall_godown"]').length > 0) {
            godown_id = jQuery('select[name="overall_godown"]').val();
            godown_id = jQuery.trim(godown_id);
        } else {
            if (jQuery('input[name="overall_godown"]').length > 0) {
                godown_id = jQuery('input[name="overall_godown"]').val();
                godown_id = jQuery.trim(godown_id);
            }
        }
    } else {
        if (jQuery('select[name="indv_godown"]').length > 0) {
            godown_id = jQuery('select[name="indv_godown"]').val();
            godown_id = jQuery.trim(godown_id);
        }
    }
    var post_url = "consumption_entry_changes.php?get_unit=" + product_id + "&product_godown_id=" + godown_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            result = result.split("$$$");
            if (jQuery('select[name="selected_unit_type"]').length > 0) {
                jQuery('select[name="selected_unit_type"]').html(result[0]);
            }
            if (jQuery('.current_stock_div').length > 0) {
                jQuery('.current_stock_div').html(result[1]);
            }
            if (result[2] != "") {
                if (jQuery('.contains_div').length > 0) {
                    jQuery('.contains_div').removeClass('d-none');
                }

                if (jQuery('select[name="selected_content"]').length > 0) {
                    jQuery('select[name="selected_content"]').html(result[2]);
                }
            }

            if (product_id != "" && typeof product_id != "undefined" && product_id != null) {
                if (jQuery('input[name="selected_quantity"]').length > 0) {
                    jQuery('input[name="selected_quantity"]').focus();
                }
            }
        }
    });
}

function CalculateTotalRate() {
    var total_rate = 0;
    $('input[name="rate[]"]').each(function () {
        var val = parseFloat($(this).val());
        if (!isNaN(val)) {
            total_rate += val;
        }
    });

    if (jQuery('input[name="total_rate"]').length > 0) {
        jQuery('input[name="total_rate"]').val(total_rate);
    }
    if (jQuery('#total_rate_td').length > 0) {
        jQuery('#total_rate_td').html(total_rate.toFixed(2));
    }
}

function CalculateTotalQuantity() {
    var total_quantity = 0;
    $('input[name="quantity[]"]').each(function () {
        var val = parseFloat($(this).val());
        if (!isNaN(val)) {
            total_quantity += val;
        }
    });

    if (jQuery('#total_qty_td').length > 0) {
        jQuery('#total_qty_td').html(total_quantity);
    }
}

function GST(obj, gst_option) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var option = 1;
                if (jQuery('#gst_option').prop('checked') == false) {
                    option = 0;
                }
                if (jQuery(obj).parent().find('input[name="gst_option"]').length > 0) {
                    jQuery(obj).parent().find('input[name="gst_option"]').val(option);
                }

                if (option == 1) {
                    if (jQuery('.tax_cover').length > 0) {
                        jQuery('.tax_cover').removeClass("d-none");
                    }
                    if (jQuery('.tax_cover1').length > 0) {
                        jQuery('.tax_cover1').removeClass("d-none");
                    }
                    if (jQuery('.tax_cover2').length > 0) {
                        jQuery('.tax_cover2').removeClass("d-none");
                    }
                }
                else {
                    if (jQuery('.tax_cover2').length > 0) {
                        jQuery('.tax_cover2').addClass("d-none");
                    }
                    if (jQuery('.tax_cover').length > 0) {
                        jQuery('.tax_cover').addClass("d-none");
                        jQuery('.tax_cover1').addClass("d-none");
                        jQuery('.tax_cover2').addClass("d-none");
                    }
                }
                getGST();
            }
            else {
                window.location.reload();
            }
        }
    });
}
function getGST() {
    if (jQuery('span.infos').length > 0) {
        jQuery('span.infos').remove();
    }
    var gst_option = ""; var tax_option = ""; var tax_type = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = jQuery.trim(gst_option);
    }
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = jQuery.trim(tax_option);
    }
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = jQuery.trim(tax_type);
    }
    var company_state = "";
    if (jQuery('input[name="company_state"]').length > 0) {
        company_state = jQuery('input[name="company_state"]').val();
        company_state = jQuery.trim(company_state);
    }
    var party_state = "";
    if (jQuery('input[name="party_state"]').length > 0) {
        party_state = jQuery('input[name="party_state"]').val();
        party_state = jQuery.trim(party_state);
    }
    var addcol = 0;
    if (gst_option == 1) {
        if (parseInt(tax_type) == 1) {
            if (jQuery('.tax_cover2').length > 0) {
                jQuery('.tax_cover2').addClass('d-none');
            }
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').removeClass('d-none');
            }
            addcol = 1;
        }
        else {
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').addClass('d-none');
            }

            if (jQuery('.tax_cover2').length > 0) {
                jQuery('.tax_cover2').removeClass('d-none');
            }
        }
    } else {
        if (parseInt(tax_type) == 1) {
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').addClass('d-none');
            }
        }

    }

    $(".sub_tot").attr('colspan', 7 + parseInt(addcol));
    $(".charges_head").attr('colspan', 3 + parseInt(addcol));
    $(".charges_sub").attr('colspan', 7 + parseInt(addcol));
    $(".cgst").attr('colspan', 7 + parseInt(addcol));
    $(".sgst").attr('colspan', 7 + parseInt(addcol));
    $(".igst").attr('colspan', 7 + parseInt(addcol));
    $(".total_tax").attr('colspan', 7 + parseInt(addcol));
    $(".round").attr('colspan', 7 + parseInt(addcol));
    $(".grand_total").attr('colspan', 7 + parseInt(addcol));

    if (parseInt(gst_option) == 1) {
        if (company_state == party_state) {
            if (jQuery('.cgst_value').length > 0) {
                jQuery('.cgst_value').parent().removeClass('d-none');
            }
            if (jQuery('.sgst_value').length > 0) {
                jQuery('.sgst_value').parent().removeClass('d-none');
            }
            if (jQuery('.igst_value').length > 0) {
                jQuery('.igst_value').parent().addClass('d-none');
            }
        }
        else {
            if (jQuery('.cgst_value').length > 0) {
                jQuery('.cgst_value').parent().addClass('d-none');
            }
            if (jQuery('.sgst_value').length > 0) {
                jQuery('.sgst_value').parent().addClass('d-none');
            }
            if (jQuery('.igst_value').length > 0) {
                jQuery('.igst_value').parent().removeClass('d-none');
            }
        }
        if (jQuery('.total_tax_value').length > 0) {
            jQuery('.total_tax_value').parent().removeClass('d-none');
        }
    }
    else {
        if (jQuery('.cgst_value').length > 0) {
            jQuery('.cgst_value').parent().addClass('d-none');
        }
        if (jQuery('.sgst_value').length > 0) {
            jQuery('.sgst_value').parent().addClass('d-none');
        }
        if (jQuery('.igst_value').length > 0) {
            jQuery('.igst_value').parent().addClass('d-none');
        }
        if (jQuery('.total_tax_value').length > 0) {
            jQuery('.total_tax_value').parent().addClass('d-none');
        }
    }

    checkGST();
}

function checkGST() {
    var gst_option = ""; var tax_type = ""; var tax_option = ""; var cgst_value = 0; var sgst_value = 0; var igst_value = 0;
    var total_tax_value = 0; var greater_tax = 0; var str_tax = 0; var overall_tax_value = 0; var total_value = 0; var product_tax = "";
    var charges_sub_total = 0;
    if (jQuery('.cgst_value').length > 0) {
        jQuery('.cgst_value').html('');
    }
    if (jQuery('.sgst_value').length > 0) {
        jQuery('.sgst_value').html('');
    }
    if (jQuery('.igst_value').length > 0) {
        jQuery('.igst_value').html('');
    }
    if (jQuery('.total_tax_value').length > 0) {
        jQuery('.total_tax_value').html('');
    }
    if (jQuery('.round_off').length > 0) {
        jQuery('.round_off').html('');
    }
    if (jQuery('.overall_total').length > 0) {
        jQuery('.overall_total').html('');
    }
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = jQuery.trim(gst_option);
    }
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = jQuery.trim(tax_option);
    }
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = jQuery.trim(tax_type);
    }
    var sub_total = 0;
    if (jQuery('.sub_total').length > 0) {
        sub_total = jQuery('.sub_total').html();
        sub_total = jQuery.trim(sub_total);
    }
    var extra_charges_value = 0;
    if (jQuery('.extra_charges_value').length > 0) {
        extra_charges_value = jQuery('.extra_charges_value').html();
        extra_charges_value = jQuery.trim(extra_charges_value);
    }
    var extra_charges_total = 0;
    if (jQuery('.extra_charges_total').length > 0) {
        extra_charges_total = jQuery('.extra_charges_total').html();
        extra_charges_total = jQuery.trim(extra_charges_total);
    }
    var charges_sub_total = 0;
    if (jQuery('.charges_sub_total').length > 0) {
        charges_sub_total = jQuery('.charges_sub_total').last().html();
        charges_sub_total = jQuery.trim(charges_sub_total);
    }
    var company_state = "";
    if (jQuery('input[name="company_state"]').length > 0) {
        company_state = jQuery('input[name="company_state"]').val();
        company_state = jQuery.trim(company_state);
    }
    var party_state = "";
    if (jQuery('input[name="party_state"]').length > 0) {
        party_state = jQuery('input[name="party_state"]').val();
        party_state = jQuery.trim(party_state);
    }
    if (parseInt(gst_option) == 1) {
        if (parseInt(tax_type) == 1) {
            if (jQuery('.purchase_product_row').length > 0) {
                jQuery('.purchase_product_row').each(function () {
                    var amount = 0; var discount = ""; var discounted_amount = 0; var tax_percentage = ""; var tax = "";
                    var tax_value = 0;
                    amount = jQuery(this).find('input[name="entry_amount[]"]').val();
                    amount = amount.replace(/ /g, '');
                    amount = amount.trim();
                    if (jQuery(this).find('select[name="product_tax[]"]').length > 0) {
                        tax_percentage = jQuery(this).find('select[name="product_tax[]"]').val();
                        tax_percentage = tax_percentage.trim();
                        tax = tax_percentage.replace('%', '');
                        tax = tax.trim();
                    }
                    if (parseFloat(tax) > parseFloat(str_tax)) {
                        greater_tax = tax;
                    }
                    else {
                        greater_tax = str_tax;
                    }
                    str_tax = greater_tax;
                    if (amount != "" && amount != 0 && typeof amount != "undefined" && price_regex.test(amount) == true) {
                        if (jQuery('input[name="discount"]').length > 0) {
                            discount = jQuery('input[name="discount"]').val();
                            discount = discount.trim();
                        }
                        if (discount != "" && discount != 0 && typeof discount != "undefined") {
                            if (discount.indexOf('%') != -1) {
                                discount = discount.replace('%', '');
                                discount = discount.trim();
                                if ((price_regex.test(discount) == true) && (parseFloat(discount) > 0) && (parseFloat(discount) <= 100)) {
                                    discounted_amount = amount - ((parseFloat(amount) * parseFloat(discount)) / 100);
                                    discounted_amount = discounted_amount.toFixed(2);
                                }
                            }
                            else {
                                if ((price_regex.test(discount) == true) && (parseFloat(discount) > 0) && (parseFloat(discount) <= parseFloat(sub_total))) {
                                    var discount_percent = "";
                                    discount_percent = (discount / sub_total) * 100;
                                    discounted_amount = amount - ((parseFloat(amount) * parseFloat(discount_percent)) / 100);
                                    discounted_amount = discounted_amount.toFixed(2);
                                }
                            }
                        }
                        else {
                            discounted_amount = amount;
                        }
                        if (discounted_amount != "" && discounted_amount != 0 && typeof discounted_amount != "undefined" && price_regex.test(discounted_amount) == true) {
                            tax_value = (parseFloat(discounted_amount) * parseFloat(tax)) / 100;
                            total_tax_value = parseFloat(total_tax_value) + parseFloat(tax_value);
                        }
                    }
                });

                var extra_charges_tax = 0;
                if (extra_charges_value != "" && extra_charges_value != 0 && typeof extra_charges_value != "undefined" && price_regex.test(extra_charges_value) == true && greater_tax != "" && greater_tax != 0) {
                    extra_charges_tax = (parseFloat(extra_charges_value) * parseFloat(greater_tax)) / 100;
                    total_tax_value = parseFloat(total_tax_value) + parseFloat(extra_charges_tax);
                }
                overall_tax_value = total_tax_value;
                overall_tax_value = overall_tax_value.toFixed(2);
                if (overall_tax_value != "" && overall_tax_value != 0 && typeof overall_tax_value != "undefined" && price_regex.test(overall_tax_value) == true) {
                    if (company_state == party_state) {
                        cgst_value = parseFloat(overall_tax_value) / 2;
                        cgst_value = cgst_value.toFixed(2);
                        sgst_value = parseFloat(overall_tax_value) / 2;
                        sgst_value = sgst_value.toFixed(2);
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').html(cgst_value);
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').html(sgst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').parent().find('td:first').html('CGST :');
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').parent().find('td:first').html('SGST :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax :');
                        }
                    }
                    else {
                        igst_value = overall_tax_value;
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').html(igst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').parent().find('td:first').html('IGST :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax :');
                        }
                    }
                }
            }
        }
        else if (parseInt(tax_type) == 2) {
            var overall_tax = ""; var tax_percentage = "";
            if (jQuery('select[name="overall_tax"]').length > 0) {
                overall_tax = jQuery('select[name="overall_tax"]').val();
            }
            if (overall_tax != 0 && overall_tax != "" && typeof overall_tax != "undefined") {
                overall_tax = overall_tax.trim();
                tax_percentage = overall_tax;
                overall_tax = overall_tax.replace('%', '');
                overall_tax = overall_tax.trim();
                if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {
                    overall_tax_value = (parseFloat(charges_sub_total) * parseFloat(overall_tax)) / 100;
                    overall_tax_value = overall_tax_value.toFixed(2);
                }
                if (overall_tax_value != "" && typeof overall_tax_value != "undefined" && price_regex.test(overall_tax_value) == true) {
                    if (company_state == party_state) {
                        overall_tax = parseFloat(overall_tax) / 2;
                        cgst_value = parseFloat(overall_tax_value) / 2;
                        cgst_value = cgst_value.toFixed(2);
                        sgst_value = parseFloat(overall_tax_value) / 2;
                        sgst_value = sgst_value.toFixed(2);
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').html(cgst_value);
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').html(sgst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.cgst_value').length > 0) {
                            jQuery('.cgst_value').parent().find('td:first').html('CGST(' + overall_tax + '%) :');
                        }
                        if (jQuery('.sgst_value').length > 0) {
                            jQuery('.sgst_value').parent().find('td:first').html('SGST(' + overall_tax + '%) :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax(' + tax_percentage + ') :');
                        }
                    }
                    else {
                        igst_value = overall_tax_value;
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').html(igst_value);
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').html(overall_tax_value);
                        }
                        if (jQuery('.igst_value').length > 0) {
                            jQuery('.igst_value').parent().find('td:first').html('IGST(' + tax_percentage + ') :');
                        }
                        if (jQuery('.total_tax_value').length > 0) {
                            jQuery('.total_tax_value').parent().find('td:first').html('Total Tax(' + tax_percentage + ') :');
                        }
                    }
                }
            }
        }
        if (overall_tax_value != "" && overall_tax_value != 0 && typeof overall_tax_value != "undefined" && price_regex.test(overall_tax_value) == true) {
            if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {
                total_value = parseFloat(charges_sub_total) + parseFloat(overall_tax_value);
                total_value = total_value.toFixed(2);
                if (jQuery('.overall_total').length > 0) {
                    jQuery('.overall_total').html(total_value);
                }
            }
        }
        else {
            if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {
                if (jQuery('.overall_total').length > 0) {
                    jQuery('.overall_total').html(charges_sub_total);
                }
            }
        }
    }
    else {
        if (charges_sub_total != "" && charges_sub_total != 0 && typeof charges_sub_total != "undefined" && price_regex.test(charges_sub_total) == true) {
            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(charges_sub_total);
            }
        }
    }
    checkOverallAmount();
}

function checkOverallAmount() {
    var overall_total = 0; var total = 0;
    if (jQuery('.overall_total').length > 0) {
        overall_total = jQuery('.overall_total').html();
        overall_total = overall_total.replace(/ /g, '');
        overall_total = overall_total.trim();

        if (typeof overall_total != "undefined" && overall_total != "" && overall_total != 0) {
            if (price_regex.test(overall_total) == true) {
                total = parseFloat(total) + parseFloat(overall_total);
                var decimal = ""; var round_off = '';
                var numbers = total.toString().split('.');
                if (typeof numbers[1] != 'undefined') {
                    decimal = numbers[1];
                }

                if (decimal != "" && decimal != 00) {
                    if (decimal.length == 1) {
                        decimal = decimal + '0';
                    }
                    if (parseFloat(decimal) >= 50) {
                        var round_off = 0;
                        round_off = 100 - parseFloat(decimal);

                        if (typeof round_off != 'undefined' && round_off != '' && round_off != 0) {
                            if (round_off.toString().length == 1) {
                                round_off = "0.0" + round_off;
                            }
                            else {
                                round_off = "0." + round_off;
                            }
                            jQuery('.round_off').html(round_off);
                            total = parseFloat(total) + parseFloat(round_off);
                        }
                    }
                    else {
                        decimal = "0." + decimal;
                        jQuery('.round_off').html('- ' + decimal);
                        total = parseFloat(total) - parseFloat(decimal);
                    }
                    total = total.toFixed(2);
                }
                else {
                    total = total.toFixed(2);
                    jQuery('.round_off').html('0.00');
                }
            }
        }
    }
    if (typeof total != "undefined" && total != "" && total != 0 && price_regex.test(total) == true) {
        if (jQuery('.overall_total').length > 0) {
            jQuery('.overall_total').html(total);
        }
    }
}


function calTotal() {
    // SnoCalculation();
    if (jQuery('.sub_total').length > 0) {
        jQuery('.sub_total').html('');
    }
    if (jQuery('.discounted_total').length > 0) {
        jQuery('.discounted_total').html('');
    }
    if (jQuery('.extra_charges_total').length > 0) {
        jQuery('.extra_charges_total').html('');
    }
    if (jQuery('.cgst_value').length > 0) {
        jQuery('.cgst_value').html('');
    }
    if (jQuery('.sgst_value').length > 0) {
        jQuery('.sgst_value').html('');
    }
    if (jQuery('.igst_value').length > 0) {
        jQuery('.igst_value').html('');
    }
    if (jQuery('.total_tax_value').length > 0) {
        jQuery('.total_tax_value').html('');
    }
    if (jQuery('.round_off').length > 0) {
        jQuery('.round_off').html('');
    }
    if (jQuery('.overall_total').length > 0) {
        jQuery('.overall_total').html('');
    }
    var gst_option = 0;
    if (jQuery('select[name="gst_option"]').length > 0) {
        gst_option = jQuery('select[name="gst_option"]').val();
        gst_option = gst_option.trim();
    }

    var tax_type = 2;

    var tax_option = 0;
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = tax_option.trim();
    }

    var overall_tax = "";
    if (jQuery('input[name="overall_tax"]').length > 0) {
        overall_tax = jQuery('input[name="overall_tax"]').val();
        overall_tax = overall_tax.trim();
    }

    var amount_total = 0;
    if (jQuery('.purchase_product_row').length > 0) {
        jQuery('.purchase_product_row').each(function () {
            var amount = "";
            if (jQuery(this).find('input[name="entry_amount[]"]').length > 0) {
                amount = jQuery(this).find('input[name="entry_amount[]"]').val();
            }

            amount = amount.replace(/ /g, '');
            amount = amount.trim();
            if (typeof amount != "undefined" && amount != "" && amount != 0 && price_regex.test(amount) == true) {
                if (price_regex.test(amount) == true) {
                    amount_total = parseFloat(amount_total) + parseFloat(amount);
                }
            }
        });
        if (typeof amount_total != "undefined" && amount_total != "" && amount_total != 0 && price_regex.test(amount_total) == true) {
            amount_total = amount_total.toFixed(2);
            if (jQuery('.sub_total').length > 0) {
                jQuery('.sub_total').html(amount_total);
            }
            if (jQuery('.discounted_total').length > 0) {
                jQuery('.discounted_total').html(amount_total);
            }
            if (jQuery('.extra_charges_total').length > 0) {
                jQuery('.extra_charges_total').html(amount_total);
            }
            if (jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(amount_total);
            }
        }
    }
    CheckCharges();
}

function CheckCharges() {
    var sub_total = 0;
    if (jQuery('.sub_total').length > 0) {
        sub_total = jQuery('.sub_total').html();
        sub_total = sub_total.trim();
    }
    var total_amount = 0;
    if (price_regex.test(sub_total) !== false) {
        total_amount = sub_total;
        var charges_count = 0;
        charges_count = jQuery('input[name="charges_count"]').val();
        charges_count = parseInt(charges_count);
        if (jQuery('.charges_row').length > 0) {
            jQuery('.charges_row').each(function () {
                if (jQuery(this).find('span.infos').length > 0) {
                    jQuery(this).find('span.infos').remove();
                }
                var charges_value = 0; var charges_check = 1; var charges_type = "";
                if (jQuery(this).find('input[name="charges_value[]"]').length > 0) {
                    charges_value = jQuery(this).find('input[name="charges_value[]"]').val();
                    charges_value = charges_value.trim();
                    if (charges_value != "" && charges_value != 0 && typeof charges_value != "undefined" && charges_value != null) {

                        if (charges_value.indexOf('%') != -1) {
                            charges_value = charges_value.replace('%', '');
                            charges_value = charges_value.trim();
                            // alert(charges_value);
                            if (price_regex.test(charges_value) == false) {
                                charges_check = 0;
                            }
                            else {
                                // alert(total_amount+"hello"+charges_value);
                                charges_value = (parseFloat(total_amount) * parseFloat(charges_value)) / 100;
                                charges_value = charges_value.toFixed(2);
                            }
                        }
                        else {
                            if (price_regex.test(charges_value) == false) {
                                charges_check = 0;
                            }
                            else {
                                charges_value = parseFloat(charges_value);
                                charges_value = charges_value.toFixed(2);
                            }
                        }
                    }
                    else {
                        charges_check = 2;
                    }
                }
                if (jQuery(this).find('input[name="charges_type[]"]').length > 0) {
                    charges_type = jQuery(this).find('input[name="charges_type[]"]').val();
                    charges_type = charges_type.trim();
                    if (charges_type != "" && charges_type != 0 && typeof charges_type != "undefined" && charges_type != null) {
                        if (charges_type != "plus" && charges_type != "minus") {
                            charges_check = 0;
                            jQuery(this).find('input[name="charges_type[]"]').after('<span class="infos">Invalid Type</span>');
                        }
                    }
                    else {
                        charges_check = 2;
                    }
                }
                if (parseInt(charges_check) == 1) {
                    if (charges_type == "minus") {
                        total_amount = parseFloat(total_amount) - parseFloat(charges_value);
                        total_amount = total_amount.toFixed(2);
                    }
                    else if (charges_type == "plus") {
                        total_amount = parseFloat(total_amount) + parseFloat(charges_value);
                        total_amount = total_amount.toFixed(2);
                    }
                    if (jQuery(this).find('.charges_total').length > 0) {
                        jQuery(this).find('.charges_total').html(charges_value, 2);
                    }
                    if (jQuery(this).find('.charges_sub_total').length > 0) {
                        jQuery(this).find('.charges_sub_total').html(total_amount, 2);
                    }

                }
                else if (parseInt(charges_check) == 0) {
                    total_amount = 0;
                    if (jQuery(this).find('.charges_total').length > 0) {
                        jQuery(this).find('.charges_total').html('<span class="infos">Invalid</span>');
                    }
                }
                else {
                    if (jQuery(this).find('.charges_total').length > 0) {
                        jQuery(this).find('.charges_total').html('0.00');
                    }
                    if (jQuery('.charges_sub_total_' + charges_count).length > 0) {
                        jQuery('.charges_sub_total_' + charges_count).html(total_amount, 2);
                    }
                }
                //    charges_count = parseInt(charges_count)+1;

            });
        }
    }
    if (price_regex.test(total_amount) !== false) {
        if (jQuery('.overall_total').length > 0) {
            jQuery('.overall_total').html(total_amount);
        }
        if (jQuery('.total_amount').length > 0) {
            jQuery('.total_amount').html(total_amount);
        }

    }
    else {
        // if(jQuery('.overall_total').length > 0) {
        //     jQuery('.overall_total').html('0.00');
        // }
        if (jQuery('.total_amount').length > 0) {
            jQuery('.total_amount').html('0.00');
        }

    }
    getGST();
}

function ShowGST() {
    if (jQuery('.cgst_amount').length > 0) {
        jQuery('.cgst_amount').html('');
    }
    if (jQuery('.sgst_amount').length > 0) {
        jQuery('.sgst_amount').html('');
    }
    if (jQuery('.igst_amount').length > 0) {
        jQuery('.igst_amount').html('');
    }
    if (jQuery('.total_tax_amount').length > 0) {
        jQuery('.total_tax_amount').html('');
    }
    var gst_option = 0;
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = gst_option.trim();
    }
    var company_state = "";
    if (jQuery('input[name="company_state"]').length > 0) {
        company_state = jQuery('input[name="company_state"]').val();
        company_state = company_state.trim();
    }
    var party_state = "";
    if (jQuery('input[name="party_state"]').length > 0) {
        party_state = jQuery('input[name="party_state"]').val();
        party_state = party_state.trim();
    }
    var total_amount = 0;
    var taxable_value_amount = 0;
    if (jQuery('.taxable_value_amount').length > 0) {
        taxable_value_amount = jQuery('.taxable_value_amount').html();
        taxable_value_amount = taxable_value_amount.trim();
        total_amount = taxable_value_amount;
    }
    else {
        if (jQuery('.total_amount').length > 0) {
            total_amount = jQuery('.total_amount').html();
            total_amount = total_amount.trim();
        }
    }
    var cgst_amount = 0; var sgst_amount = 0; var igst_amount = 0; var total_tax_amount = 0; var tax_value = 0;

    if (parseInt(gst_option) == 1) {
        if (jQuery('.taxable_value_row').length > 0) {
            jQuery('.taxable_value_row').removeClass('d-none');
        }
        if (jQuery('.total_tax_value_row').length > 0) {
            jQuery('.total_tax_value_row').removeClass('d-none');
        }
        if (price_regex.test(taxable_value_amount) !== false) {
            tax_value = (parseFloat(taxable_value_amount) * 18) / 100;
            tax_value = tax_value.toFixed(2);
            total_tax_amount = tax_value;
            if (company_state == party_state) {
                if (jQuery('.cgst_value_row').length > 0) {
                    jQuery('.cgst_value_row').removeClass('d-none');
                }
                if (jQuery('.sgst_value_row').length > 0) {
                    jQuery('.sgst_value_row').removeClass('d-none');
                }
                if (jQuery('.igst_value_row').length > 0) {
                    jQuery('.igst_value_row').addClass('d-none');
                }
                cgst_amount = parseFloat(tax_value) / 2;
                cgst_amount = cgst_amount.toFixed(2);
                sgst_amount = parseFloat(tax_value) / 2;
                sgst_amount = sgst_amount.toFixed(2);
                if (jQuery('.cgst_amount').length > 0) {
                    jQuery('.cgst_amount').html(cgst_amount);
                }
                if (jQuery('.sgst_amount').length > 0) {
                    jQuery('.sgst_amount').html(sgst_amount);
                }
                if (jQuery('.total_tax_amount').length > 0) {
                    jQuery('.total_tax_amount').html(total_tax_amount);
                }
            }
            else {
                if (jQuery('.cgst_value_row').length > 0) {
                    jQuery('.cgst_value_row').addClass('d-none');
                }
                if (jQuery('.sgst_value_row').length > 0) {
                    jQuery('.sgst_value_row').addClass('d-none');
                }
                if (jQuery('.igst_value_row').length > 0) {
                    jQuery('.igst_value_row').removeClass('d-none');
                }
                igst_amount = parseFloat(tax_value);
                igst_amount = igst_amount.toFixed(2);
                if (jQuery('.igst_amount').length > 0) {
                    jQuery('.igst_amount').html(igst_amount);
                }
                if (jQuery('.total_tax_amount').length > 0) {
                    jQuery('.total_tax_amount').html(total_tax_amount);
                }
            }

            total_amount = parseFloat(total_amount) + parseFloat(total_tax_amount);
            total_amount = total_amount.toFixed(2);
        }
    }
    else {
        if (jQuery('.taxable_value_row').length > 0) {
            jQuery('.taxable_value_row').addClass('d-none');
        }
        if (jQuery('.cgst_value_row').length > 0) {
            jQuery('.cgst_value_row').addClass('d-none');
        }
        if (jQuery('.sgst_value_row').length > 0) {
            jQuery('.sgst_value_row').addClass('d-none');
        }
        if (jQuery('.igst_value_row').length > 0) {
            jQuery('.igst_value_row').addClass('d-none');
        }
        if (jQuery('.total_tax_value_row').length > 0) {
            jQuery('.total_tax_value_row').addClass('d-none');
        }
    }
    if (jQuery('.total_amount').length > 0) {
        jQuery('.total_amount').html(total_amount);
    }
    checkOverallAmount();
}


function CalcPurchaseProductAmount() {

    var quantity = jQuery('input[name="quantity"]').val() || 0;
    var content = jQuery('input[name="content"]').val();
    var rate = jQuery('input[name="rate"]').val() || 0;
    var per = jQuery('input[name="per"]').val() || 1;
    var unit_type = jQuery('select[name="selected_unit_type"]').val();
    var per_type = jQuery('select[name="purchase_per_type"]').val();

    var total_amount = 0; var per_rate = 0;
    if (unit_type == 1) {
        if (per_type == 1) {
            per_rate = rate / per;
            total_amount = quantity * per_rate;
        } else if (per_type == 2) {
            if (content != "") {
                per_rate = (rate / per) * content;
                total_amount = quantity * per_rate;
            }
        }
    } else if (unit_type == 2) {
        if (content != "") {
            if (per_type == 1) {
                per_rate = (rate / per) / content;
                total_amount = quantity * per_rate;
            } else if (per_type == 2) {
                per_rate = rate / per;
                total_amount = quantity * per_rate;
            }
        }
    }

    if (jQuery('input[name="amount"]').length > 0) {
        jQuery('input[name="amount"]').val(total_amount.toFixed(2));
    }
}



function getRateByTaxOption() {
    var tax_option = ""; var final_rate = "";
    if (jQuery('select[name="tax_option"]').length > 0) {
        tax_option = jQuery('select[name="tax_option"]').val();
        tax_option = jQuery.trim(tax_option);
    }
    var tax_type = "";
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
    }

    var gst_option = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
    }
    if (gst_option == '1') {
        if (jQuery('.purchase_product_row').length > 0) {
            jQuery('.purchase_product_row').each(function () {

                var unit_type = "";
                if (jQuery(this).find('input[name="unit_type[]"]').length > 0) {
                    unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                    unit_type = jQuery.trim(unit_type);
                }

                var content = "";
                if (jQuery(this).find('input[name="entry_content[]"]').length > 0) {
                    content = jQuery(this).find('input[name="entry_content[]"]').val();
                    content = jQuery.trim(content);
                }

                var per = "";
                if (jQuery(this).find('input[name="entry_per[]"]').length > 0) {
                    per = jQuery(this).find('input[name="entry_per[]"]').val();
                    per = jQuery.trim(per);
                }

                var per_type = "";
                if (jQuery(this).find('select[name="entry_per_type[]"]').length > 0) {
                    per_type = jQuery(this).find('select[name="entry_per_type[]"]').val();
                    per_type = jQuery.trim(per_type);
                }

                if (jQuery(this).find('input[name="entry_rate[]"]').length > 0) {
                    selected_rate = jQuery(this).find('input[name="entry_rate[]"]').val();
                    selected_rate = jQuery.trim(selected_rate);
                }
                if (unit_type == '1') {
                    if (per_type == '1') {
                        final_rate = parseFloat(selected_rate) / parseFloat(per);
                    }
                    else if (per_type == '2') {
                        rate_per_piece = parseFloat(selected_rate) / parseFloat(per);
                        final_rate = parseFloat(rate_per_piece) * parseFloat(content);
                    }
                }
                else if (unit_type == '2') {
                    if (per_type == '1') {
                        rate_per_case = parseFloat(selected_rate) / parseFloat(per);
                        final_rate = parseFloat(rate_per_case) / parseFloat(content);
                    }
                    else {
                        final_rate = parseFloat(selected_rate) / parseFloat(per);
                    }
                }

                var rate = 0; var selected_rate = 0; var tax = "";
                if (typeof tax_option != "undefined" && tax_option != null && tax_option != "") {

                    if (tax_type == '1') {
                        if (jQuery(this).find('select[name="product_tax[]"]').length > 0) {
                            var tax = jQuery(this).find('select[name="product_tax[]"]').val();
                            if (typeof tax != "undefined" && tax != null && tax != "") {
                                tax = tax.replace("%", "");
                                tax = jQuery.trim(tax);
                            }
                        }
                    }
                    else {
                        if (jQuery('select[name="overall_tax"]').length > 0) {
                            var tax = jQuery('select[name="overall_tax"]').val();
                            if (typeof tax != "undefined" && tax != null && tax != "") {
                                tax = tax.replace("%", "");
                                tax = jQuery.trim(tax);
                            }
                        }
                    }
                    if (price_regex.test(final_rate) == true) {
                        if (price_regex.test(tax) == true) {
                            if (tax_option == 2) {
                                rate = (parseFloat(final_rate) * 100) / (parseFloat(tax) + 100);
                            }
                            else if (tax_option == 1) {
                                rate = final_rate;
                            }
                        }
                    }
                    if (typeof rate != "undefined" && rate != null && rate != "") {
                        if (price_regex.test(rate) == true) {
                            var product_price = 0;
                            product_price = rate;
                            rate = rate.toFixed(2);
                            if (jQuery(this).find('input[name="final_rate[]"]').length > 0) {
                                jQuery(this).find('input[name="final_rate[]"]').val(rate);
                            }
                            if (jQuery(this).find('.final_rate').length > 0) {
                                jQuery(this).find('.final_rate').html(rate);
                            }
                            var discount = 0;
                            var quantity = "";
                            if (jQuery(this).find('input[name="entry_quantity[]"]').length > 0) {
                                quantity = jQuery(this).find('input[name="entry_quantity[]"]').val();
                                quantity = jQuery.trim(quantity);
                                if (price_regex.test(quantity) == true && price_regex.test(product_price) == true) {
                                    var amount = "";

                                    amount = parseFloat(quantity) * parseFloat(product_price);
                                    amount = amount.toFixed(2);
                                    if (jQuery(this).find('.amount').length > 0) {

                                        jQuery(this).find('.amount').html(amount);
                                    }
                                    if (jQuery(this).find('input[name="entry_amount[]"]').length > 0) {

                                        jQuery(this).find('input[name="entry_amount[]"]').val(amount);
                                        jQuery(this).find('.entry_amount_td').html(amount);
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }

    }
    calTotal();

}

function calcToalPurchaseProductAmount(id) {
    var quantity = $("#entry_quantity_" + id).val();
    var content = $("#entry_content_" + id).val();
    var rate = $("#entry_rate_" + id).val() || 0;
    var per = $("#entry_per_" + id).val();
    var unit_type = $("#unit_type_" + id).val();
    var per_type = $("#entry_per_type_" + id).val();
    // if(quantity == 0 || quantity == "") {
    //     quantity = 1;
    //     $("#entry_quantity_"+id).val(1);
    // }
    if (per == 0 || per == "") {
        per = 1;
        $("#entry_per_" + id).val(1);
    }

    var gst_option = jQuery('input[name="gst_option"]').val();
    var tax_option = jQuery('select[name="tax_option"]').val();
    var tax_type = jQuery('select[name="tax_type"]').val();
    var product_tax = $("#product_tax_" + id).val();
    if (product_tax != "" || product_tax != undefined) {
        product_tax = product_tax.replace("%", "");
        product_tax = jQuery.trim(product_tax);
    }
    var total_amount = 0; var per_rate = 0; var tax_amt = 0;
    if (unit_type == 1) {
        if (per_type == 1) {
            per_rate = rate / per;
            if (gst_option == 1) {
                if (tax_option == 1) {
                    if (tax_type == 1) {
                        tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                        tax_amt = tax_amt.toFixed(2);
                    }
                } else if (tax_option == 2) {
                    if (tax_type == 1) {
                        tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                        tax_amt = tax_amt.toFixed(2);
                        per_rate = parseFloat(per_rate) - parseFloat(tax_amt);
                    }
                }
            }
            total_amount = quantity * per_rate;
        } else if (per_type == 2) {
            if (content != "") {
                per_rate = (rate / per) * content;
                if (gst_option == 1) {
                    if (tax_option == 1) {
                        if (tax_type == 1) {
                            tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                            tax_amt = tax_amt.toFixed(2);
                        }
                    } else if (tax_option == 2) {
                        if (tax_type == 1) {
                            tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                            tax_amt = tax_amt.toFixed(2);
                            per_rate = parseFloat(per_rate) - parseFloat(tax_amt);
                        }
                    }
                }
                total_amount = quantity * per_rate;
            }
        }
    } else if (unit_type == 2) {
        if (content != "") {
            if (per_type == 1) {
                per_rate = (rate / per) / content;
                if (gst_option == 1) {
                    if (tax_option == 1) {
                        if (tax_type == 1) {
                            tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                            tax_amt = tax_amt.toFixed(2);
                        }
                    } else if (tax_option == 2) {
                        if (tax_type == 1) {
                            tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                            tax_amt = tax_amt.toFixed(2);
                            per_rate = parseFloat(per_rate) - parseFloat(tax_amt);
                        }
                    }
                }
                total_amount = quantity * per_rate;
            } else if (per_type == 2) {
                per_rate = rate / per;
                if (gst_option == 1) {
                    if (tax_option == 1) {
                        if (tax_type == 1) {
                            tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                            tax_amt = tax_amt.toFixed(2);
                        }
                    } else if (tax_option == 2) {
                        if (tax_type == 1) {
                            tax_amt = (per_rate * parseFloat(product_tax)) / 100;
                            tax_amt = tax_amt.toFixed(2);
                            per_rate = parseFloat(per_rate) - parseFloat(tax_amt);
                        }
                    }
                }
                total_amount = quantity * per_rate;
            }
        }
    }
    if ($("#tax_amt_" + id).length > 0) {
        $("#tax_amt_" + id).val(tax_amt);
    }
    $("#entry_amount_" + id).val(total_amount.toFixed(2));
    $("#entry_amount_td_" + id).html(total_amount.toFixed(2));
    calcPurchaseEntrySubTotal();
}

function calcPurchaseEntrySubTotal() {
    var sub_total = 0;
    $('input[name="entry_amount[]"]').each(function () {
        var amount = jQuery(this).val();
        amount = amount.trim();
        if (typeof amount != "undefined" && amount != "" && amount != 0 && price_regex.test(amount) == true) {
            if (price_regex.test(amount) == true) {
                sub_total = parseFloat(sub_total) + parseFloat(amount);
            }
        }
    });
    if (typeof sub_total != "undefined" && sub_total != 0) {
        sub_total = sub_total.toFixed(2);
        if (jQuery('.sub_total').length > 0) {
            jQuery('.sub_total').html(sub_total);
        }
        if (jQuery('input[name="sub_total"]').length > 0) {
            jQuery('input[name="sub_total"]').val(sub_total);
        }
        CheckCharges();
    }
}

function AddChargesRow(obj, colspan) {
    if ($("#gst_option").length > 0) {
        if ($("#gst_option").val() == 1 && jQuery('select[name="tax_type"]').val() == 1) {
            colspan += 1;
        }
    }
    var charges_count = 0;
    charges_count = jQuery('input[name="charges_count"]').val();
    if (charges_count < 4) {
        charges_count = parseInt(charges_count) + 1;
        jQuery('input[name="charges_count"]').val(charges_count);
        var post_url = "action_changes.php?get_charges_row=1&charges_count=" + charges_count + "&charges_colspan=" + colspan;
        jQuery.ajax({
            url: post_url, success: function (result) {
                result = jQuery.trim(result);
                if (jQuery(obj).closest('tfoot').find('.charges_row').length > 0) {
                    jQuery(obj).closest('tfoot').find('.charges_row').last().after(result);
                }
            }
        });
    }
}
function DeleteChargesRow(obj, row_index) {
    var charges_count = 0;
    charges_count = jQuery('input[name="charges_count"]').val();
    charges_count = parseInt(charges_count) - 1;
    jQuery('input[name="charges_count"]').val(charges_count);
    // alert(row_index);
    if (jQuery(obj).closest('.charges_row').length > 0) {
        jQuery(obj).closest('.charges_row').remove();
    }
    if (jQuery('#charges_row_total_' + row_index).length > 0) {
        jQuery('#charges_row_total_' + row_index).remove();
    }
    CheckCharges();
}

function GetChargesType(obj) {
    var charges_id = "";
    charges_id = jQuery(obj).val();
    var post_url = "action_changes.php?get_charges_type=" + charges_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = jQuery.trim(result);
            if (jQuery(obj).closest('.charges_row').find('input[name="charges_type[]"]').length > 0) {
                jQuery(obj).closest('.charges_row').find('input[name="charges_type[]"]').val(result);
            }
            CheckCharges();
        }
    });
}

function SupplierState(id) {

    var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "action_changes.php?get_supplier_state=" + id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            if (jQuery('input[name="party_state"]').length > 0) {
                                jQuery('input[name="party_state"]').val(result);
                                CheckCharges();
                            }
                        }
                    }
                });
            }
        }
    });
}

function GetStockLimit() {
    var godown = $('select[name="godown"]').val();
    var product = $('select[name="product"]').val();
    var unit_type = $('select[name="selected_unit_type"]').val();
    var content = "";
    if ($('select[name="selected_consumption_content"]').length > 0) {
        content = $('select[name="selected_consumption_content"]').val();
    }
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "action_changes.php?get_limit_product=" + product + "&unit_type=" + unit_type + "&content=" + content + "&godown=" + godown;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            if (jQuery('input[name="stock_limit"]').length > 0) {
                                jQuery('input[name="stock_limit"]').val(result);
                            }
                            if (jQuery('#qty_limit').length > 0) {
                                jQuery('#qty_limit').html("stock Balance : <span class='text-danger'>" + result + "</span>");
                            }
                        }
                    }
                });
            }
        }
    });
}

function GetGroupProducts() {
    if (jQuery('select[name="product"]').length > 0) {
        jQuery('select[name="product"]').html('');
    }
    var godown_type = "";
    if (jQuery('select[name="godown_type"]').length > 0) {
        godown_type = jQuery('select[name="godown_type"]').val();
    }
    var godown = "";
    if (godown_type == '1') {
        if (jQuery('select[name="overall_godown"]').length > 0) {
            godown = jQuery('select[name="overall_godown"]').val();
        }
    } else if (godown_type == '2') {
        if (jQuery('select[name="indv_godown"]').length > 0) {
            godown = jQuery('select[name="indv_godown"]').val();
        }
    }

    var raw_semi_group_id = "";
    if (jQuery('select[name="raw_semi_group_id"]').length > 0) {
        raw_semi_group_id = jQuery('select[name="raw_semi_group_id"]').val();
    }

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "action_changes.php?get_product_by_group&godown_id=" + godown + "&raw_semi_group_id=" + raw_semi_group_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (jQuery('select[name="product"]').length > 0) {
                            jQuery('select[name="product"]').html(result);
                            GetProdetails();
                        }
                    }
                });
            }
        }
    });
}

function GetStockProduct() {
    if (jQuery('select[name="product"]').length > 0) {
        jQuery('select[name="product"]').html('');
    }
    var godown_type = "";
    if (jQuery('select[name="godown_type"]').length > 0) {
        godown_type = jQuery('select[name="godown_type"]').val();
    }
    var godown = "";
    if (godown_type == '1') {
        if (jQuery('select[name="overall_godown"]').length > 0) {
            godown = jQuery('select[name="overall_godown"]').val();
        }
    }
    else if (godown_type == '2') {
        if (jQuery('select[name="indv_godown"]').length > 0) {
            godown = jQuery('select[name="indv_godown"]').val();
        }
    }
    if (jQuery('select[name="contractor"]').length > 0) {
        contractor_id = jQuery('select[name="contractor"]').val();
    }
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "action_changes.php?get_stock_product=1&godown_id=" + godown + "&contractor_id=" + contractor_id;
                // var post_url = "action_changes.php?get_stock_product=1&godown_id=" + godown;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (jQuery('select[name="product"]').length > 0) {
                            jQuery('select[name="product"]').html(result);
                            GetProdetails();
                        }
                    }
                });
            }
        }
    });
}

function getGodownType(godown_type) {
    jQuery('.indv_godown').addClass('d-none');
    jQuery('.overall_godown').addClass('d-none');
    if (godown_type == '1') {
        jQuery('.overall_godown').removeClass('d-none');
    }
    else if (godown_type == '2') {
        jQuery('.indv_godown').removeClass('d-none');
    }
    GetStockProduct();
}

function AddConsumptionProducts() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var godown_type = "";
                if (jQuery('select[name="godown_type"]').length > 0) {
                    godown_type = jQuery('select[name="godown_type"]').val();
                    godown_type = jQuery.trim(godown_type);
                    if (typeof godown_type == "undefined" || godown_type == "" || godown_type == 0) {
                        all_errors_check = 0;
                    }
                }

                if (godown_type == 1) {
                    if (jQuery('select[name="overall_godown"]').length > 0) {
                        godown_id = jQuery('select[name="overall_godown"]').val();
                        godown_id = jQuery.trim(godown_id);
                        if (typeof godown_id == "undefined" || godown_id == "" || godown_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                } else {
                    if (jQuery('select[name="indv_godown"]').length > 0) {
                        godown_id = jQuery('select[name="indv_godown"]').val();
                        godown_id = jQuery.trim(godown_id);
                        if (typeof godown_id == "undefined" || godown_id == "" || godown_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var contractor_id = "";
                if (jQuery('select[name="contractor"]').is(":visible")) {
                    if (jQuery('select[name="contractor"]').length > 0) {
                        contractor_id = jQuery('select[name="contractor"]').val();
                        contractor_id = jQuery.trim(contractor_id);
                        if (typeof contractor_id == "undefined" || contractor_id == "" || contractor_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_product_id = "";
                if (jQuery('select[name="product"]').is(":visible")) {
                    if (jQuery('select[name="product"]').length > 0) {
                        selected_product_id = jQuery('select[name="product"]').val();
                        selected_product_id = jQuery.trim(selected_product_id);
                        if (typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_unit_id = "";
                if (jQuery('select[name="selected_unit_type"]').length > 0) {
                    selected_unit_id = jQuery('select[name="selected_unit_type"]').val();
                    selected_unit_id = jQuery.trim(selected_unit_id);
                    if (typeof selected_unit_id == "undefined" || selected_unit_id == "" || selected_unit_id == 0) {
                        all_errors_check = 0;
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

                if (parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (selected_product_id != "") {
                        if (jQuery('input[name="product_id[]"]').length > 0) {
                            jQuery('.consumption_product_table tbody').find('tr').each(function () {
                                var prev_product_id = ""; var prev_unit_id = ""; var prev_contains = ""; var prev_godown_id = "";
                                prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                if (jQuery(this).find('input[name="unit_id[]"]').length > 0) {
                                    prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
                                }
                                if (jQuery(this).find('input[name="contains[]"]').length > 0) {
                                    prev_contains = jQuery(this).find('input[name="contains[]"]').val();
                                }
                                if (jQuery(this).find('input[name="godown_id[]"]').length > 0) {
                                    prev_godown_id = jQuery(this).find('input[name="godown_id[]"]').val();
                                }
                                if (godown_type == 1) {
                                    if (jQuery('select[name="selected_content"]').is(":visible")) {
                                        if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id && prev_contains == selected_content) {
                                            add = 0;
                                        }
                                    } else {
                                        if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id) {
                                            add = 0;
                                        }
                                    }
                                } else {
                                    if (jQuery('select[name="selected_content"]').is(":visible")) {
                                        if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id && prev_contains == selected_content && prev_godown_id == godown_id) {
                                            add = 0;
                                        }
                                    } else {
                                        if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id && prev_godown_id == godown_id) {
                                            add = 0;
                                        }
                                    }
                                }
                            });
                        }
                    }
                    if (parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);

                        var post_url = "consumption_entry_changes.php?product_row_index=" + product_count + "&selected_product_id=" + selected_product_id + "&selected_unit_id=" + selected_unit_id + "&selected_quantity=" + selected_quantity + "&selected_content=" + selected_content + "&godown_type=" + godown_type + "&godown_id=" + godown_id;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.consumption_product_table tbody').find('tr').length > 0) {
                                    jQuery('.consumption_product_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.consumption_product_table tbody').append(result);
                                }
                                if (godown_type == 1) {
                                    if (jQuery('select[name="overall_godown"]').length > 0) {
                                        jQuery('select[name="overall_godown"]').attr('disabled', true);
                                    }
                                    if (jQuery('input[name="overall_godown"]').length > 0) {
                                        jQuery('input[name="overall_godown"]').attr('disabled', false);
                                        jQuery('input[name="overall_godown"]').val(godown_id);
                                    }
                                }
                                if (jQuery('select[name="godown_type"]').length > 0) {
                                    jQuery('select[name="godown_type"]').attr('disabled', true);
                                    if (jQuery('input[name="godown_type"]').length > 0) {
                                        if (godown_type != "") {
                                            jQuery('input[name="godown_type"]').attr('disabled', false);
                                            jQuery('input[name="godown_type"]').val(godown_type);
                                        }
                                    }
                                }

                                if (jQuery('select[name="product"]').length > 0) {
                                    jQuery('select[name="product"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_unit_type"]').length > 0) {
                                    jQuery('select[name="selected_unit_type"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_content"]').length > 0) {
                                    jQuery('select[name="selected_content"]').val('').trigger('change');
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('.current_stock_div').length > 0) {
                                    jQuery('.current_stock_div').html('');
                                }
                                if (jQuery('select[name="indv_godown"]').length > 0) {
                                    jQuery('select[name="indv_godown"]').val('').trigger('change');
                                }
                                calQtyTotal();
                            }
                        });
                    }
                    else {
                        if (jQuery('select[name="selected_content"]').is(":visible")) {
                            jQuery('.consumption_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product ,Unit, Contains Already Exists</span>');
                        } else {
                            jQuery('.consumption_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product ,Unit Already Exists</span>');
                        }
                    }
                }
                else {
                    jQuery('.consumption_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product Details</span>');
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
        // if (typeof quantity_total != "undefined" && quantity_total != "" && quantity_total != 0 && price_regex.test(quantity_total) == true) {
        //     quantity_total = quantity_total.toFixed(2);
        //     if (jQuery('.overall_qty').length > 0) {
        //         jQuery('.overall_qty').html(quantity_total);
        //     }
        // }


        /* Total Display */
        var unit_ids = [];
        if (jQuery('.product_row').length > 0) {
            jQuery('.product_row').each(function (index, row) {
                var unit_type = jQuery(row).find('input[name="unit_type[]"]').val();
                var unit_id = '';
                if (jQuery(row).find('input[name="unit_id[]"]').length > 0) {
                    unit_id = jQuery(row).find('input[name="unit_id[]"]').val();
                }
                var subunit_id = '';
                if (jQuery(row).find('input[name="subunit_id[]"]').length > 0) {
                    subunit_id = jQuery(row).find('input[name="subunit_id[]"]').val();
                }
                if (unit_type == 1) {
                    if (unit_id != '') {
                        unit_ids.push(unit_id);
                    }
                } else if (unit_type == 2) {
                    if (subunit_id != '') {
                        unit_ids.push(subunit_id);
                    } else if (unit_id != '' && subunit_id == '') {
                        unit_ids.push(unit_id);
                    }
                }
            });
        }

        var product_ids = [];
        if (jQuery('input[name="product_id[]"]').length > 0) {
            jQuery('input[name="product_id[]"]').each(function () {
                product_ids.push(jQuery(this).val());
            });
        }
        var contains = [];
        if (jQuery('input[name="contains[]"]').length > 0) {
            jQuery('input[name="contains[]"]').each(function () {
                contains.push(jQuery(this).val());
            });
        }
        var quantity = [];
        if (jQuery('input[name="quantity[]"]').length > 0) {
            jQuery('input[name="quantity[]"]').each(function () {
                quantity.push(jQuery(this).val());
            });
        }

        var post_url = "daily_production_changes.php?get_total&product_ids=" + product_ids.join(',') + "&unit_ids=" + unit_ids.join(',') + "&contains=" + contains.join(',') + "&quantity=" + quantity.join(',');
        jQuery.ajax({
            url: post_url, success: function (result) {
                if (typeof result != "undefined" && result != "") {
                    if (jQuery('.overall_qty').length > 0) {
                        jQuery('.overall_qty').html(result);
                    }
                }
            }
        });
    }
}

function GetCurrentStock() {
    if (jQuery('.current_stock_div').length > 0) {
        jQuery('.current_stock_div').html('');
    }
    var product_id = ""; var godown_type = ""; var selected_unit_id = ""; var selected_content = "";
    if (jQuery('select[name="product"]').length > 0) {
        product_id = jQuery('select[name="product"]').val();
    }
    if (jQuery('select[name="godown_type"]').length > 0) {
        godown_type = jQuery('select[name="godown_type"]').val();
    }
    if (jQuery('select[name="selected_unit_type"]').length > 0) {
        selected_unit_id = jQuery('select[name="selected_unit_type"]').val();
    }
    if (jQuery('select[name="selected_content"]').length > 0) {
        selected_content = jQuery('select[name="selected_content"]').val();
    }
    var godown_id = "";
    if (godown_type == 1) {
        if (jQuery('select[name="overall_godown"]').length > 0) {
            godown_id = jQuery('select[name="overall_godown"]').val();
            godown_id = jQuery.trim(godown_id);
        } else {
            if (jQuery('input[name="overall_godown"]').length > 0) {
                godown_id = jQuery('input[name="overall_godown"]').val();
                godown_id = jQuery.trim(godown_id);
            }
        }
    } else {
        if (jQuery('select[name="indv_godown"]').length > 0) {
            godown_id = jQuery('select[name="indv_godown"]').val();
            godown_id = jQuery.trim(godown_id);
        }
    }

    var post_url = "consumption_entry_changes.php?get_current_stock_product_id=" + product_id + "&selected_unit_id=" + selected_unit_id + "&selected_content=" + selected_content + "&godown_id=" + godown_id;

    jQuery.ajax({
        url: post_url, success: function (result) {
            if (jQuery('.current_stock_div').length > 0) {
                jQuery('.current_stock_div').html(result);
            }
        }
    });
}


function DeleteConsumptionRow(row_index, id_name) {
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
                        if (jQuery('select[name="godown_type"]').length > 0) {
                            if (jQuery('input[name="godown_type"]').length > 0) {
                                jQuery('input[name="godown_type"]').val('');
                                jQuery('input[name="godown_type"]').attr('disabled', true);
                            }
                            jQuery('select[name="godown_type"]').attr('disabled', false);
                        }
                        if (jQuery('select[name="overall_godown"]').length > 0) {
                            if (jQuery('input[name="overall_godown"]').length > 0) {
                                jQuery('input[name="overall_godown"]').val('');
                                jQuery('input[name="overall_godown"]').attr('disabled', true);
                            }
                            jQuery('select[name="overall_godown"]').attr('disabled', false);
                        }
                    }
                }
                SnoCalculation();
                calQtyTotal();
            }
            else {
                window.location.reload();
            }
        }
    });
}

function show_godown_magazine(product_group) {
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
