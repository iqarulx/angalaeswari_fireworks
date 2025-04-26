
var number_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;

function GetProducts() {
    var contractor_id = "";
    if(jQuery('select[name="selected_contractor_id"]').length > 0) {
        contractor_id = jQuery('select[name="selected_contractor_id"]').val();
        contractor_id = contractor_id.trim();
    }
    var post_url = "daily_production_changes.php?products_contractor_id="+contractor_id;
    jQuery.ajax({
		url: post_url, success: function (result) {
            result = result.trim();
            if(jQuery('select[name="selected_product_id"]').length > 0) {
                jQuery('select[name="selected_product_id"]').html(result);
            }
        }
    });
}

function GetUnit(product_id) {
    if(jQuery('.current_stock_div').length > 0) {
        jQuery('.current_stock_div').html('');
    }

    var magazine_id = "";
    if(jQuery('select[name="selected_magazine_id"]').length > 0) {
        magazine_id = jQuery('select[name="selected_magazine_id"]').val();
        magazine_id = jQuery.trim(magazine_id);
    }
    var post_url = "daily_production_changes.php?get_unit="+product_id+"&product_magazine_id="+magazine_id;
    jQuery.ajax({
        url: post_url, success: function (result) {

            result = result.trim();
            result = result.split("$$$");
            if(jQuery('select[name="selected_unit_id"]').length > 0) {
                jQuery('select[name="selected_unit_id"]').html(result[0]);
            }
            // alert(result+"/"+result[1])
			if(result[1] != ""){
				if(jQuery(".contains_div").length > 0){
					jQuery(".contains_div").removeClass("d-none");
				}
				if(jQuery('select[name="selected_contains"]').length > 0) {
					jQuery('select[name="selected_contains"]').html(result[1]);
				}
			}else{
				if(jQuery(".contains_div").length > 0){
					jQuery(".contains_div").addClass("d-none");
				}
				if(jQuery('select[name="selected_contains"]').length > 0) {
					jQuery('select[name="selected_contains"]').html('');
				}
			}
		
            if(jQuery('.current_stock_div').length > 0) {
                jQuery('.current_stock_div').html(result[2]);
            }
            if(product_id != "" && typeof product_id != "undefined" && product_id != null) {
                if(jQuery('input[name="selected_quantity"]').length > 0) {
                    jQuery('input[name="selected_quantity"]').focus();
                }
            }
        }
    });
}


function AddDailyProductionProducts(){
	var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function() { jQuery(this).remove(); });
				}
                var magazine_id = ""; var add = 1; var all_errors_check = 1;
                if(jQuery('select[name="selected_magazine_id"]').length > 0) {
                    magazine_id = jQuery('select[name="selected_magazine_id"]').val();
                    magazine_id = jQuery.trim(magazine_id);
                    if(typeof magazine_id == "undefined" || magazine_id == "" || magazine_id == 0) {
                        all_errors_check = 0;
                    }
                }
				
                var contractor_id = "";
                if(jQuery('select[name="selected_contractor_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_contractor_id"]').length > 0) {
                        contractor_id = jQuery('select[name="selected_contractor_id"]').val();
                        contractor_id = jQuery.trim(contractor_id);

                        if(typeof contractor_id == "undefined" || contractor_id == "" || contractor_id == 0) {
                            all_errors_check = 0;
                        }
                    }else{
						if(jQuery('input[name="selected_contractor_id"]').length > 0) {
							contractor_id = jQuery('input[name="selected_contractor_id"]').val();
							contractor_id = jQuery.trim(contractor_id);
							if(typeof contractor_id == "undefined" || contractor_id == "" || contractor_id == 0) {
								all_errors_check = 0;
							}
						}
					}
                }

                var selected_product_id = "";
                if(jQuery('select[name="selected_product_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_product_id"]').length > 0) {
                        selected_product_id = jQuery('select[name="selected_product_id"]').val();
                        selected_product_id = jQuery.trim(selected_product_id);
                        if(typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_unit_id = "";
                if(jQuery('select[name="selected_unit_id"]').length > 0) {
                    selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
                    selected_unit_id = jQuery.trim(selected_unit_id);
                    if(typeof selected_unit_id == "undefined" || selected_unit_id == "" || selected_unit_id == 0) {
                        all_errors_check = 0;
                    }
                }

                var selected_quantity = "";
                if(jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if(typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
                        all_errors_check = 0;
                    }
                    else if(price_regex.test(selected_quantity) == false) {
                        all_errors_check = 0;
                    }
                    else if(parseFloat(selected_quantity) > 99999) {
                        all_errors_check = 0;
                    }
                }

				
                var selected_contains = "";
                if(jQuery('select[name="selected_contains"]').is(":visible")) {
					if(jQuery('select[name="selected_contains"]').length > 0) {
						selected_contains = jQuery('select[name="selected_contains"]').val();
						selected_contains = jQuery.trim(selected_contains);
						if(typeof selected_contains == "undefined" || selected_contains == "" || selected_contains == 0) {
							all_errors_check = 0;
						}
						else if(price_regex.test(selected_contains) == false) {
							all_errors_check = 0;
						}
						else if(parseFloat(selected_contains) > 99999) {
							all_errors_check = 0;
						}
					}
				}

                if(parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if(selected_product_id != "") {
                        if(jQuery('input[name="product_id[]"]').length > 0) {
                            jQuery('.daily_production_product_table tbody').find('tr').each(function () {
                                var prev_product_id = ""; var prev_unit_id = "";
                                prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                if(jQuery(this).find('input[name="unit_id[]"]').length > 0) {
                                    prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
                                }
                                if(jQuery(this).find('input[name="contains[]"]').length > 0) {
                                    prev_contains = jQuery(this).find('input[name="contains[]"]').val();
                                }
                                 if(jQuery('select[name="selected_contains"]').is(":visible")) {
                                    if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id && prev_contains == selected_contains) {
                                        add = 0;
                                    }
                                 }else{
                                    if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id) {
                                        add = 0;
                                    }
                                 }
                             
                            });
                        }
                    }

                    if(parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);

                        var post_url = "daily_production_changes.php?product_daily_production_row_index="+product_count+"&selected_contractor_id="+contractor_id+"&selected_product_id="+selected_product_id+"&selected_unit_id="+selected_unit_id+"&selected_quantity="+selected_quantity+"&selected_contains="+selected_contains;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.daily_production_product_table tbody').find('tr').length > 0) {
                                    jQuery('.daily_production_product_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.daily_production_product_table tbody').append(result);
                                }
                                if(jQuery('select[name="selected_magazine_id"]').length > 0) {
                                    jQuery('select[name="selected_magazine_id"]').attr('disabled', true);
                                }
                                if(jQuery('input[name="selected_magazine_id"]').length > 0) {
                                    jQuery('input[name="selected_magazine_id"]').attr('disabled', false);
                                    jQuery('input[name="selected_magazine_id"]').val(magazine_id);
                                }
                                if(jQuery('select[name="selected_contractor_id"]').length > 0) {
                                    jQuery('select[name="selected_contractor_id"]').attr('disabled', true);
                                    if(jQuery('input[name="selected_contractor_id"]').length > 0) {
                                        if(contractor_id != "") {
                                            jQuery('input[name="selected_contractor_id"]').attr('disabled', false);
                                            jQuery('input[name="selected_contractor_id"]').val(contractor_id);
                                        }
                                    }
                                }
                                if(jQuery('select[name="selected_product_id"]').length > 0) {
                                    jQuery('select[name="selected_product_id"]').val('').trigger('change').select2('open');
                                }
                                if(jQuery('select[name="selected_unit_id"]').length > 0) {
                                    jQuery('select[name="selected_unit_id"]').val('').trigger('change');
                                }
                                if(jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                calQuantityTotal();
                            }
                        });
                    }
                    else {
                        if(jQuery('select[name="selected_contains"]').is(":visible")) {
                            jQuery('.daily_production_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product, Unit, Content Already Exists</span>');
                        }else{
                            jQuery('.daily_production_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product & Unit Already Exists</span>');
                        }
                    
                    }
                }
                else {
                    jQuery('.daily_production_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product Details</span>');
                }
			}
			else {
				window.location.reload();
			}
		}
	});
}


function SnoCalculation(){
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


function calQuantityTotal(obj) {
    if(jQuery(obj).parent().parent().find('span.infos').length > 0) {
        jQuery(obj).parent().parent().find('span.infos').remove();
    }
    var quantity_check = 1; var quantity_error = 1; var cooly_check = 1; var cooly_error = 1;

    var selected_quantity = "";
    if(jQuery(obj).parent().parent().find('input[name="quantity[]"]').length > 0) {
        selected_quantity = jQuery(obj).parent().parent().find('input[name="quantity[]"]').val();
        selected_quantity = jQuery.trim(selected_quantity);
        if(typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
            quantity_check = 0;
        }
        else if(price_regex.test(selected_quantity) == false) {
            quantity_error = 0;
        }
        else if(parseFloat(selected_quantity) > 99999) {
            quantity_error = 0;
        }
    }

    var cooly_per_qty = "";
    if(jQuery(obj).parent().parent().find('input[name="cooly_per_qty[]"]').length > 0) {
        cooly_per_qty = jQuery(obj).parent().parent().find('input[name="cooly_per_qty[]"]').val();
        cooly_per_qty = jQuery.trim(cooly_per_qty);
        if(typeof cooly_per_qty == "undefined" || cooly_per_qty == "" || cooly_per_qty == 0) {
            cooly_check = 0;
        }
        else if(price_regex.test(cooly_per_qty) == false) {
            cooly_error = 0;
        }
        else if(parseFloat(cooly_per_qty) > 99999) {
            cooly_error = 0;
        }
    }
    
    if(parseFloat(quantity_error) == 0) {
        if(jQuery(obj).parent().parent().find('input[name="quantity[]"]').length > 0) {
            jQuery(obj).parent().parent().find('input[name="quantity[]"]').after('<span class="infos">Invalid Quantity</span>');
        }
    }
    if(parseFloat(cooly_error) == 0) {
        if(jQuery(obj).parent().parent().find('input[name="cooly_per_qty[]"]').length > 0) {
            jQuery(obj).parent().parent().find('input[name="cooly_per_qty[]"]').after('<span class="infos">Invalid Cooly / Qty</span>');
        }
    }
    var cooly_amount = 0;
    if(parseFloat(quantity_check) == 1 && parseFloat(quantity_error) == 1 && parseFloat(cooly_check) == 1 && parseFloat(cooly_error) == 1) {
        cooly_amount = parseFloat(selected_quantity) * parseFloat(cooly_per_qty);
        cooly_amount = cooly_amount.toFixed(2);
        if(cooly_amount != "" && cooly_amount != 0 && typeof cooly_amount != "undefined") {
            if(jQuery(obj).parent().parent().find('input[name="cooly_amount[]"]').length > 0) {
                jQuery(obj).parent().parent().find('input[name="cooly_amount[]"]').val(cooly_amount);
            }
        }
        else {
            if(jQuery(obj).parent().parent().find('input[name="cooly_amount[]"]').length > 0) {
                jQuery(obj).parent().parent().find('input[name="cooly_amount[]"]').val('');
            }
        }
    }
    else {
        if(jQuery(obj).parent().parent().find('input[name="cooly_amount[]"]').length > 0) {
            jQuery(obj).parent().parent().find('input[name="cooly_amount[]"]').val('');
        }
    }

    if(jQuery('.overall_total').length > 0) {
        jQuery('.overall_total').html('');
    }
    if(jQuery('.overall_qty').length > 0) {
        jQuery('.overall_qty').html('');
    }
	var overall_total = 0; var quantity_total = 0;
	if(jQuery('.product_row').length > 0) {
		jQuery('.product_row').each(function(){
            var total_amount = 0; var quantity = 0;
            if(jQuery(this).find('input[name="quantity[]"]').length > 0) {
                quantity = jQuery(this).find('input[name="quantity[]"]').val();
                quantity = jQuery.trim(quantity);
            }
      
            if (typeof quantity != "undefined" && quantity != "" && quantity != 0 && price_regex.test(quantity) == true) {
                quantity_total = parseFloat(quantity_total) + parseFloat(quantity);
			}

            if(jQuery(this).find('input[name="cooly_amount[]"]').length > 0) {
                total_amount = jQuery(this).find('input[name="cooly_amount[]"]').val();
                total_amount = jQuery.trim(total_amount);
            }
      
            if (typeof total_amount != "undefined" && total_amount != "" && total_amount != 0 && price_regex.test(total_amount) == true) {
                overall_total = parseFloat(overall_total) + parseFloat(total_amount);
			}
            
		
		});
        if (typeof quantity_total != "undefined" && quantity_total != "" && quantity_total != 0 && price_regex.test(quantity_total) == true) {
            quantity_total = quantity_total.toFixed(2);
            if(jQuery('.overall_qty').length > 0) {
                jQuery('.overall_qty').html(quantity_total);
            }
		}
        if (typeof overall_total != "undefined" && overall_total != "" && overall_total != 0 && price_regex.test(overall_total) == true) {
            overall_total = overall_total.toFixed(2);
            if(jQuery('.overall_total').length > 0) {
                jQuery('.overall_total').html(overall_total);
            }
		}
	
	}
    checkOverallAmount();
}

function checkOverallAmount() {
	var overall_total = 0; var total = 0;
	if(jQuery('.overall_total').length > 0) {
        overall_total = jQuery('.overall_total').html();
		overall_total = overall_total.replace(/ /g,'');
        overall_total = overall_total.trim();
		
		if (typeof overall_total != "undefined" && overall_total != "" && overall_total != 0) {
            if(price_regex.test(overall_total) == true) {
				total = parseFloat(total) + parseFloat(overall_total);
				var decimal = ""; var round_off = '';
				var numbers = total.toString().split('.');							
				if( typeof numbers[1] != 'undefined') {
					decimal = numbers[1];
				}
				
				if(decimal != "" && decimal != 00) {					
					if(decimal.length == 1) {
						decimal = decimal+'0';
					}
					if(parseFloat(decimal) >= 50) {
						var round_off = 0;
						round_off = 100 - parseFloat(decimal);
						
						if( typeof round_off != 'undefined' && round_off != '' && round_off != 0) {
							if(round_off.toString().length == 1){
								round_off = "0.0"+round_off;
							}
							else{
								round_off = "0."+round_off;
							}
							jQuery('.round_off').html(round_off);
							total = parseFloat(total) + parseFloat(round_off);
						}
					}
					else {
						decimal = "0."+decimal;
						total = parseFloat(total) - parseFloat(decimal);
					}
				}
                total = total.toFixed(2);
			}
		}
	}	
	if (typeof total != "undefined" && total != "" && total != 0 && price_regex.test(total) == true) {
		if(jQuery('.overall_total').length > 0) {
			jQuery('.overall_total').html(total);
		}
	}
}


function DeleteDailyProductionRow(row_index, id_name) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				console.log(id_name+row_index);
				if (jQuery('#'+id_name+row_index).length > 0) {
					jQuery('#'+id_name+row_index).remove();
				}
				if (jQuery('#'+id_name+row_index).length == 0) {
					if(jQuery('.Product_Fix_field').length > 0) {
						jQuery('.Product_Fix_field').attr('disabled', false);
					}
				}
                if(id_name == 'product_row') {
					if(jQuery('.product_row').length == 0) {
						if(jQuery('select[name="category_id"]').length > 0) {
							if(jQuery('input[name="category_id"]').length > 0) {
								jQuery('input[name="category_id"]').val('');
								jQuery('input[name="category_id"]').attr('disabled', true);
							}
							jQuery('select[name="category_id"]').attr('disabled', false);
						}
					}
                }
				SnoCalculation();
				calQuantityTotal();
			}
			else {
				window.location.reload();
			}
		}
	});
}



function GetSemiFinishedProducts() {
    var contractor_id = "";
    if(jQuery('select[name="selected_contractor_id"]').length > 0) {
        contractor_id = jQuery('select[name="selected_contractor_id"]').val();
        contractor_id = contractor_id.trim();
    }
    var post_url = "semifinished_inward_changes.php?products_contractor_id="+contractor_id;
    jQuery.ajax({
		url: post_url, success: function (result) {
            result = result.trim();
            if(jQuery('select[name="selected_product_id"]').length > 0) {
                jQuery('select[name="selected_product_id"]').html(result);
            }
        }
    });
}


function AddSemiFinishedInwardProducts(){
	var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function() { jQuery(this).remove(); });
				}
                var godown_id = ""; var add = 1; var all_errors_check = 1;
                if(jQuery('select[name="selected_godown_id"]').length > 0) {
                    godown_id = jQuery('select[name="selected_godown_id"]').val();
                    godown_id = jQuery.trim(godown_id);
                    if(typeof godown_id == "undefined" || godown_id == "" || godown_id == 0) {
                        all_errors_check = 0;
                    }
                }
				
                var contractor_id = "";
                if(jQuery('select[name="selected_contractor_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_contractor_id"]').length > 0) {
                        contractor_id = jQuery('select[name="selected_contractor_id"]').val();
                        contractor_id = jQuery.trim(contractor_id);

                        if(typeof contractor_id == "undefined" || contractor_id == "" || contractor_id == 0) {
                            all_errors_check = 0;
                        }
                    }else{
						if(jQuery('input[name="selected_contractor_id"]').length > 0) {
							contractor_id = jQuery('input[name="selected_contractor_id"]').val();
							contractor_id = jQuery.trim(contractor_id);
							if(typeof contractor_id == "undefined" || contractor_id == "" || contractor_id == 0) {
								all_errors_check = 0;
							}
						}
					}
                }

                var selected_product_id = "";
                if(jQuery('select[name="selected_product_id"]').is(":visible")) {
                    if(jQuery('select[name="selected_product_id"]').length > 0) {
                        selected_product_id = jQuery('select[name="selected_product_id"]').val();
                        selected_product_id = jQuery.trim(selected_product_id);
                        if(typeof selected_product_id == "undefined" || selected_product_id == "" || selected_product_id == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_unit_id = "";
                if(jQuery('select[name="selected_unit_id"]').length > 0) {
                    selected_unit_id = jQuery('select[name="selected_unit_id"]').val();
                    selected_unit_id = jQuery.trim(selected_unit_id);
                    if(typeof selected_unit_id == "undefined" || selected_unit_id == "" || selected_unit_id == 0) {
                        all_errors_check = 0;
                    }
                }

                var selected_quantity = "";
                if(jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if(typeof selected_quantity == "undefined" || selected_quantity == "" || selected_quantity == 0) {
                        all_errors_check = 0;
                    }
                    else if(price_regex.test(selected_quantity) == false) {
                        all_errors_check = 0;
                    }
                    else if(parseFloat(selected_quantity) > 99999) {
                        all_errors_check = 0;
                    }
                }

				
                var selected_contains = "";
                if(jQuery('select[name="selected_contains"]').is(":visible")) {
					if(jQuery('select[name="selected_contains"]').length > 0) {
						selected_contains = jQuery('select[name="selected_contains"]').val();
						selected_contains = jQuery.trim(selected_contains);
						if(typeof selected_contains == "undefined" || selected_contains == "" || selected_contains == 0) {
							all_errors_check = 0;
						}
						else if(price_regex.test(selected_contains) == false) {
							all_errors_check = 0;
						}
						else if(parseFloat(selected_contains) > 99999) {
							all_errors_check = 0;
						}
					}
				}

                if(parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if(selected_product_id != "") {
                        if(jQuery('input[name="product_id[]"]').length > 0) {
                            jQuery('.semifinished_inward_product_table tbody').find('tr').each(function () {
                                var prev_product_id = ""; var prev_unit_id = "";
                                prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                if(jQuery(this).find('input[name="unit_id[]"]').length > 0) {
                                    prev_unit_id = jQuery(this).find('input[name="unit_id[]"]').val();
                                }
                                if(jQuery(this).find('input[name="contains[]"]').length > 0) {
                                    prev_contains = jQuery(this).find('input[name="contains[]"]').val();
                                }
                                 if(jQuery('select[name="selected_contains"]').is(":visible")) {
                                    if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id && prev_contains == selected_contains) {
                                        add = 0;
                                    }
                                 }else{
                                    if (prev_product_id == selected_product_id && prev_unit_id == selected_unit_id) {
                                        add = 0;
                                    }
                                 }
                             
                            });
                        }
                    }

                    if(parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);

                        var post_url = "semifinished_inward_changes.php?product_semifinished_inward_row_index="+product_count+"&selected_contractor_id="+contractor_id+"&selected_product_id="+selected_product_id+"&selected_unit_id="+selected_unit_id+"&selected_quantity="+selected_quantity+"&selected_contains="+selected_contains;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.semifinished_inward_product_table tbody').find('tr').length > 0) {
                                    jQuery('.semifinished_inward_product_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.semifinished_inward_product_table tbody').append(result);
                                }
                                if(jQuery('select[name="selected_godown_id"]').length > 0) {
                                    jQuery('select[name="selected_godown_id"]').attr('disabled', true);
                                }
                                if(jQuery('input[name="selected_godown_id"]').length > 0) {
                                    jQuery('input[name="selected_godown_id"]').attr('disabled', false);
                                    jQuery('input[name="selected_godown_id"]').val(godown_id);
                                }
                                if(jQuery('select[name="selected_contractor_id"]').length > 0) {
                                    jQuery('select[name="selected_contractor_id"]').attr('disabled', true);
                                    if(jQuery('input[name="selected_contractor_id"]').length > 0) {
                                        if(contractor_id != "") {
                                            jQuery('input[name="selected_contractor_id"]').attr('disabled', false);
                                            jQuery('input[name="selected_contractor_id"]').val(contractor_id);
                                        }
                                    }
                                }
                                if(jQuery('select[name="selected_product_id"]').length > 0) {
                                    jQuery('select[name="selected_product_id"]').val('').trigger('change').select2('open');
                                }
                                if(jQuery('select[name="selected_unit_id"]').length > 0) {
                                    jQuery('select[name="selected_unit_id"]').val('').trigger('change');
                                }
                                if(jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                calQuantityTotal();
                            }
                        });
                    }
                    else {
                        if(jQuery('select[name="selected_contains"]').is(":visible")) {
                            jQuery('.semifinished_inward_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product, Unit, Content Already Exists</span>');
                        }else{
                            jQuery('.semifinished_inward_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product & Unit Already Exists</span>');
                        }
                    
                    }
                }
                else {
                    jQuery('.semifinished_inward_product_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product Details</span>');
                }
			}
			else {
				window.location.reload();
			}
		}
	});
}


function DeleteSemiFinishedInwardRow(row_index, id_name) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				console.log(id_name+row_index);
				if (jQuery('#'+id_name+row_index).length > 0) {
					jQuery('#'+id_name+row_index).remove();
				}
				if (jQuery('#'+id_name+row_index).length == 0) {
					if(jQuery('.Product_Fix_field').length > 0) {
						jQuery('.Product_Fix_field').attr('disabled', false);
					}
				}
                if(id_name == 'product_row') {
					if(jQuery('.product_row').length == 0) {
						if(jQuery('select[name="category_id"]').length > 0) {
							if(jQuery('input[name="category_id"]').length > 0) {
								jQuery('input[name="category_id"]').val('');
								jQuery('input[name="category_id"]').attr('disabled', true);
							}
							jQuery('select[name="category_id"]').attr('disabled', false);
						}
					}
                }
				SnoCalculation();
				calQuantityTotal();
			}
			else {
				window.location.reload();
			}
		}
	});
}

