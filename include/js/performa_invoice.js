function ShowGST(obj, gst_option) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var option = 1;
                if (jQuery('#gst_option').prop('checked') == false) {
                    option = 0;
                }
                if (jQuery(obj).parent().find('input[type="checkbox"]').length > 0) {
                    jQuery(obj).parent().find('input[type="checkbox"]').val(option);
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

                if (jQuery('.product_row').length > 0) {
                    if (jQuery('select[name="product_tax[]"]').length > 0) {
                        jQuery('select[name="product_tax[]"]').each(function () {
                            if (jQuery(this).length > 0) {
                                jQuery(this).val('').trigger('change');
                            }
                        });
                    }
                }

                /* if(option == 1) {
                    getGST();
                }
                else{
                    checkOverallAmount();
                } */
            }
            else {
                window.location.reload();
            }
        }
    });
    checkOverallAmount();
}

function getPartyState(party_id) {
    var post_url = "bill_changes.php?get_party_state=" + party_id;
    jQuery.ajax({
        url: post_url, success: function (result) {
            result = result.trim();
            if (jQuery('input[name="party_state"]').length > 0) {
                jQuery('input[name="party_state"]').val(result);
            }
            // calTotal();
        }
    });
}

function getProductUnitType(product_id) {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var post_url = "bill_changes.php?get_product_unit_type_id=" + product_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        result = result.trim();
                        if (jQuery('select[name="selected_unit_type"]').length > 0) {
                            jQuery('select[name="selected_unit_type"]').html(result);
                        }
                        if (jQuery('select[name="selected_per_type"]').length > 0) {
                            jQuery('select[name="selected_per_type"]').html(result);
                        }
                        // calTotal();
                    }
                });
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
    if (jQuery('select[name="magazine_type"]').length > 0) {
        var magazine_type = jQuery('select[name="magazine_type"]').val();
        if (magazine_type == '2') {
            addcol += 1;
        }
    }
    if (gst_option == 1) {
        if (parseInt(tax_type) == 1) {
            if (jQuery('.tax_cover2').length > 0) {
                jQuery('.tax_cover2').addClass('d-none');
            }
            if (jQuery('.tax_element').length > 0) {
                jQuery('.tax_element').removeClass('d-none');
            }
            addcol += 1;
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

    $(".sub_tot").attr('colspan', 8 + parseInt(addcol));
    $(".charges_head").attr('colspan', 4 + parseInt(addcol));
    $(".charges_sub").attr('colspan', 8 + parseInt(addcol));
    $(".cgst").attr('colspan', 8 + parseInt(addcol));
    $(".sgst").attr('colspan', 8 + parseInt(addcol));
    $(".igst").attr('colspan', 8 + parseInt(addcol));
    $(".agent_commission").attr('colspan', 8 + parseInt(addcol));
    $(".total_tax").attr('colspan', 8 + parseInt(addcol));
    $(".round").attr('colspan', 8 + parseInt(addcol));
    $(".grand_total").attr('colspan', 8 + parseInt(addcol));

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

    // getRateByTaxOption();
    checkGST();
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
                        decimal = "0." + decimal.padStart(2, '0');
                        console.log(decimal + "From else" + jQuery('.round_off').length);
                        jQuery('.round_off').html('- ' + decimal);
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

function ProductRowCheck(obj) {
    if (jQuery(obj).parent().parent().find('span.infos').length > 0) {
        jQuery(obj).parent().parent().find('span.infos').remove();
    }

    var selected_content = ""; var selected_unit_type = ""; var selected_quantity = ""; var total_qty = ""; var quantity_check = 1; quantity_error = 1; var unit_type_check = 1; content_error = 1; content_check = 1;

    if (jQuery(obj).closest('tr').find('input[name="quantity[]"]').length > 0) {
        selected_quantity = jQuery(obj).closest('tr').find('input[name="quantity[]"]').val();
        selected_quantity = jQuery.trim(selected_quantity);
        if (typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
            quantity_check = 0;
        }
        else if (price_regex.test(selected_quantity) == false) {
            quantity_error = 0;
        }
        else if (parseFloat(selected_quantity) > 99999) {
            quantity_error = 0;
        }
    }

    if (jQuery(obj).closest('tr').find('input[name="unit_type[]"]').length > 0) {
        selected_unit_type = jQuery(obj).closest('tr').find('input[name="unit_type[]"]').val();
        selected_unit_type = jQuery.trim(selected_unit_type);
        if (typeof selected_unit_type == "undefined" || selected_unit_type == "" || selected_unit_type == 0) {
            unit_type_check = 0;
        }
    }

    if (jQuery(obj).closest('tr').find('input[name="content[]"]').length > 0) {
        selected_content = jQuery(obj).closest('tr').find('input[name="content[]"]').val();
        selected_content = jQuery.trim(selected_content);
        if (typeof selected_content == "undefined" || selected_content == "" || selected_content == 0) {
            content_check = 0;
        }
        else if (price_regex.test(selected_content) == false) {
            content_error = 0;
        }
        else if (parseFloat(selected_content) > 99999) {
            content_error = 0;
        }
    }

    if (parseFloat(quantity_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="quantity[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="quantity[]"]').after('<span class="infos">Invalid Quantity</span>');
        }
    }
    if (parseFloat(unit_type_check) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="unit_type[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="unit_type[]"]').after('<span class="infos">Invalid Unit Type</span>');
        }
    }
    if (parseFloat(content_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="content[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="content[]"]').after('<span class="infos">Invalid Content</span>');
        }
    }

    var total_qty = 0;
    if (parseFloat(quantity_check) == 1 && parseFloat(quantity_error) == 1 && parseFloat(unit_type_check) == 1 && parseFloat(content_check) == 1 && parseFloat(content_error)) {
        if (selected_unit_type == '1') {
            total_qty = parseFloat(selected_quantity) * parseFloat(selected_content);
        }
        else {
            total_qty = parseFloat(selected_quantity);
        }
        if (total_qty != "" && total_qty != 0 && typeof total_qty != "undefined") {
            if (jQuery(obj).closest('tr').find('input[name="total_qty[]"]').length > 0) {
                total_qty = total_qty.toFixed(2);
                jQuery(obj).closest('tr').find('input[name="total_qty[]"]').val(total_qty);
            }
        }
        else {
            if (jQuery(obj).closest('tr').find('input[name="total_qty[]"]').length > 0) {
                jQuery(obj).closest('tr').find('input[name="total_qty[]"]').val('');
            }
        }
    }
    else {
        if (jQuery(obj).closest('tr').find('input[name="total_qty[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="total_qty[]"]').val('');
        }
    }

    var rate_check = 1; var rate_error = 1; var per_error = 1; var per_check = 1; var per_type_error = 1; var per_type_check = 1; var final_rate_error = 1; var final_rate_check = 1;

    var gst_option = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
        gst_option = gst_option.trim();
    }

    var tax_type = "";
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
        tax_type = tax_type.trim();
    }

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

    var selected_rate = "";
    if (jQuery(obj).closest('tr').find('input[name="rate[]"]').length > 0) {
        selected_rate = jQuery(obj).closest('tr').find('input[name="rate[]"]').val();
        selected_rate = jQuery.trim(selected_rate);
        if (typeof selected_rate == "undefined" || selected_rate == "" || selected_rate == 0) {
            rate_check = 0;
        }
        else if (price_regex.test(selected_rate) == false) {
            rate_error = 0;
        }
        else if (parseFloat(selected_rate) > 99999) {
            rate_error = 0;
        }
    }

    var product_tax = "";
    if (jQuery(obj).closest('tr').find('select[name="product_tax[]"]').length > 0) {
        product_tax = jQuery(obj).closest('tr').find('select[name="product_tax[]"]').val();
        product_tax = jQuery.trim(product_tax);
    }

    var overall_tax = "";
    if (jQuery('select[name="overall_tax"]').length > 0) {
        overall_tax = jQuery('select[name="overall_tax"]').val();
        overall_tax = jQuery.trim(overall_tax);
    }

    var selected_per = "";
    if (jQuery(obj).closest('tr').find('input[name="per[]"]').length > 0) {
        selected_per = jQuery(obj).closest('tr').find('input[name="per[]"]').val();
        selected_per = jQuery.trim(selected_per);
        if (typeof selected_per == "undefined" || selected_per == "" || selected_per == 0) {
            per_check = 0;
        }
        else if (price_regex.test(selected_per) == false) {
            per_error = 0;
        }
        else if (parseFloat(selected_per) > 99999) {
            per_error = 0;
        }
    }

    // var selected_per_type = "";
    // if (jQuery(obj).closest('tr').find('select[name="per_type[]"]').length > 0) {
    //     selected_per_type = jQuery(obj).closest('tr').find('select[name="per_type[]"]').val();
    //     selected_per_type = jQuery.trim(selected_per_type);
    //     if (typeof selected_per_type == "undefined" || selected_per_type == "" || selected_per_type == 0) {
    //         per_check = 0;
    //     }
    //     else if (price_regex.test(selected_per_type) == false) {
    //         per_error = 0;
    //     }
    // }

    var selected_per_type = "";
    if (jQuery(obj).closest('tr').find('input[name="per_type[]"]').length > 0) {
        selected_per_type = jQuery(obj).closest('tr').find('input[name="per_type[]"]').val();
        selected_per_type = jQuery.trim(selected_per_type);
        if (typeof selected_per_type == "undefined" || selected_per_type == "" || selected_per_type == 0) {
            per_check = 0;
        }
        else if (price_regex.test(selected_per_type) == false) {
            per_error = 0;
        }
    }

    if (parseFloat(rate_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="rate[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="rate[]"]').after('<span class="infos">Invalid rate</span>');
        }
    }

    if (parseFloat(per_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="per[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="per[]"]').after('<span class="infos">Invalid Per</span>');
        }
    }
    // if (parseFloat(per_type_error) == 0) {
    //     if (jQuery(obj).closest('tr').find('select[name="per_type[]"]').length > 0) {
    //         jQuery(obj).closest('tr').find('select[name="per_type[]"]').after('<span class="infos">Invalid Per</span>');
    //     }
    // }
    if (parseFloat(per_type_error) == 0) {
        if (jQuery(obj).closest('tr').find('input[name="per_type[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="per_type[]"]').after('<span class="infos">Invalid Per</span>');
        }
    }

    var final_rate = "";
    if (parseFloat(rate_check) == 1 && parseFloat(rate_error) == 1 && parseFloat(per_check) == 1 && parseFloat(per_error) == 1 && parseFloat(per_type_check) == 1 && parseFloat(per_type_error) == 1) {
        if (selected_unit_type == '1') {
            if (selected_per_type == '1') {
                final_rate = parseFloat(selected_rate) / parseFloat(selected_per);
            }
            else if (selected_per_type == '2') {
                rate_per_piece = parseFloat(selected_rate) / parseFloat(selected_per);
                final_rate = parseFloat(rate_per_piece) * parseFloat(selected_content);
            }
        }
        else if (selected_unit_type == '2') {
            if (selected_per_type == '1') {
                rate_per_case = parseFloat(selected_rate) / parseFloat(selected_per);
                final_rate = parseFloat(rate_per_case) / parseFloat(selected_content);
            }
            else {
                final_rate = parseFloat(selected_rate) / parseFloat(selected_per);
            }
        }

        if (parseInt(gst_option) == 1) {
            var tax = "";
            if (tax_type == 1) {
                tax = product_tax
            }
            else {
                tax = overall_tax;
            }
            if (parseInt(tax_option) == 2) {
                if (tax != 0 && tax != "" && typeof tax != "undefined") {
                    tax = tax.replace('%', '');
                    tax = tax.trim();
                    final_price = (parseFloat(final_rate) * 100) / (100 + parseFloat(tax));
                    final_rate = final_price.toFixed(2);
                }
            }
            else {
                if (tax != 0 && tax != "" && typeof tax != "undefined") {
                    tax = tax.replace('%', '');
                    tax = tax.trim();
                    final_price = (parseFloat(final_rate) * 100) / 100;
                    final_rate = final_price.toFixed(2);
                }
            }
        }

        if (jQuery(obj).closest('tr').find('.final_rate').length > 0) {
            jQuery(obj).closest('tr').find('.final_rate').html(parseFloat(final_rate).toFixed(2));
        }
        if (jQuery(obj).closest('tr').find('input[name="final_rate[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="final_rate[]"]').val(parseFloat(final_rate).toFixed(2));
        }

    }
    else {
        if (jQuery(obj).closest('tr').find('.final_rate').length > 0) {
            jQuery(obj).closest('tr').find('.final_rate').html('');
        }
        if (jQuery(obj).closest('tr').find('input[name="final_rate[]"]').length > 0) {
            jQuery(obj).closest('tr').find('input[name="final_rate[]"]').val('');
        }
    }

    var amount = "";
    if (final_rate != '' && selected_quantity != '') {
        amount = (parseFloat(final_rate) * parseFloat(selected_quantity));
        amount = amount.toFixed(2);
    }


    if (jQuery(obj).closest('tr').find('.amount').length > 0) {
        jQuery(obj).closest('tr').find('.amount').html(amount);
    }
    if (jQuery(obj).closest('tr').find('input[name="amount[]"]').length > 0) {
        jQuery(obj).closest('tr').find('input[name="amount[]"]').val(amount);
    }
    calTotal();
}

function calTotal() {
    SnoCalculation();
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
    // if (jQuery('.round_off').length > 0) {
    //     jQuery('.round_off').html('');
    // }
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
    if (jQuery('.product_row').length > 0) {
        jQuery('.product_row').each(function () {
            var final_rate = 0; var selected_quantity = ""; var amount = 0;

            if (jQuery(this).find('input[name="final_rate[]"]').length > 0) {
                final_rate = jQuery(this).find('input[name="final_rate[]"]').val();
                final_rate = jQuery.trim(parseFloat(final_rate).toFixed(2));
            }
            if (jQuery(this).find('input[name="quantity[]"]').length > 0) {
                selected_quantity = jQuery(this).find('input[name="quantity[]"]').val();
                selected_quantity = jQuery.trim(selected_quantity);
            }
            var amount = "";
            // if(rate_per_case !="" && rate_per_case != 0 && typeof rate_per_case != "undefined" && price_regex.test(rate_per_case) == true) {
            //     final_price = rate_per_case;
            // if(parseInt(gst_option) == 1) {
            //     if(parseInt(tax_option) == 2) {
            //          if(parseInt(tax_type) == 2) {
            //             if(overall_tax != 0 && overall_tax != "" && typeof overall_tax != "undefined") {
            //                 overall_tax = overall_tax.replace('%', '');
            //                 overall_tax = overall_tax.trim();
            //                 final_price = (parseFloat(rate_per_case) * 100) / (100 + parseFloat(overall_tax));
            //                 final_price = final_price.toFixed(2);
            //             }
            //         }
            //     }
            // }

            if (selected_quantity != "" && selected_quantity != 0 && typeof final_rate != "undefined" && price_regex.test(final_rate) == true) {
                amount = parseFloat(selected_quantity) * parseFloat(final_rate);
                amount = amount.toFixed(2);
                if (jQuery(this).find('input[name="amount[]"]').length > 0) {
                    amount = jQuery(this).find('input[name="amount[]"]').val();
                }
            }
            // }
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
    getAgentCommission();
    getGST();
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
    // if (jQuery('.round_off').length > 0) {
    //     jQuery('.round_off').html('');
    // }
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
            if (jQuery('.product_row').length > 0) {
                jQuery('.product_row').each(function () {
                    var amount = 0; var discount = ""; var discounted_amount = 0; var tax_percentage = ""; var tax = "";
                    var tax_value = 0;
                    amount = jQuery(this).find('input[name="amount[]"]').val();
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
                if (sub_total != "" && sub_total != 0 && typeof sub_total != "undefined" && price_regex.test(sub_total) == true) {
                    // if(parseInt(tax_option) == 1)
                    // {
                    overall_tax_value = (parseFloat(sub_total) * parseFloat(overall_tax)) / 100;
                    // }
                    // else if(parseInt(tax_option) == 2)
                    // {
                    //     overall_tax_value = (parseFloat(sub_total) * parseFloat(overall_tax)) / (100 + parseInt(overall_tax));
                    // }
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
}

function getAgentCommission() {
    var agent_commission = "";
    if (jQuery('input[name="agent_commission"]').length > 0) {
        agent_commission = jQuery('input[name="agent_commission"]').val();
        agent_commission = agent_commission.replace('%', '');
    }
    var overall_total = 0;
    if (jQuery('.overall_total').length > 0) {
        overall_total = jQuery('.overall_total').html();
    }
    if (agent_commission != "" && agent_commission != 0 && typeof agent_commission != "undefined" && agent_commission != null) {
        var commission_total = (overall_total * agent_commission) / 100;
        if (jQuery('.commission_total').length > 0) {
            commission_total = commission_total.toFixed(2);
            commission_total = jQuery('.commission_total').html(commission_total);
        }
    }
    checkOverallAmount();
}

function GetChargesType(obj) {
    var other_charges_id = "";
    other_charges_id = jQuery(obj).val();
    var post_url = "proforma_invoice_changes.php?get_charges_type=" + other_charges_id;
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

function AddChargesRow(obj) {
    var check_login_session = 1; var colspan = "";
    if (jQuery(".charges_head").length > 0) {
        colspan = jQuery(".charges_head").first().attr("colspan");
    }

    var sno = 1;
    jQuery('.charges_row').each(function () {
        jQuery('.charges_head').each(function (index) {
            jQuery(this).closest('tr').attr('id', 'charges_row_' + (index + 1));
        });
        jQuery('.charges_row_total').each(function (index) {
            jQuery(this).closest('tr').attr('id', 'charges_row_' + (index + 1));
        });
        sno++;
    });
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                var charges_count = 0;
                charges_count = jQuery('input[name="charges_count"]').val();
                if (charges_count < 5) {
                    charges_count = parseInt(charges_count) + 1;
                    jQuery('input[name="charges_count"]').val(charges_count);
                }
                var post_url = "proforma_invoice_changes.php?get_charges_row=1&charges_count=" + charges_count + "&colspan=" + colspan;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        result = jQuery.trim(result);
                        if (charges_count < 5) {
                            if (jQuery('.charges_row').length > 0) {
                                jQuery('.charges_row').last().after(result);
                            }
                        }
                    }
                });
            }
            else {
                window.location.reload();
            }
        }
    });
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
                if (jQuery(this).find('input[name="other_charges_value[]"]').length > 0) {
                    charges_value = jQuery(this).find('input[name="other_charges_value[]"]').val();
                    charges_value = charges_value.trim();
                    if (charges_value != "" && charges_value != 0 && typeof charges_value != "undefined" && charges_value != null) {
                        if (charges_value.indexOf('%') != -1) {
                            charges_value = charges_value.replace('%', '');
                            charges_value = charges_value.trim();
                            if (price_regex.test(charges_value) == false) {
                                charges_check = 0;
                            }
                            else {
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
                    if (jQuery(this).find('.other_charges_total').length > 0) {
                        jQuery(this).find('.other_charges_total').html(charges_value, 2);
                    }
                    if (jQuery(this).find('.charges_sub_total').length > 0) {
                        jQuery(this).find('.charges_sub_total').html(total_amount, 2);
                    }

                }
                else if (parseInt(charges_check) == 0) {
                    total_amount = 0;
                    if (jQuery(this).find('.other_charges_total').length > 0) {
                        jQuery(this).find('.other_charges_total').html('<span class="infos">Invalid</span>');
                    }
                }
                else {
                    if (jQuery(this).find('.other_charges_total').length > 0) {
                        jQuery(this).find('.other_charges_total').html('0.00');
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
    getAgentCommission();
    getGST();
    checkGST();
}

function AddproformaProducts(event) {
    event.preventDefault();
    if (jQuery('.add_products_button').length > 0) {
        jQuery('.add_products_button').attr('disabled', true);
    }

    var gst_option = "";
    if (jQuery('input[name="gst_option"]').length > 0) {
        gst_option = jQuery('input[name="gst_option"]').val();
    }

    var tax_type = "";
    if (jQuery('select[name="tax_type"]').length > 0) {
        tax_type = jQuery('select[name="tax_type"]').val();
    }
    var check_login_session = 1; var all_errors_check = '';
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {

                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var subunit_need = "";
                if (jQuery('input[name="selected_subunit_need"]').length > 0) {
                    subunit_need = jQuery('input[name="selected_subunit_need"]').val();
                    subunit_need = jQuery.trim(subunit_need);
                }
                var selected_product_id = "";
                if (jQuery('select[name="selected_product_id"]').length > 0) {
                    selected_product_id = jQuery('select[name="selected_product_id"]').val();
                    selected_product_id = jQuery.trim(selected_product_id);
                    if (typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
                        all_errors_check = "Product";
                    }
                }

                var selected_quantity = 0;
                if (jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if (typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Quantity" : "Quantity";
                    }
                    else if (price_regex.test(selected_quantity) == false) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Quantity" : "Quantity";
                    }
                    else if (parseFloat(selected_quantity) > 99999) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Quantity" : "Quantity";
                    }
                }

                var selected_unit_type = "";
                if (jQuery('select[name="selected_unit_type"]').length > 0) {
                    selected_unit_type = jQuery('select[name="selected_unit_type"]').val();
                    selected_unit_type = jQuery.trim(selected_unit_type);
                    if (typeof selected_unit_type == "undefined" || selected_unit_type == "" || selected_unit_type == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Unit" : "Unit";
                    }
                }


                var selected_rate = 0;
                if (jQuery('input[name="selected_sales_rate"]').length > 0) {
                    selected_rate = jQuery('input[name="selected_sales_rate"]').val();
                    selected_rate = jQuery.trim(selected_rate);
                    if (typeof selected_rate == "undefined" || selected_rate == "" || selected_rate == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Rate" : "Rate";
                    }
                    else if (price_regex.test(selected_rate) == false) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Rate" : "Rate";
                    }
                    else if (parseFloat(selected_rate) > 99999) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Rate" : "Rate";
                    }
                }

                var selected_per = 0;
                if (jQuery('input[name="selected_per"]').length > 0) {
                    selected_per = jQuery('input[name="selected_per"]').val();
                    selected_per = jQuery.trim(selected_per);
                    if (typeof selected_per == "undefined" || selected_per == "" || selected_per == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Per" : "Per";
                    }
                    else if (price_regex.test(selected_per) == false) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Per" : "Per";
                    }
                    else if (parseFloat(selected_per) > 99999) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Per" : "Per";
                    }
                }

                var selected_per_type = "";
                if (jQuery('select[name="selected_per_type"]').length > 0) {
                    selected_per_type = jQuery('select[name="selected_per_type"]').val();
                    selected_per_type = jQuery.trim(selected_per_type);
                    if (typeof selected_per_type == "undefined" || selected_per_type == "" || selected_per_type == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Per" : "Per";
                    }
                }

                var selected_final_rate = "";
                if (jQuery('input[name="selected_final_rate"]').length > 0) {
                    selected_final_rate = jQuery('input[name="selected_final_rate"]').val();
                    selected_final_rate = jQuery.trim(selected_final_rate);
                    if (typeof selected_final_rate == "undefined" || selected_final_rate == "" || selected_final_rate == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Final Rate" : "Final Rate";
                    }
                }

                var selected_amount = "";
                if (jQuery('input[name="selected_amount"]').length > 0) {
                    selected_amount = jQuery('input[name="selected_amount"]').val();
                    selected_amount = jQuery.trim(selected_amount);
                    if (typeof selected_amount == "undefined" || selected_amount == "" || selected_amount == 0) {
                        all_errors_check = (all_errors_check != '') ? all_errors_check + ", Amount" : "Amount";
                    }
                }

                var selected_content = 0;
                if (subunit_need == '1') {
                    if (jQuery('input[name="selected_content"]').length > 0) {
                        selected_content = jQuery('input[name="selected_content"]').val();
                        selected_content = jQuery.trim(selected_content);
                        if (typeof selected_content == "undefined" || selected_content == "" || selected_content == 0) {
                            all_errors_check = (all_errors_check != '') ? all_errors_check + ", Content" : "Content";
                        }
                        else if (price_regex.test(selected_content) == false) {
                            all_errors_check = (all_errors_check != '') ? all_errors_check + ", Content" : "Content";
                        }
                        else if (parseFloat(selected_content) > 99999) {
                            all_errors_check = (all_errors_check != '') ? all_errors_check + ", Content" : "Content";
                        }
                    }

                }
                if (all_errors_check == '') {
                    var add = 1;
                    if (selected_product_id != "") {
                        if (jQuery('input[name="product_id[]"]').length > 0) {
                            jQuery('.proforma_invoice_table tbody').find('tr').each(function () {
                                var prev_product_id = ""; var prev_content = ""; var prev_unit_type = "";
                                prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                                if (jQuery('input[name="content[]"]').length > 0) {
                                    prev_content = jQuery(this).find('input[name="content[]"]').val();
                                }
                                if (subunit_need == '1') {
                                    if (prev_product_id == selected_product_id && prev_content == selected_content && prev_unit_type == selected_unit_type) {
                                        add = 0;
                                    }
                                }
                                else if (subunit_need == '0') {
                                    if (prev_product_id == selected_product_id && prev_unit_type == selected_unit_type) {
                                        add = 0;
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
                        var post_url = "proforma_invoice_changes.php?product_row_index=" + product_count + "&selected_product_id=" + selected_product_id + "&selected_quantity=" + selected_quantity + "&selected_unit_type=" + selected_unit_type + "&selected_content=" + selected_content + "&selected_rate=" + selected_rate + "&selected_per=" + selected_per + "&selected_per_type=" + selected_per_type + "&selected_final_rate=" + selected_final_rate + "&selected_amount=" + selected_amount + "&subunit_need=" + subunit_need;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.proforma_invoice_table tbody').find('tr').length > 0) {
                                    jQuery('.proforma_invoice_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.proforma_invoice_table tbody').append(result);
                                }
                                if (jQuery('.add_products_button').length > 0) {
                                    jQuery('.add_products_button').attr('disabled', false);
                                }

                                if (jQuery('select[name="magazine_type"]').length > 0) {
                                    jQuery('.overall_magazine').addClass('d-none');
                                    jQuery('.indv_magazine').addClass('d-none');

                                    magazine_type = jQuery('select[name="magazine_type"]').val();
                                    if (magazine_type == '2') {
                                        if (jQuery('.indv_magazine').length > 0) {
                                            jQuery('.indv_magazine').removeClass('d-none');
                                        }
                                    }
                                    else {
                                        if (jQuery('.overall_magazine').length > 0) {
                                            jQuery('.overall_magazine').removeClass('d-none');
                                        }
                                    }
                                }

                                if (jQuery('select[name="selected_brand_id"]').length > 0) {
                                    jQuery('select[name="selected_brand_id"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="selected_product_id"]').length > 0) {
                                    jQuery('select[name="selected_product_id"]').val('').trigger('change');
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('input[name="selected_unit_type"]').length > 0) {
                                    jQuery('input[name="selected_unit_type"]').val('').trigger('change');
                                }
                                if (jQuery('input[name="selected_content"]').length > 0) {
                                    jQuery('input[name="selected_content"]').val('');
                                }
                                if (jQuery('input[name="selected_subunit_need"]').length > 0) {
                                    jQuery('input[name="selected_subunit_need"]').val('');
                                }
                                if (jQuery('input[name="selected_total_quantity"]').length > 0) {
                                    jQuery('input[name="selected_total_quantity"]').val('');
                                }
                                if (jQuery('input[name="selected_rate"]').length > 0) {
                                    jQuery('input[name="selected_rate"]').val('');
                                }
                                if (jQuery('input[name="selected_per"]').length > 0) {
                                    jQuery('input[name="selected_per"]').val('');
                                }
                                if (jQuery('input[name="selected_final_rate"]').length > 0) {
                                    jQuery('input[name="selected_final_rate"]').val('');
                                }
                                if (jQuery('input[name="selected_amount"]').length > 0) {
                                    jQuery('input[name="selected_amount"]').val('');
                                }
                                if (jQuery('select[name="selected_per_type"]').length > 0) {
                                    jQuery('select[name="selected_per_type"]').val('1').trigger('change');
                                }
                                if (jQuery('.selecte_amount').length > 0) {
                                    jQuery('.selecte_amount').html('');
                                }
                                if (jQuery('.selecte_fianl_rate').length > 0) {
                                    jQuery('.selecte_fianl_rate').html('');
                                }
                                if (jQuery('.selecte_amount').length > 0) {
                                    jQuery('.selecte_amount').html('');
                                }
                                if (jQuery('.action_element').length > 0) {
                                    jQuery('.action_element').removeClass('d-none');
                                }

                                var addcol = 0;
                                if (gst_option == '1' && tax_type == '1') {
                                    if (jQuery('.tax_element').length > 0) {
                                        jQuery('.tax_element').removeClass('d-none');
                                    }
                                }

                                if (jQuery('.product_row').length > 0) {
                                    var product_row = 0;
                                    jQuery('.product_row').each(function () {
                                        product_row = product_row + 1;
                                    });

                                    if (product_row != 0) {
                                        if ((jQuery('select[name="magazine_id"]').length > 0) && ((jQuery('select[name="magazine_type"]').length > 0))) {
                                            if ((jQuery('#div_selected_magazine_type').length > 0) && jQuery('#div_selected_magazine_id').length > 0) {
                                                jQuery('#div_selected_magazine_type').css({
                                                    'pointer-events': 'none',
                                                    'background-color': '#e9ecef'
                                                });
                                                jQuery('#div_selected_magazine_id').css({
                                                    'pointer-events': 'none',
                                                    'background-color': '#e9ecef'
                                                });
                                            }
                                        }
                                    }
                                }

                                calTotal();
                            }
                        });
                    } else {

                        // if(godown_type == 1){
                        jQuery('.proforma_invoice_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This Product and Contains and Unit type Already Exists</span>');
                        if (jQuery('.add_products_button').length > 0) {
                            jQuery('.add_products_button').attr('disabled', false);
                        }
                        // }else{
                        //      jQuery('.received_slip_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">This Godown, Product and Contains Already Exists</span>');
                        // }
                    }
                }
                else {
                    jQuery('.proforma_invoice_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Check ' + all_errors_check + '</span>');
                    if (jQuery('.add_products_button').length > 0) {
                        jQuery('.add_products_button').attr('disabled', false);
                    }
                }

            }
            else {
                window.location.reload();
            }
        }
    });
}

function CalProductAmount() {
    var quantity = jQuery('input[name="selected_quantity"]').val() || 0;
    var content = jQuery('input[name="selected_content"]').val();
    var rate = jQuery('input[name="selected_sales_rate"]').val() || 0;
    var per = jQuery('input[name="selected_per"]').val() || 1;
    var unit_type = jQuery('select[name="selected_unit_type"]').val();
    var per_type = jQuery('select[name="selected_per_type"]').val();
    var final_rate = jQuery('input[name="selected_final_rate"]');

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

        if (per_rate != 0) {
            if (final_rate.length > 0) {
                jQuery('input[name="selected_final_rate"]').val(per_rate.toFixed(2));
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

            if (per_rate != 0) {
                if (final_rate.length > 0) {
                    jQuery('input[name="selected_final_rate"]').val(per_rate.toFixed(2));
                }
            }
        }
    }

    var selected_amount = jQuery('input[name="selected_amount"]');
    if (selected_amount.length > 0) {
        selected_amount.val(total_amount.toFixed(2));
    }
}

// function CalProductAmount() {
//     if (jQuery('span.infos').length > 0) {
//         jQuery('span.infos').remove();
//     }
//     var contains_check = 1; var contains_error = 1; var rate_error = 1; var rate_check = 1;
//     var content = ""; var per_check = 1; var per_error = 1; var per_type_check = 1; var per_type_error = 1; var subunitNeed = 0;
//     var selected_amount = 0; var selected_subunit_amount = 0;

//     var selected_rate = "";
//     if (jQuery('input[name="selected_sales_rate"]').length > 0) {
//         selected_rate = jQuery('input[name="selected_sales_rate"]').val();
//         selected_rate = jQuery.trim(selected_rate);
//         if (typeof selected_rate == "undefined" || selected_rate == "" || selected_rate == 0) {
//             rate_check = 0;
//         }
//         else if (price_regex.test(selected_rate) == false) {
//             rate_error = 0;
//         }
//         else if (parseFloat(selected_rate) > 99999) {
//             rate_error = 0;
//         }
//     }
//     var selected_per = "";
//     if (jQuery('input[name="selected_per"]').length > 0) {
//         selected_per = jQuery('input[name="selected_per"]').val();
//         selected_per = jQuery.trim(selected_per);
//         if (typeof selected_per == "undefined" || selected_per == "" || selected_per == 0) {
//             per_check = 0;
//         }
//         else if (price_regex.test(selected_per) == false) {
//             per_error = 0;
//         }
//         else if (parseFloat(selected_per) > 99999) {
//             per_error = 0;
//         }
//     }
//     var selected_per_type = "";
//     if (jQuery('select[name="selected_per_type"]').length > 0) {
//         selected_per_type = jQuery('select[name="selected_per_type"]').val();
//         selected_per_type = jQuery.trim(selected_per_type);
//         if (typeof selected_per_type == "undefined" || selected_per_type == "" || selected_per_type == 0) {
//             per_type_check = 0;
//         }
//         else if (price_regex.test(selected_per_type) == false) {
//             per_type_error = 0;
//         }
//         else if (parseFloat(selected_per_type) > 99999) {
//             per_type_error = 0;
//         }
//     }
//     if (jQuery('input[name="selected_subunit_need"]').length > 0) {
//         subunitNeed = jQuery('input[name="selected_subunit_need"]').val();
//     }

//     if (jQuery('input[name="selected_content"]').length > 0) {
//         content = jQuery('input[name="selected_content"]').val();
//         content = jQuery.trim(content);
//         if (typeof content == "undefined" || content == "" || content == 0) {
//             if (subunitNeed == '1') {
//                 contains_check = 0;
//             }
//         }
//         else if (price_regex.test(content) == false) {
//             contains_error = 0;
//         }
//         else if (parseFloat(content) > 99999) {
//             contains_error = 0;
//         }
//     }

//     var final_rate = 0;
//     if (subunitNeed == 1) {
//         if (parseFloat(per_check) == 1 && parseFloat(per_error) == 1 && parseFloat(per_type_check) == 1 && parseFloat(per_type_error) == 1 && parseFloat(contains_check) == 1 && parseFloat(contains_error) == 1) {
//             rate_per_unit = parseFloat(selected_rate) / parseFloat(selected_per);
//             if (selected_per_type == '1') {
//                 selected_amount = rate_per_unit;
//                 selected_subunit_amount = rate_per_unit;
//                 final_rate = selected_subunit_amount;
//             }
//             else if (selected_per_type == '2') {
//                 selected_subunit_amount = rate_per_unit;
//                 selected_amount = parseFloat(rate_per_unit) * parseFloat(content);
//                 final_rate = selected_amount;
//             }

//             if (jQuery('input[name="selected_final_rate"]').length > 0) {
//                 jQuery('input[name="selected_final_rate"]').val(final_rate);
//             }

//         }
//         else {
//             if (jQuery('input[name="selected_final_rate"]').length > 0) {
//                 jQuery('input[name="selected_final_rate"]').val('');
//             }
//         }
//     } else {
//         if (parseFloat(per_check) == 1 && parseFloat(per_error) == 1 && parseFloat(per_type_check) == 1 && parseFloat(per_type_error) == 1) {
//             rate_per_unit = parseFloat(selected_rate) / parseFloat(selected_per);


//             if (selected_per_type == '1') {
//                 selected_amount = rate_per_unit;
//                 final_rate = selected_amount;
//             }
//             else if (selected_per_type == '2') {
//                 selected_amount = parseFloat(content) * parseFloat(rate_per_unit);
//                 final_rate = selected_amount;
//             }
//             if (jQuery('input[name="selected_final_rate"]').length > 0) {
//                 jQuery('input[name="selected_final_rate"]').val(final_rate);
//             }
//         }
//         else {
//             if (jQuery('#rate_per_unit').length > 0) {
//                 jQuery('#rate_per_unit').html('');
//             }
//             if (jQuery('#rate_per_subunit').length > 0) {
//                 jQuery('#rate_per_subunit').html('');
//             }
//             if (jQuery('input[name="selected_final_rate"]').length > 0) {
//                 jQuery('input[name="selected_final_rate"]').val('');
//             }
//         }
//     }

//     var quantity_error = 1; var quantity_check = 1;

//     var selected_quantity = "";
//     if (jQuery('input[name="selected_quantity"]').length > 0) {
//         selected_quantity = jQuery('input[name="selected_quantity"]').val();
//         selected_quantity = jQuery.trim(selected_quantity);
//         if (typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
//             quantity_check = 0;
//         }
//         else if (price_regex.test(selected_quantity) == false) {
//             quantity_error = 0;
//         }
//         else if (parseFloat(selected_quantity) > 99999) {
//             quantity_error = 0;
//         }
//     }
//     if (parseFloat(quantity_check) == 1 && parseFloat(quantity_error) == 1 && parseFloat(rate_error) == 1 && parseFloat(rate_check) == 1) {
//         var selected_amount = "";
//         selected_amount = parseFloat(selected_quantity) * parseFloat(final_rate);
//         if (jQuery('input[name="selected_amount"]').length > 0) {
//             jQuery('input[name="selected_amount"]').val(selected_amount);
//         }
//     }

// }

function getRateByTaxOption() {
    var tax_option = "";
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
        if (jQuery('.product_row').length > 0) {
            jQuery('.product_row').each(function () {

                var unit_type = "";
                if (jQuery(this).find('input[name="unit_type[]"]').length > 0) {
                    unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                    unit_type = jQuery.trim(unit_type);
                }

                var content = "";
                if (jQuery(this).find('input[name="content[]"]').length > 0) {
                    content = jQuery(this).find('input[name="content[]"]').val();
                    content = jQuery.trim(content);
                }



                var per = "";
                if (jQuery(this).find('input[name="per[]"]').length > 0) {
                    per = jQuery(this).find('input[name="per[]"]').val();
                    per = jQuery.trim(per);
                }

                var per_type = "";
                if (jQuery(this).find('select[name="per_type[]"]').length > 0) {
                    per_type = jQuery(this).find('select[name="per_type[]"]').val();
                    per_type = jQuery.trim(per_type);
                }

                if (jQuery(this).find('input[name="rate[]"]').length > 0) {
                    selected_rate = jQuery(this).find('input[name="rate[]"]').val();
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
                    // var tax = jQuery(this).find('.tax').html();
                    // var tax = product_tax.value;
                    // tax = jQuery.trim(tax);
                    if (price_regex.test(final_rate) == true) {
                        // if(typeof tax != "undefined" && tax != null && tax != "") {
                        //     tax = tax.replace("%", "");
                        //     tax = jQuery.trim(tax);
                        // }
                        if (price_regex.test(tax) == true) {
                            if (tax_option == 2) {
                                rate = (parseFloat(final_rate) * 100) / (parseFloat(tax) + 100);
                                // rate = check_decimal(rate);
                            }
                            else if (tax_option == 1) {
                                // var tax_value = 0;
                                // tax_value = (parseFloat(selected_rate) * parseFloat(tax)) / 100;
                                // // tax_value = check_decimal(tax_value);
                                // if (price_regex.test(tax_value) == true) {
                                //     rate = parseFloat(selected_rate) + parseFloat(tax_value);
                                //     // rate = check_decimal(rate);
                                //     rate = Math.floor(rate);
                                // }
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
                                jQuery(this).find('.final_rate').html(parseFloat(rate).toFixed(2));
                            }
                            // if (jQuery(this).find('.amount').length > 0) {
                            //     jQuery(this).find('.amount').html(product_price);
                            // }
                            var discount = 0;
                            // if(jQuery(this).find('input[name="product_discount[]"]').length > 0) {
                            //     discount = jQuery(this).find('input[name="product_discount[]"]').val();
                            //     discount = jQuery.trim(discount);
                            // }

                            // if(price_regex.test(discount) == true) {
                            //     if(price_regex.test(rate) == true) {
                            //         var discount_value = 0;
                            //         if(discount.indexOf('%') != -1) {
                            //             discount = discount.replace("%", "");
                            //             discount = jQuery.trim(discount);
                            //             if(price_regex.test(discount) == true) {
                            //                 discount_value = (parseFloat(rate) * parseFloat(discount)) / 100;
                            //             }
                            //         }
                            //         else {
                            //             discount = jQuery.trim(discount);
                            //             if(price_regex.test(discount) == true) {
                            //                 discount_value = (parseFloat(rate) * parseFloat(discount)) / 100;
                            //             }
                            //         }
                            //         if(price_regex.test(discount_value) == true) {
                            //             discount_value = check_decimal(discount_value);
                            //             product_price = rate - discount_value;
                            //             product_price = check_decimal(product_price);
                            //         }
                            //     }
                            // }
                            var quantity = "";
                            if (jQuery(this).find('input[name="quantity[]"]').length > 0) {
                                quantity = jQuery(this).find('input[name="quantity[]"]').val();
                                quantity = jQuery.trim(quantity);
                                if (price_regex.test(quantity) == true && price_regex.test(product_price) == true) {
                                    var amount = "";

                                    amount = parseFloat(quantity) * parseFloat(product_price);
                                    amount = amount.toFixed(2);
                                    // amount = check_decimal(amount);
                                    if (jQuery(this).find('.amount').length > 0) {

                                        jQuery(this).find('.amount').html(amount);
                                    }
                                    if (jQuery(this).find('input[name="amount[]"]').length > 0) {

                                        jQuery(this).find('input[name="amount[]"]').val(amount);
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

function DeleteChargesRow(obj, row_index) {
    if (jQuery("input[name='charges_count']").length > 0) {
        charges_count = jQuery('input[name="charges_count"]').val();
        charges_count = parseInt(charges_count) - 1;
        jQuery('input[name="charges_count"]').val(charges_count);
    }
    if (jQuery('#charges_row_' + row_index).length > 0) {
        jQuery('#charges_row_' + row_index).remove();
    }
    if (jQuery('#charges_row_total_' + row_index).length > 0) {
        jQuery('#charges_row_total_' + row_index).remove();
    }
    CheckCharges();
}

function DeletePurchaseRow(row_index, id_name) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }

                if (!(jQuery('.product_row').length > 0)) {
                    if ((jQuery('select[name="magazine_id"]').length > 0) && ((jQuery('select[name="magazine_type"]').length > 0))) {
                        if ((jQuery('#div_selected_magazine_type').length > 0) && jQuery('#div_selected_magazine_id').length > 0) {
                            jQuery('#div_selected_magazine_type').css({
                                'pointer-events': 'auto',
                                'background-color': '#e9ecef'
                            });
                            jQuery('#div_selected_magazine_id').css({
                                'pointer-events': 'auto',
                                'background-color': '#e9ecef'
                            });
                        }
                    }
                }

                calTotal();
            }
            else {
                window.location.reload();
            }
        }
    });
    if (jQuery("input[name='charges_count']").length > 0) {
        charges_count = jQuery('input[name="charges_count"]').val();
        charges_count = parseInt(charges_count) - 1;
        jQuery('input[name="charges_count"]').val(charges_count);
    }
}

function GetProdetails() {
    var product = $("select[name='selected_product_id']").val();
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "proforma_invoice_changes.php?change_product_id=" + product;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            result = result.split("$$$");
                            if ($("select[name='selected_unit_type']").length > 0) {
                                $("select[name='selected_unit_type']").html(result[0]);
                            }
                            if ($("input[name='selected_sales_rate']").length > 0) {
                                $("input[name='selected_sales_rate']").val(result[1]);
                            }
                            if ($("input[name='selected_per']").length > 0) {
                                $("input[name='selected_per']").val(result[2]);
                            }
                            if ($("select[name='selected_per_type']").length > 0) {
                                $("select[name='selected_per_type']").html(result[0]);
                            }
                            if ($("input[name='selected_subunit_need']").length > 0) {
                                $("input[name='selected_subunit_need']").val(result[4]);
                            }
                            if (result[4] == '1') {
                                if (jQuery('.content_td').length > 0) {
                                    jQuery('.content_td').removeClass('d-none');
                                }
                            }
                            else {
                                if (jQuery('.content_td').length > 0) {
                                    jQuery('.content_td').addClass('d-none');
                                }
                            }
                            // window.globalVar = result[5].split("%%");
                        }
                    }
                });
            }
        }
    });
}

function getAgentCustomer(agent_id) {
    if (agent_id != '') {
        if (jQuery('.agent_tr').length > 0) {
            jQuery('.agent_tr').removeClass('d-none');
        }
    }
    else {
        if (jQuery('.agent_tr').length > 0) {
            jQuery('.agent_tr').removeClass('d-none');
        }
    }

    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "proforma_invoice_changes.php?get_agent_customer_id=" + agent_id;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        list = result.split("$$$");
                        // if(result != "") {
                        if (jQuery('select[name="customer_id"]').length > 0) {
                            jQuery('select[name="customer_id"]').html(list[0]);
                        }
                        if (jQuery('.agent_commission').length > 0) {
                            jQuery('.agent_commission').html(list[1]);
                        }
                        if (jQuery('.agent_commission').length > 0) {
                            jQuery('input[name="agent_commission"]').val(list[2]);
                        }
                        // }
                    }
                });
            }
        }
    });
}

function magazineList() {
    var magazine_type = "";
    if (jQuery('select[name="magazine_type"]').length > 0) {
        magazine_type = jQuery('select[name="magazine_type"]').val();
    }
    jQuery('.overall_magazine').addClass('d-none');
    jQuery('.indv_magazine').addClass('d-none');

    if (magazine_type == '1') {
        if (jQuery('.overall_magazine').length > 0) {
            jQuery('.overall_magazine').removeClass('d-none');
        }
    }
    else if (magazine_type == '2') {
        if (jQuery('.indv_magazine').length > 0) {
            jQuery('.indv_magazine').removeClass('d-none');
        }
    }

    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (magazine_type == 1) {
                    var magazine_id = "";
                    if (jQuery('select[name="magazine_id"]').length > 0) {
                        magazine_id = jQuery('select[name="magazine_id"]').val();
                    }
                    if (magazine_id != "") {
                        post_url = "proforma_invoice_changes.php?get_product_by_magazine=" + magazine_type + "&magazine_id=" + magazine_id;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                jQuery('select[name="selected_product_id"]').html(result);
                            }
                        });
                    }
                } else {
                    post_url = "proforma_invoice_changes.php?get_product_by_magazine=" + magazine_type;
                    jQuery.ajax({
                        url: post_url, success: function (result) {
                            jQuery('select[name="selected_product_id"]').html(result);
                        }
                    });
                }
            }
        }
    });
    getGST();
}

function changeState() {
    var customer_id = "";
    if (jQuery('select[name="customer_id"]').length > 0) {
        customer_id = jQuery('select[name="customer_id"]').val();
    }

    if (customer_id != '') {
        var check_login_session = 1;
        var post_url = "dashboard_changes.php?check_login_session=1";
        jQuery.ajax({
            url: post_url, success: function (check_login_session) {
                if (check_login_session == 1) {
                    post_url = "proforma_invoice_changes.php?party_change_state=" + customer_id;
                    jQuery.ajax({
                        url: post_url, success: function (result) {
                            if (result != '') {
                                if (jQuery('input[name="party_state"]').length > 0) {
                                    jQuery('input[name="party_state"]').val(result);
                                    getGST();
                                    checkGST();
                                }
                            }
                        }
                    });
                }
            }
        });
    }
}