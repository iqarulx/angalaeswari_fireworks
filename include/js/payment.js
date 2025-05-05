function AddPaymentRow() {
	var check_login_session = 1; var all_errors_check = 1;
	var selected_error = "";
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				var selected_payment_mode_id = "";
				if (jQuery('select[name="selected_payment_mode_id"]').is(":visible")) {
					if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
						selected_payment_mode_id = jQuery('select[name="selected_payment_mode_id"]').val();
						selected_payment_mode_id = jQuery.trim(selected_payment_mode_id);
						if (typeof selected_payment_mode_id == "undefined" || selected_payment_mode_id == "" || selected_payment_mode_id == 0) {
							all_errors_check = 0;
							selected_error = $('select[name="selected_payment_mode_id"]').parent().after('<span class="infos w-50"> Select the Payment Mode </span>');
						}
					}
				}

				var selected_bank_id = "";
				if (jQuery('select[name="selected_bank_id"]').is(":visible")) {
					if (jQuery('select[name="selected_bank_id"]').length > 0) {
						selected_bank_id = jQuery('select[name="selected_bank_id"]').val();
						selected_bank_id = jQuery.trim(selected_bank_id);
						if (typeof selected_bank_id == "undefined" || selected_bank_id == "" || selected_bank_id == 0) {
							all_errors_check = 0;
							selected_error = $('select[name="selected_bank_id"]').parent().after('<span class="infos w-50"> Select the Bank </span>');
						}
					}
				}

				var selected_amount = "";
				if (jQuery('input[name="selected_amount"]').length > 0) {
					selected_amount = jQuery('input[name="selected_amount"]').val();
					selected_amount = jQuery.trim(selected_amount);
					if (typeof selected_amount == "undefined" || selected_amount == "" || selected_amount == 0) {
						all_errors_check = 0;
						selected_error = $('input[name="selected_amount"]').after('<span class="infos w-50"> Enter the Amount </span>');
					}
					else if (price_regex.test(selected_amount) == false) {
						all_errors_check = 0;
						selected_error = $('input[name="selected_amount"]').after('<span class="infos w-50"> Invalid Amount </span>');
					}
				}

				if (parseFloat(all_errors_check) == 1) {
					var add = 1;
					if (selected_payment_mode_id != "") {
						if (jQuery('input[name="payment_mode_id[]"]').length > 0) {
							if (jQuery('input[name="bank_id[]"]').length > 0) {
								jQuery('.payment_row_table tbody').find('tr').each(function () {
									var prev_payment_mode_id = "";
									prev_payment_mode_id = jQuery(this).find('input[name="payment_mode_id[]"]').val();
									prev_bank_id = jQuery(this).find('input[name="bank_id[]"]').val();
									if (prev_payment_mode_id == selected_payment_mode_id && (selected_bank_id == prev_bank_id)) {
										add = 0;
									}
								});
							}
						}
					}
					if (parseFloat(add) == 1) {
						var payment_count = 0;
						payment_count = jQuery('input[name="payment_row_count"]').val();
						payment_count = parseInt(payment_count) + 1;
						jQuery('input[name="payment_row_count"]').val(payment_count);

						var post_url = "payment_bill_changes.php?payment_row_index=" + payment_count + "&selected_payment_mode_id=" + selected_payment_mode_id + "&selected_bank_id=" + selected_bank_id + "&selected_amount=" + selected_amount;

						jQuery.ajax({
							url: post_url, success: function (result) {
								if (jQuery('.payment_row_table tbody').find('tr').length > 0) {
									jQuery('.payment_row_table tbody').find('tr:first').before(result);
								}
								else {
									jQuery('.payment_row_table tbody').append(result);
								}
								if (jQuery('select[name="selected_payment_mode_id"]').length > 0) {
									jQuery('select[name="selected_payment_mode_id"]').val('').trigger('change');
								}
								if (jQuery('select[name="selected_bank_id"]').length > 0) {
									jQuery('select[name="selected_bank_id"]').val('').trigger('change');
								}
								if (jQuery('input[name="selected_amount"]').length > 0) {
									jQuery('input[name="selected_amount"]').val('');
								}
								if (jQuery('#AccBal').length > 0) {
									jQuery('#AccBal').html('');
								}
								PaymentTotal();
								SnoCalculation();
							}
						});
					}
					else {
						jQuery('.payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Payment Mode Already Exists</span>');
					}
				}
				else {
					// jQuery('.payment_row_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check All Details</span>');
					selected_error;
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}

function addExpenseCategoryDetails() {
	var check_login_session = 1; var all_errors_check = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {

				if (jQuery('.infos').length > 0) {
					jQuery('.infos').each(function () { jQuery(this).remove(); });
				}

				// if (jQuery('.add_details_buttton').length > 0) {
				// 	jQuery('.add_details_buttton').attr('disabled', true);
				// }
				var regex = /^[a-zA-Z][a-zA-Z\s&@.,\-']+$/;

				validation_check = 1; var expense_category_name = ""; var character = 1;
				if (jQuery('input[name="expense_category_name"]').is(":visible")) {
					if (jQuery('input[name="expense_category_name"]').length > 0) {
						expense_category_name = jQuery('input[name="expense_category_name"]').val();
						expense_category_name = expense_category_name.trim();
						expense_category_name = expense_category_name.replace('&', "@@@");   //- in js before reg ex checking
						if (typeof expense_category_name != "undefined" && expense_category_name != "") {
							if (expense_category_name.length > 50) {
								character = 0;
							} else {
								if (regex.test(expense_category_name) == false) {
									// jQuery('input[name="expense_category_name"]').parent().after('<span class="infos">Invalid Expense_category</span>');
									validation_check = 0;
								} else {
									jQuery('input[name="expense_category_name"]').val(expense_category_name);
								}
							}
						} else {
							all_errors_check = 0;
						}


					}
				}
				if (all_errors_check == 1) {
					if (character == 1) {
						if (validation_check == 1) {

							var add = 1;
							if (expense_category_name != "") {
								if (jQuery('input[name="expense_category_names[]"]').length > 0) {
									jQuery('.added_expense_category_table tbody').find('tr').each(function () {
										var prev_expense_category_name = jQuery(this).find('input[name="expense_category_names[]"]').val();
										// if (prev_expense_category_name == expense_category_name) {
										// 	add = 0;
										// }
										var prev_expense_category_name = prev_expense_category_name.toLowerCase();
										var current_payment_mode_name = expense_category_name.toLowerCase();
										prev_expense_category_name = prev_expense_category_name.trim();
										current_payment_mode_name = current_payment_mode_name.trim();
										if (prev_expense_category_name == current_payment_mode_name) {
											add = 0;
										}
									});
								}
							}

							if (add == 1) {
								var expense_category_count = jQuery('input[name="expense_category_count"]').val();
								expense_category_count = parseInt(expense_category_count) + 1;
								jQuery('input[name="expense_category_count"]').val(expense_category_count);

								var post_url = "expense_category_changes.php?expense_category_row_index=" + expense_category_count + "&selected_expense_category_name=" + expense_category_name;

								jQuery.ajax({
									url: post_url, success: function (result) {

										if (jQuery('.added_expense_category_table tbody').find('tr').length > 0) {
											jQuery('.added_expense_category_table tbody').find('tr:first').before(result);
										}
										else {
											jQuery('.added_expense_category_table tbody').append(result);
										}

										if (jQuery('input[name="expense_category_name"]').length > 0) {
											jQuery('input[name="expense_category_name"]').val('');
										}
										SnoCalculation();

									}
								});
							}
							else {
								jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Expense Category Name already Exists</span>');

								if (jQuery('.add_details_buttton').length > 0) {
									jQuery('.add_details_buttton').attr('disabled', false);
								}
							}
						}
						else {
							jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Invalid Expense category</span>');
							jQuery('input[name="expense_category_name"]').val('');

							// if (jQuery('.add_details_buttton').length > 0) {
							// 	jQuery('.add_details_buttton').attr('disabled', false);
							// }
						}
					} else {
						jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Expense category Name is more than 50</span>');
					}
				} else {
					jQuery('.added_expense_category_table').before('<span class="infos w-100 text-center mb-3" style="font-size: 15px;">Please check all field values</span>');
					if (jQuery('.add_details_buttton').length > 0) {
						jQuery('.add_details_buttton').attr('disabled', false);
					}
				}
			}
			else {
				window.location.reload();
			}
		}
	});
}


function getVoucherPartyList(party_type) {
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "payment_bill_changes.php?get_party_list_voucher=" + party_type;
				jQuery.ajax({
					url: post_url, success: function (party_name) {
						if (jQuery('.party_display').length > 0) {
							jQuery('.party_display').html(party_name);
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
function HideDetails(type) {
	var type_id = ""; var lower_type = "";
	if (type != "") {
		lower_type = type.toLowerCase();
		lower_type = lower_type.trim();
	}
	if (jQuery('select[name="party_id"]').length > 0) {
		type_id = jQuery('select[name="party_id"]').val();
	}
	if (type_id != "" && type_id != null && typeof type_id != "undefined") {
		if (jQuery('.details_element').length > 0) {
			jQuery('.details_element').removeClass('d-none');
		}
	}
	else {
		if (jQuery('.details_element').length > 0) {
			jQuery('.details_element').addClass('d-none');
		}
	}
}



function ViewPartyDetails() {
	var type = "";
	if (jQuery('select[name="party_id"]').length > 0) {
		type_id = jQuery('select[name="party_id"]').val();
	}

	if (type_id != "" && type_id != null && typeof type_id != "undefined") {
		if (type_id && type_id.indexOf('agent_') !== -1) {
			type = "agent";
			type_id = type_id.replace("agent_", "");
		} else {
			type = "customer";
		}

		var post_url = "payment_bill_changes.php?details_type=" + type + "&view_party_details=" + type_id;
		jQuery.ajax({
			url: post_url, success: function (result) {
				result = result.trim();
				if (jQuery('.details_modal_button').length > 0) {
					jQuery('.details_modal_button').trigger('click');
				}
				if (jQuery('#ViewDetailsModal').length > 0) {
					if (jQuery('#ViewDetailsModal').find('.modal-title').length > 0) {
						jQuery('#ViewDetailsModal').find('.modal-title').html(type + ' Details');
					}
					if (jQuery('#ViewDetailsModal').find('.modal-body').length > 0) {
						jQuery('#ViewDetailsModal').find('.modal-body').html(result);
					}
				}
			}
		});
	}
}


function ViewPendingDetails(type) {
	var type_id = ""; var lower_type = "";
	if (type != "") {
		lower_type = type.toLowerCase();
		lower_type = lower_type.trim();
		type = type.replace("_", " ");
		// alert(type)
	}
	if (jQuery('select[name="party_id"]').length > 0) {
		type_id = jQuery('select[name="party_id"]').val();

		if (type_id && type_id.indexOf('agent_') !== -1) {
			type_id = type_id.replace("agent_", "");
		}
	}
	var post_url = "payment_bill_changes.php?party_type=" + lower_type + "&party_id=" + type_id;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			result = result.split("$$$");
			if (jQuery('.pending_modal_button').length > 0) {
				jQuery('.pending_modal_button').trigger('click');
			}
			if (jQuery('#PendingDetailsModal').length > 0) {
				if (jQuery('#PendingDetailsModal').find('.modal-title').length > 0) {
					jQuery('#PendingDetailsModal').find('.modal-title').html(result[1]);
				}
				if (jQuery('#PendingDetailsModal').find('.modal-body').length > 0) {
					jQuery('#PendingDetailsModal').find('.modal-body').html(result[0]);
				}
			}
		}
	});
}


function getBankDetails(bank_details) {
	var post_url = "payment_bill_changes.php?selected_bank_payment_mode=" + bank_details;
	jQuery.ajax({
		url: post_url, success: function (result) {
			result = result.trim();
			if (result != "") {
				if (jQuery('#bank_list').length > 0) {
					jQuery('#bank_list').removeClass('d-none');
				}
				if (jQuery('select[name="selected_bank_id"]')) {
					jQuery('select[name="selected_bank_id"]').html(result);
				}
			}
			else {
				if (jQuery('#bank_list').length > 0) {
					jQuery('#bank_list').addClass('d-none');
				}
			}
			if (jQuery('input[name="mode_of_payment_amount"]')) {
				jQuery('input[name="mode_of_payment_amount"]').focus();
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


function PaymentTotal() {
	var total_amount = 0;
	if (jQuery('.payment_row').length > 0) {
		jQuery('.payment_row').each(function () {
			var amount = 0;
			if (jQuery(this).find('input[name="amount[]"]').length > 0) {
				amount = jQuery(this).find('input[name="amount[]"]').val();
				amount = amount.trim();
			}
			if (amount != "" && amount != 0 && typeof amount != "undefined" && amount != null && price_regex.test(amount) !== false) {
				total_amount = parseFloat(amount) + parseFloat(total_amount);
				total_amount = total_amount.toFixed(2);
			}
		});
	}
	if (jQuery('.overall_total').length > 0) {
		jQuery('.overall_total').html('Rs.' + total_amount);
	}
}


function getVoucherFilterPartyList(party_type) {
	if (jQuery('select[name="filter_party_id"]')) {
		jQuery('select[name="filter_party_id"]').val('');
	}
	var check_login_session = 1;
	var post_url = "dashboard_changes.php?check_login_session=1";
	jQuery.ajax({
		url: post_url, success: function (check_login_session) {
			if (check_login_session == 1) {
				var post_url = "payment_bill_changes.php?get_filter_party_list_voucher=" + party_type;
				jQuery.ajax({
					url: post_url, success: function (party_name) {
						if (jQuery('.party_display').length > 0) {
							jQuery('.party_display').html(party_name);
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