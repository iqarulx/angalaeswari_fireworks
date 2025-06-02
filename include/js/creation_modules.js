var numbers_regex = /^\d+$/;
var price_regex = /^(\d*\.)?\d+$/;
var percentage_regex = /^(?:\d{1,2}(?:\.\d{1,2})?)%?$/;
var letter_regex = /^[a-zA-Z\s ]+$/;

function KeyboardControls(obj, type, characters, color) {
    var input = jQuery(obj);
    // Use onkeydown
    if (type == "text") {
        input.on('keypress', function (event) {
            // Get the keycode of the pressed key
            var keyCode = event.keyCode || event.which;
            var inputName = $(this).attr('name');
            if (inputName == 'commission') {
                input.on("input", function (event) {
                    var inputVal = input.val();

                    if (!percentage_regex.test(inputVal)) {
                        // If invalid input, trim the input value
                        var trimmedValue = inputVal
                            .replace(/[^0-9.%]/g, '') // Remove invalid characters
                            .match(/^\d{1,2}(?:\.\d{0,2})?%?/); // Match valid portion of input

                        trimmedValue = trimmedValue ? trimmedValue[0] : ''; // Use matched value or empty string

                        $(this).val(trimmedValue);
                    }
                });
            }
            else {

                // Allow: backspace, delete, tab, escape, enter, and arrow keys
                if ([8, 46, 9, 27, 13, 37, 38, 39, 40].indexOf(keyCode) !== -1 ||
                    // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (keyCode === 65 && (event.ctrlKey || event.metaKey)) ||
                    (keyCode === 67 && (event.ctrlKey || event.metaKey)) ||
                    (keyCode === 86 && (event.ctrlKey || event.metaKey)) ||
                    (keyCode === 88 && (event.ctrlKey || event.metaKey)) ||
                    // Allow: home, end, page up, page down
                    (keyCode >= 35 && keyCode <= 40)) {
                    // Let it happen, don't do anything
                    return;
                }

                // Block numeric key codes (0-9 on main keyboard and numpad)
                if ((keyCode >= 48 && keyCode <= 57)) {
                    event.preventDefault();
                }
            }



        });
    }
    // Use onfocus
    if (type == "mobile_number") {
        input.on('keypress', function (event) {
            var keyCode = event.keyCode || event.which;

            // Allow: backspace, delete, tab, escape, enter, period, arrow keys
            if ([8, 46, 9, 27, 13, 190].indexOf(keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (keyCode === 65 && (event.ctrlKey || event.metaKey)) ||
                (keyCode === 67 && (event.ctrlKey || event.metaKey)) ||
                (keyCode === 86 && (event.ctrlKey || event.metaKey)) ||
                (keyCode === 88 && (event.ctrlKey || event.metaKey)) ||
                // Allow: arrow keys
                (keyCode >= 37 && keyCode <= 40)) {
                // Let it happen, don't do anything
                return;
            }

            // Ensure that it is a number and stop the keypress if not
            if ((keyCode < 48 || keyCode > 57)) {
                event.preventDefault();
            }
        });

        input.on("input", function (event) {
            var str_len = input.val().length;
            if (str_len > 10) {
                input.val(input.val().substring(0, 10));
            }
        });
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
    }
    // Use onfocus
    if (type == "email" || type == "password") {
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
    }
    // Use onfocus
    if (type == "number") {
        input.on('keypress', function (event) {
            var keyCode = event.keyCode || event.which;

            // Allow: backspace, delete, tab, escape, enter, period, arrow keys
            if ([8, 46, 9, 27, 13, 190].indexOf(keyCode) !== -1 ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (keyCode === 65 && (event.ctrlKey || event.metaKey)) ||
                (keyCode === 67 && (event.ctrlKey || event.metaKey)) ||
                (keyCode === 86 && (event.ctrlKey || event.metaKey)) ||
                (keyCode === 88 && (event.ctrlKey || event.metaKey)) ||
                // Allow: arrow keys
                (keyCode >= 37 && keyCode <= 40)) {
                // Let it happen, don't do anything
                return;
            }


            // Ensure that it is a number and stop the keypress if not
            if ((keyCode < 48 || keyCode > 57)) {
                event.preventDefault();
            }
        });

        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });

    }
    // Use onfocus
    if (type == "no_space") {
        input.on('keypress', function (event) {
            if (event.keyCode === 32) {
                event.preventDefault();
            }
        });
    }

    if (numbers_regex.test(characters) != false) {
        if (characters != "" && characters != 0) {
            input.on("input", function (event) {
                var str_len = input.val().length;
                if (str_len > parseFloat(characters)) {
                    input.val(input.val().substring(0, parseFloat(characters)));
                }
            });
        }
    }
    if (color == '1') {
        InputBoxColor(obj, type);
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
function InputBoxColor(obj, type) {
    if (type == 'select') {
        if (jQuery(obj).closest().find('.select2-selection--single').length > 0) {
            jQuery(obj).closest().find('.select2-selection--single').css('border', '1px solid #ced4da');
        }
        if (jQuery(obj).parent().find('.infos').length > 0) {
            jQuery(obj).parent().find('.infos').remove();
        }
        if (jQuery(obj).parent().parent().find('.infos').length > 0) {
            jQuery(obj).parent().parent().find('.infos').remove();
        }
        if (jQuery(obj).parent().parent().parent().find('.infos').length > 0) {
            jQuery(obj).parent().parent().parent().find('.infos').remove();
        }
    }
    else {
        jQuery(obj).css('border', '1px solid #ced4da');
        if (jQuery(obj).parent().find('.infos').length > 0) {
            jQuery(obj).parent().find('.infos').remove();
        }
        if (jQuery(obj).parent().parent().find('.infos').length > 0) {
            jQuery(obj).parent().parent().find('.infos').remove();
        }
        if (jQuery(obj).parent().parent().parent().find('.infos').length > 0) {
            jQuery(obj).parent().parent().parent().find('.infos').remove();
        }
    }
}

function DeleteRow(row_index, id_name) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + row_index).length > 0) {
                    jQuery('#' + id_name + row_index).remove();
                }
                // if (jQuery('#'+id_name+row_index).length == 0) {
                //     if(jQuery('.Product_Fix_field').length > 0) {
                //         jQuery('.Product_Fix_field').attr('disabled', false);
                //     }
                // }
                // if(id_name == 'product_row') {
                //     if(jQuery('.product_row').length == 0) {
                //         if(jQuery('select[name="category_id"]').length > 0) {
                //             if(jQuery('input[name="category_id"]').length > 0) {
                //                 jQuery('input[name="category_id"]').val('');
                //                 jQuery('input[name="category_id"]').attr('disabled', true);
                //             }
                //             jQuery('select[name="category_id"]').attr('disabled', false);
                //         }
                //     }
                //     // SubunitBtnDisable();
                // }
                if (id_name == "product_row") {
                    var opening_stock_count = jQuery('.product_row').length;
                    if (opening_stock_count == 0) {
                        if (jQuery('#subunit_input').length > 0) {
                            jQuery('#subunit_input').val('');
                            jQuery('#subunit_input').attr('disabled', true);
                        }
                        if (jQuery('#subunit_need').length > 0) {
                            jQuery('#subunit_need').attr('disabled', false);
                        }
                    }

                    if (jQuery('.' + id_name).length == 0) {
                        if (jQuery('#div_selected_unit').length > 0) {
                            jQuery('#div_selected_unit').css({
                                'pointer-events': 'auto',
                                'background-color': ''
                            });
                        }

                        if (jQuery('#div_selected_subunit').length > 0) {
                            jQuery('#div_selected_subunit').css({
                                'pointer-events': 'auto',
                                'background-color': ''
                            });
                        }

                        if (jQuery('#subunit_need').length > 0) {
                            jQuery('#subunit_need').css({
                                'pointer-events': 'auto',
                                'background-color': ''
                            });
                        }

                        if (jQuery('#negative_stock_button').length > 0) {
                            jQuery('#negative_stock_button').css({
                                'pointer-events': 'auto',
                                'background-color': ''
                            });
                        }

                    }

                }
                if (jQuery('.purchase_entry_table tbody').find('tr').length > 0) {

                }
                else {
                    if ($("select[name='location_type']").length > 0) {

                        var product_group = "";
                        if (jQuery('select[name="product_group"]').length > 0) {
                            product_group = jQuery('select[name="product_group"]').val();
                            product_group = jQuery.trim(product_group);
                        }

                        $("select[name='location_type']").attr("disabled", false)
                        $("select[name='product_group']").attr("disabled", false)
                        if (product_group == "1") {
                            $("select[name='selected_godown_id']").attr("disabled", false)
                        }
                        else if (product_group == "2") {
                            $("select[name='selected_magazine_id']").attr("disabled", false)
                        }
                    }
                }
                SnoCalculation();
                CalculateTotalRate();
            }
            else {
                window.location.reload();
            }
        }
    });
}

function ShowNegativeStockDetails() {
    var checkbox_button = document.getElementById('negative_stock_button').checked;
    if (checkbox_button == true) {
        if (jQuery('#negative_stock_button').length > 0) {
            jQuery('#negative_stock_button').val('1');
        }
    }
    else if (checkbox_button == false) {
        if (jQuery('#negative_stock_button').length > 0) {
            jQuery('#negative_stock_button').val('0');
        }

    }
}

function addCreationDetails(name, characters) {
    var check_login_session = 1; var all_errors_check = 1; var error = 1; var letters_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }
                var creation_name = "";
                var format = letter_regex;

                var name_variable = "";
                name_variable = name.toLowerCase();
                name_variable = name_variable.trim();
                name_variable = name_variable.replace("_", " ");

                if (jQuery('input[name="' + name + '_name"]').is(":visible")) {
                    if (jQuery('input[name="' + name + '_name"]').length > 0) {
                        creation_name = jQuery('input[name="' + name + '_name"]').val();
                        creation_name = creation_name.trim();
                        if (typeof creation_name == "undefined" || creation_name == "" || creation_name == 0 || creation_name == null) {
                            all_errors_check = 0;
                        } else if ((format.test(creation_name) == false) && name != "finished_group") {
                            letters_check = 0;
                        } else if (/"/.test(creation_name)) {
                            letters_check = 0;
                        } else if (creation_name.length > parseInt(characters)) {
                            error = 0;
                        }
                    }
                }
                if (parseInt(all_errors_check) == 1) {
                    if (parseInt(letters_check) == 1) {
                        if (parseInt(error) == 1) {
                            var add = 1;
                            if (creation_name != "") {
                                if (jQuery('input[name="' + name + '_names[]"]').length > 0) {
                                    jQuery('.added_' + name + '_table tbody').find('tr').each(function () {
                                        var prev_creation_name = jQuery(this).find('input[name="' + name + '_names[]"]').val().toLowerCase();
                                        var current_creation_name = creation_name.toLowerCase();
                                        if (prev_creation_name == current_creation_name) {
                                            add = 0;
                                        }
                                    });
                                }
                            }
                            if (add == 1) {
                                var count = jQuery('input[name="' + name + '_count"]').val();
                                count = parseInt(count) + 1;
                                jQuery('input[name="' + name + '_count"]').val(count);
                                var post_url = name + "_changes.php?" + name + "_row_index=" + count + "&selected_" + name + "_name=" + creation_name;
                                jQuery.ajax({
                                    url: post_url, success: function (result) {
                                        if (jQuery('.added_' + name + '_table tbody').find('tr').length > 0) {
                                            jQuery('.added_' + name + '_table tbody').find('tr:first').before(result);
                                        }
                                        else {
                                            jQuery('.added_' + name + '_table tbody').append(result);
                                        }
                                        if (jQuery('input[name="' + name + '_name"]').length > 0) {
                                            jQuery('input[name="' + name + '_name"]').val('').focus();
                                        }
                                        SnoCalculation();
                                    }
                                });
                            }
                            else {
                                jQuery('.added_' + name + '_table').before('<div class="infos w-100 text-danger text-center mb-3" style="font-size: 15px;">This ' + name_variable + ' already Exists</div>');
                            }
                        }
                        else {
                            jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Only ' + characters + ' Characters allowed</div>');
                        }
                    }
                    else {
                        jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;color:red;">Invalid Characters</div>');
                        jQuery('input[name="' + name + '_name"]').val('');
                    }
                }
                else {
                    jQuery('.added_' + name + '_table').before('<div class="infos text-danger text-center mb-3" style="font-size: 15px;">Please check all field values</div>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function DeleteCreationRow(id_name, row_index) {
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('#' + id_name + '_row' + row_index).length > 0) {
                    jQuery('#' + id_name + '_row' + row_index).remove();
                }
                SnoCalculation();
            }
            else {
                window.location.reload();
            }
        }
    });
}


function AddChargesDetails() {
    var check_login_session = 1; var all_errors_check = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var selected_charges_name = ""; var charges_lower = "";
                if (jQuery('input[name="charges_name"]').is(":visible")) {
                    if (jQuery('input[name="charges_name"]').length > 0) {
                        selected_charges_name = jQuery('input[name="charges_name"]').val();
                        charges_lower = selected_charges_name.toLowerCase();
                        selected_charges_name = jQuery.trim(selected_charges_name);
                        charges_lower = jQuery.trim(charges_lower);
                        if (typeof selected_charges_name == "undefined" || selected_charges_name == "" || selected_charges_name == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_action = "";
                if (jQuery('select[name="action"]').is(":visible")) {
                    if (jQuery('select[name="action"]').length > 0) {
                        selected_action = jQuery('select[name="action"]').val();
                        selected_action = jQuery.trim(selected_action);
                        if (typeof selected_action == "undefined" || selected_action == "" || selected_action == 0) {
                            all_errors_check = 0;
                        }
                    }
                }


                if (parseFloat(all_errors_check) == 1) {
                    var add = 1;
                    if (selected_charges_name != "" && selected_action != "") {
                        if (jQuery('input[name="charges_names[]"]').length > 0) {
                            jQuery('.charges_table tbody').find('tr').each(function () {
                                var prev_charges_name = ""; var prev_charges_name_lower = "";
                                prev_charges_name = jQuery(this).find('input[name="charges_names[]"]').val();
                                prev_charges_name_lower = prev_charges_name.toLowerCase();
                                prev_charges_name_lower = prev_charges_name_lower.trim();

                                if (prev_charges_name_lower == charges_lower) {
                                    add = 0;
                                }
                            });
                        }
                    }

                    if (parseFloat(add) == 1) {
                        var charges_count = 0;
                        charges_count = jQuery('input[name="charges_count"]').val();
                        charges_count = parseInt(charges_count) + 1;
                        jQuery('input[name="charges_count"]').val(charges_count);
                        var post_url = "charges_changes.php?charges_row_index=" + charges_count + "&selected_charges_name=" + selected_charges_name + "&selected_action=" + selected_action;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.charges_table tbody').find('tr').length > 0) {
                                    jQuery('.charges_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.charges_table tbody').append(result);
                                }

                                if (selected_charges_name != "") {
                                    if (jQuery('input[name="charges_name"]').length > 0) {
                                        jQuery('input[name="charges_name"]').val('').trigger('change');
                                    }
                                }

                                if (selected_action != "") {
                                    if (jQuery('select[name="action"]').length > 0) {
                                        jQuery('select[name="action"]').val('').trigger('change');
                                    }
                                }
                                SnoCalculation();

                            }
                        });
                    }
                    else {
                        jQuery('.charges_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Charges name is Already Exists</span>');
                    }
                }
                else {
                    jQuery('.charges_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check all details</span>');
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}


function subunitNeed() {
    var checkbox_button = "";
    if (jQuery('#subunit_need').length > 0) {
        checkbox_button = document.getElementById('subunit_need').checked;
    } else {
        if (jQuery('input[name="subunit_need"]').length > 0) {
            checkbox_button = jQuery('input[name="subunit_need"]').val();
        }
    }
    if (checkbox_button == true) {
        if (jQuery('#subunit_need').length > 0) {
            jQuery('#subunit_need').val('1');
        }
        if (jQuery('#subunit_need_fields_div').length > 0) {
            jQuery('#subunit_need_fields_div').removeClass('d-none');
        }
        if (jQuery('#subunit_need_fields_th').length > 0) {
            jQuery('#subunit_need_fields_th').removeClass('d-none');
        }
        if (jQuery('#subunit_need_fields').length > 0) {
            jQuery('#subunit_need_fields').removeClass('d-none');
        }
        if (jQuery('select[name="per_type"]').find('option[value="2"]').length === 0) {
            jQuery('select[name="per_type"]').append($("<option value='2'>Subunit</option>"));
        }
        if (jQuery('select[name="selected_unit_type"]').find('option[value="2"]').length === 0) {
            jQuery('select[name="selected_unit_type"]').append($("<option value='2'>Subunit</option>"));
        }

    }
    else if (checkbox_button == false) {
        if (jQuery('#subunit_need').length > 0) {
            jQuery('#subunit_need').val('0');
        }
        if (jQuery('#subunit_need_fields_div').length > 0) {
            jQuery('#subunit_need_fields_div').addClass('d-none');
        }
        if (jQuery('#subunit_need_fields_th').length > 0) {
            jQuery('#subunit_need_fields_th').addClass('d-none');
        }
        if (jQuery('#subunit_need_fields').length > 0) {
            jQuery('#subunit_need_fields').addClass('d-none');
        }
        if (jQuery('select[name="selected_unit_type"]').length > 0) {
            jQuery('select[name="selected_unit_type"] option[value="2"]').remove();
        }
    }
}


function per_type_change() {
    var subunit_need = jQuery('#subunit_need').val();
    var option = '';
    if (subunit_need == '1') {
        option = "<option value='2' selected>Sub Unit</option>";
    } else {
        option = "<option value='1' selected>Unit</option>";
    }
    $("select[name='per_type']").empty().append(option);
}

function ChangeLocation() {
    var group = jQuery('select[name="group"]').val();
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "product_changes.php?group_change_get_location=" + group;
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            result = result.split("$$$");
                            if ($("select[name='location']").length > 0) {
                                $("select[name='location']").empty().append(result[0]);
                            }
                            if ($("input[name='godown_magazine']").length > 0) {
                                $("input[name='godown_magazine']").val(result[1]);
                            }
                        }
                    }
                });
            }
        }
    });

    if (group === "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
        if (jQuery('.finished_group_div').length > 0) {
            jQuery('.finished_group_div').removeClass('d-none');
        }
        if (jQuery('.raw_material_group_div').length > 0) {
            jQuery('.raw_material_group_div').addClass('d-none');
        }
        if (jQuery('.semi_finished_group_div').length > 0) {
            jQuery('.semi_finished_group_div').addClass('d-none');
        }
    } else if (group === "4d5449774e4449774d6a55784d44557a4d444a664d444d3d") {
        if (jQuery('.raw_material_group_div').length > 0) {
            jQuery('.raw_material_group_div').removeClass('d-none');
        }
        if (jQuery('.semi_finished_group_div').length > 0) {
            jQuery('.semi_finished_group_div').addClass('d-none');
        }
        if (jQuery('.finished_group_div').length > 0) {
            jQuery('.finished_group_div').addClass('d-none');
        }
    } else if (group === "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
        if (jQuery('.semi_finished_group_div').length > 0) {
            jQuery('.semi_finished_group_div').removeClass('d-none');
        }
        if (jQuery('.raw_material_group_div').length > 0) {
            jQuery('.raw_material_group_div').addClass('d-none');
        }
        if (jQuery('.finished_group_div').length > 0) {
            jQuery('.finished_group_div').addClass('d-none');
        }
    } else {
        if (jQuery('.raw_material_group_div').length > 0) {
            jQuery('.raw_material_group_div').addClass('d-none');
        }
        if (jQuery('.semi_finished_group_div').length > 0) {
            jQuery('.semi_finished_group_div').addClass('d-none');
        }
        if (jQuery('.finished_group_div').length > 0) {
            jQuery('.finished_group_div').addClass('d-none');
        }
    }

}

function FindTotalQty() {
    var content = 1;
    // var quantity = jQuery('input[name="selected_quantity"]').val() || 0;
    // var content = jQuery('input[name="selected_content"]').val() || 1;
    var total_quantity = jQuery('input[name="selected_total_qty"]').val() || 0;
    var unit_type = jQuery('select[name="selected_unit_type"]').val();
    var all_errors_check = 1; var errors_check = 1;

    if (jQuery('input[name="selected_quantity"]').length > 0) {
        quantity = jQuery('input[name="selected_quantity"]').val();
        quantity = jQuery.trim(quantity);
        if ((typeof quantity == "undefined")) {
            all_errors_check = 0;
        }
        // else if (price_regex.test(quantity) == false) {
        //     all_errors_check = 0;
        // }
        else if (parseFloat(quantity) > 99999) {
            all_errors_check = 0;
        }
    }

    if (jQuery('input[name="selected_content"]').length > 0) {
        content = jQuery('input[name="selected_content"]').val();
        content = jQuery.trim(content);
        if ((typeof content == "undefined" || content == "" || content == 0)) {
            errors_check = 0;
        }
        else if (numbers_regex.test(content) == false) {
            errors_check = 0;
        }
        else if (parseFloat(content) > 99999) {
            errors_check = 0;
        }
    }
    if (all_errors_check == 1) {
        if (unit_type == '2') {
            if (content != "" && errors_check == 1) {
                content = quantity;
            } else {
                jQuery('input[name="selected_content"]').val('');
            }

            total_quantity = (quantity);

        } else {
            if (all_errors_check == 1) {
                if (content != "") {
                    total_quantity = (content) * (quantity);
                } else {
                    total_quantity = quantity;
                }
            } else {
                jQuery('input[name="selected_quantity"]').val('');
                jQuery('input[name="selected_total_qty"]').val('');
                jQuery('input[name="selected_content"]').val('');

            }
        }

        jQuery('input[name="selected_quantity"]').val(quantity);
        jQuery('input[name="selected_total_qty"]').val(total_quantity);
    } else {

        jQuery('input[name="selected_quantity"]').val('');
        jQuery('input[name="selected_total_qty"]').val('');
    }


}

function AddProductStock() {
    var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
                }

                var location = ""; var godown_magazine = "";
                if (jQuery('select[name="location"]').is(":visible")) {
                    if (jQuery('select[name="location"]').length > 0) {
                        location = jQuery('select[name="location"]').val();
                        location = jQuery.trim(location);
                        if (typeof location == "undefined" || location == "" || location == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                if (jQuery('input[name="godown_magazine"]').length > 0) {
                    godown_magazine = jQuery('input[name="godown_magazine"]').val();
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

                var group = "";
                if (jQuery('select[name="group"]').is(":visible")) {
                    if (jQuery('select[name="group"]').length > 0) {
                        group = jQuery('select[name="group"]').val();
                        group = jQuery.trim(group);
                        if (typeof group == "undefined" || group == "" || group == 0) {
                            jQuery('select[name="group"]').parent().after('<span class="infos">Select the Group</span>');
                            unit_sub_error = 0;
                        }
                    }
                }

                var unit_id = "";
                if (jQuery('select[name="unit_id"]').is(":visible")) {
                    if (jQuery('select[name="unit_id"]').length > 0) {
                        unit_id = jQuery('select[name="unit_id"]').val();
                        unit_id = jQuery.trim(unit_id);
                        if (typeof unit_id == "undefined" || unit_id == "" || unit_id == 0) {
                            jQuery('select[name="unit_id"]').parent().after('<span class="infos">Select the Unit</span>');
                            unit_sub_error = 0;
                        }
                    }
                }
                var subunit_id = "";
                if (jQuery('select[name="subunit_id"]').is(":visible")) {
                    if (jQuery('select[name="subunit_id"]').length > 0) {
                        subunit_id = jQuery('select[name="subunit_id"]').val();
                        subunit_id = jQuery.trim(subunit_id);
                        if (typeof subunit_id == "undefined" || subunit_id == "" || subunit_id == 0) {
                            jQuery('select[name="subunit_id"]').parent().after('<span class="infos">Select the sub Unit</span>');
                            unit_sub_error = 0;
                        }
                    }
                }

                if (unit_sub_error == 1 && unit_id == subunit_id) {
                    jQuery('select[name="subunit_id"]').parent().after('<span class="infos">Unit and Subunit must be different</span>');
                    unit_sub_error = 0;
                }

                var selected_stock_date = "";
                if (jQuery('input[name="selected_stock_date"]').is(":visible")) {
                    if (jQuery('input[name="selected_stock_date"]').length > 0) {
                        selected_stock_date = jQuery('input[name="selected_stock_date"]').val();
                        selected_stock_date = jQuery.trim(selected_stock_date);
                        if (typeof selected_stock_date == "undefined" || selected_stock_date == "" || selected_stock_date == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_content = "";
                if (jQuery('input[name="selected_content"]').is(":visible")) {

                    if (jQuery('input[name="selected_content"]').length > 0) {
                        selected_content = jQuery('input[name="selected_content"]').val();
                        selected_content = jQuery.trim(selected_content);
                        if ((typeof selected_content == "undefined" || selected_content == "" || selected_content == 0)) {
                            all_errors_check = 0;
                        }
                        else if (numbers_regex.test(selected_content) == false) {
                            all_errors_check = 0;
                        }
                        else if (parseFloat(selected_content) > 99999) {
                            all_errors_check = 0;
                        }
                    }
                }

                var selected_quantity = "";
                if (jQuery('input[name="selected_quantity"]').length > 0) {
                    selected_quantity = jQuery('input[name="selected_quantity"]').val();
                    selected_quantity = jQuery.trim(selected_quantity);
                    if (typeof selected_quantity == "undefined" || selected_quantity == "") {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(selected_quantity) == false) {
                        all_errors_check = 0;
                    }
                    else if (parseFloat(selected_quantity) > 99999) {
                        all_errors_check = 0;
                    }
                }

                var subunit_need = "";
                if (jQuery('#subunit_need').length > 0) {
                    subunit_need = jQuery('#subunit_need').val();
                } else {
                    if (jQuery('#subunit_input').length > 0) {
                        subunit_need = jQuery('#subunit_input').val();
                    }
                }

                if (parseFloat(all_errors_check) == 1 && parseFloat(unit_sub_error) == 1) {
                    var add = 1;
                    if (location != "" && selected_stock_date != "") {
                        if (jQuery('input[name="location_id[]"]').length > 0) {
                            if (jQuery('input[name="stock_date[]"]').length > 0) {
                                jQuery('.product_stock_table tbody').find('tr').each(function () {
                                    var prev_location_id = ""; var prev_stock_date = "";
                                    prev_location_id = jQuery(this).find('input[name="location_id[]"]').val();
                                    prev_content = jQuery('input[name="content[]"]').val();
                                    prev_unit_type = jQuery('input[name="unit_type[]"]').val();

                                    if (jQuery('input[name="selected_content"]').is(":visible")) {
                                        if (prev_location_id == location && prev_content == selected_content && prev_unit_type == selected_unit_type) {
                                            add = 0;
                                        }
                                    } else {
                                        if (prev_location_id == location && prev_unit_type == selected_unit_type) {
                                            add = 0;
                                        }
                                    }
                                });
                            }
                        }
                    }
                    if (parseFloat(add) == 1) {
                        location_count = jQuery('.product_row').length + 1;
                        jQuery('input[name="location_count"]').val(location_count);
                        var post_url = "product_changes.php?product_row_index=" + location_count + "&location=" + location + "&selected_unit_type=" + selected_unit_type + "&selected_stock_date=" + selected_stock_date + "&selected_quantity=" + selected_quantity + "&selected_content=" + selected_content + "&godown_magazine=" + godown_magazine + "&subunit_need=" + subunit_need + "&unit_id=" + unit_id + "&subunit_id=" + subunit_id;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.product_stock_table tbody').find('tr').length > 0) {
                                    jQuery('.product_stock_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.product_stock_table tbody').append(result);
                                }

                                if (location != "") {
                                    if (jQuery('select[name="location"]').length > 0) {
                                        jQuery('select[name="location"]').val('').trigger('change');
                                    }
                                }
                                if (jQuery('select[name="selected_unit_type"]').length > 0) {
                                    jQuery('select[name="selected_unit_type"]').val('1').trigger('change');
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('input[name="selected_content"]').length > 0) {
                                    jQuery('input[name="selected_content"]').val('');
                                }
                                if (jQuery('input[name="selected_total_qty"]').length > 0) {
                                    jQuery('input[name="selected_total_qty"]').val('');
                                }
                                // if(jQuery('input[name="group"]').length > 0) {
                                //     jQuery('input[name="group"]').val('');
                                // }
                                SubunitBtnDisable();
                                SnoCalculation();
                                // DisableProduct_Fix_field();
                            }
                        });
                    }
                    else {
                        if (jQuery('input[name="selected_content"]').is(":visible")) {
                            jQuery('.product_stock_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Location , Unit Type & Content Already Exists</span>');
                        } else {
                            jQuery('.product_stock_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Location & Unit Type Already Exists</span>');
                        }

                    }
                }
                else {
                    if (all_errors_check == 0) {
                        jQuery('.product_stock_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Location & Qty Details</span>');
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}
function SubunitBtnDisable() {
    // var show_btn = 0;
    // if(jQuery('.product_row').length > 0) {
    // 	jQuery('.product_row').each(function () {
    // 		if(jQuery(this).find('input[name="unit_type[]"]').length > 0) {
    // 			var unit_type = "";
    // 			unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
    // 			if(unit_type == '2') {
    // 				show_btn = 1;
    // 			}
    // 		}
    // 	});
    // }
    // alert(show_btn)
    var subunit_need = "";
    // if(show_btn == '1') {
    if (jQuery('#subunit_need').length > 0) {
        subunit_need = jQuery('#subunit_need').val();
        if (jQuery('#subunit_input').length > 0) {
            jQuery('#subunit_input').val(subunit_need);
            jQuery('#subunit_input').attr('disabled', false);
        }
        jQuery('#subunit_need').attr('disabled', true);
    }
    // }
    // else {
    // 	if(jQuery('#subunit_need').length > 0) {
    // 		if(jQuery('#subunit_input').length > 0) {
    // 			jQuery('#subunit_input').attr('disabled', true);
    // 			jQuery('#subunit_input').val('');
    // 		}
    // 		jQuery('#subunit_need').attr('disabled', false);
    // 	}
    // }
}

function CalProductAmount() {
    if (jQuery('span.infos').length > 0) {
        jQuery('span.infos').remove();
    }
    var contains_check = 1; var contains_error = 1;
    var subunit_contains = ""; var per_check = 1; var per_error = 1; var per_type_check = 1; var per_type_error = 1; var subunitNeed = 0;
    var selected_amount = 0; var selected_subunit_amount = 0;
    if (jQuery('input[name="subunit_contains"]').length > 0) {
        subunit_contains = jQuery('input[name="subunit_contains"]').val();
        subunit_contains = jQuery.trim(subunit_contains);
        if (typeof subunit_contains == "undefined" || subunit_contains == "" || subunit_contains == 0) {
            contains_check = 0;
        }
        else if (price_regex.test(subunit_contains) == false) {
            contains_error = 0;
        }
        else if (parseFloat(subunit_contains) > 99999) {
            contains_error = 0;
        }
    }
    var selected_rate = "";
    if (jQuery('input[name="sales_rate"]').length > 0) {
        selected_rate = jQuery('input[name="sales_rate"]').val();
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
    var selected_per = "";
    if (jQuery('input[name="per"]').length > 0) {
        selected_per = jQuery('input[name="per"]').val();
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
    var selected_per_type = "";
    if (jQuery('select[name="per_type"]').length > 0) {
        selected_per_type = jQuery('select[name="per_type"]').val();
        selected_per_type = jQuery.trim(selected_per_type);
        if (typeof selected_per_type == "undefined" || selected_per_type == "" || selected_per_type == 0) {
            per_type_check = 0;
        }
        else if (price_regex.test(selected_per_type) == false) {
            per_type_error = 0;
        }
        else if (parseFloat(selected_per_type) > 99999) {
            per_type_error = 0;
        }
    }

    if (jQuery('#subunit_need').length > 0) {
        subunitNeed = jQuery('#subunit_need').val();
    }
    if (subunitNeed == 1) {

        if (parseFloat(per_check) == 1 && parseFloat(per_error) == 1 && parseFloat(per_type_check) == 1 && parseFloat(per_type_error) == 1 && parseFloat(contains_check) == 1 && parseFloat(contains_error) == 1) {
            rate_per_unit = parseFloat(selected_rate) / parseFloat(selected_per);

            if (selected_per_type == '1') {
                selected_amount = rate_per_unit;
                selected_subunit_amount = parseFloat(rate_per_unit) / parseFloat(subunit_contains);
            }
            else if (selected_per_type == '2') {
                selected_subunit_amount = rate_per_unit;
                selected_amount = parseFloat(rate_per_unit) * parseFloat(subunit_contains);
            }

            if (selected_amount != "" && selected_amount != 0 && typeof selected_amount != "undefined") {
                if (jQuery('#rate_per_unit').length > 0) {
                    selected_amount = selected_amount.toFixed(2);
                    jQuery('#rate_per_unit').html("Rate / unit : " + selected_amount);
                }
                if (jQuery('#rate_per_subunit').length > 0) {
                    selected_subunit_amount = selected_subunit_amount.toFixed(2);
                    jQuery('#rate_per_subunit').html("Rate / Subunit : " + selected_subunit_amount);
                }
                if (jQuery('input[name="rate_per_case"]').length > 0) {
                    jQuery('input[name="rate_per_case"]').val(selected_amount);
                }
                if (jQuery('input[name="rate_per_piece"]').length > 0) {
                    jQuery('input[name="rate_per_piece"]').val(selected_subunit_amount);
                }

            }
            else {
                if (jQuery('#rate_per_unit').length > 0) {
                    jQuery('#rate_per_unit').html('');
                }
                if (jQuery('#rate_per_subunit').length > 0) {
                    jQuery('#rate_per_subunit').html('');
                }
                if (jQuery('input[name="rate_per_case"]').length > 0) {
                    jQuery('input[name="rate_per_case"]').val('');
                }
                if (jQuery('input[name="rate_per_piece"]').length > 0) {
                    jQuery('input[name="rate_per_piece"]').val('');
                }
            }

        }
        else {
            if (jQuery('#rate_per_unit').length > 0) {
                jQuery('#rate_per_unit').html('');
            }
            if (jQuery('#rate_per_subunit').length > 0) {
                jQuery('#rate_per_subunit').html('');
            }
            if (jQuery('input[name="rate_per_case"]').length > 0) {
                jQuery('input[name="rate_per_case"]').val('');
            }
            if (jQuery('input[name="rate_per_piece"]').length > 0) {
                jQuery('input[name="rate_per_piece"]').val('');
            }
        }

    } else {
        if (parseFloat(per_check) == 1 && parseFloat(per_error) == 1 && parseFloat(per_type_check) == 1 && parseFloat(per_type_error) == 1) {
            rate_per_unit = parseFloat(selected_rate) / parseFloat(selected_per);


            if (selected_per_type == '1') {
                selected_amount = rate_per_unit;
            }
            else if (selected_per_type == '2') {
                selected_amount = parseFloat(subunit_contains) * parseFloat(rate_per_unit);
            }
            if (selected_amount != "" && selected_amount != 0 && typeof selected_amount != "undefined" && selected_amount) {
                if (jQuery('#rate_per_unit').length > 0) {
                    selected_amount = selected_amount.toFixed(2);
                    jQuery('#rate_per_unit').html("Rate / unit : " + selected_amount);
                }
                if (jQuery('input[name="rate_per_case"]').length > 0) {
                    jQuery('input[name="rate_per_case"]').val(selected_amount);
                }
                if (jQuery('input[name="rate_per_piece"]').length > 0) {
                    jQuery('input[name="rate_per_piece"]').val('');
                }
            }
            else {
                if (jQuery('#rate_per_unit').length > 0) {
                    jQuery('#rate_per_unit').html('');
                }
                if (jQuery('#rate_per_subunit').length > 0) {
                    jQuery('#rate_per_subunit').html('');
                }
                if (jQuery('input[name="rate_per_case"]').length > 0) {
                    jQuery('input[name="rate_per_case"]').val('');
                }
                if (jQuery('input[name="rate_per_piece"]').length > 0) {
                    jQuery('input[name="rate_per_piece"]').val('');
                }
            }
        }
        else {
            if (jQuery('#rate_per_unit').length > 0) {
                jQuery('#rate_per_unit').html('');
            }
            if (jQuery('#rate_per_subunit').length > 0) {
                jQuery('#rate_per_subunit').html('');
            }
            if (jQuery('input[name="rate_per_case"]').length > 0) {
                jQuery('input[name="rate_per_case"]').val('');
            }
            if (jQuery('input[name="rate_per_piece"]').length > 0) {
                jQuery('input[name="rate_per_piece"]').val('');
            }
        }
    }
}

function DisableProduct_Fix_field() {
    if (jQuery('.Product_Fix_field').length > 0) {
        jQuery('.Product_Fix_field').attr('disabled', true);
    }
}


function AddContractorProducts() {
    var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
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
                var selected_rate = "";
                if (jQuery('input[name="selected_rate"]').length > 0) {
                    selected_rate = jQuery('input[name="selected_rate"]').val();
                    selected_rate = jQuery.trim(selected_rate);
                    if (typeof selected_rate == "undefined" || selected_rate == "" || selected_rate == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(selected_rate) == false) {
                        all_errors_check = 0;
                    }
                    else if (parseFloat(selected_rate) > 99999) {
                        all_errors_check = 0;
                    }
                }
                if (parseFloat(all_errors_check) == 1 && parseFloat(unit_sub_error) == 1) {
                    var add = 1;
                    if (product != "" && selected_unit_type != "") {
                        if (jQuery('input[name="product_id[]"]').length > 0) {
                            if (jQuery('input[name="unit_type[]"]').length > 0) {
                                jQuery('.product_constractor_table tbody').find('tr').each(function () {
                                    var prev_product_id = ""; var prev_unit_type = "";
                                    prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                    prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                                    if (prev_product_id == product && prev_unit_type == selected_unit_type) {
                                        add = 0;
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
                        var post_url = "action_changes.php?product_row_index=" + product_count + "&product=" + product + "&selected_unit_type=" + selected_unit_type + "&selected_quantity=" + selected_quantity + "&selected_rate=" + selected_rate + "&unit_subunit=" + globalVar;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.product_constractor_table tbody').find('tr').length > 0) {
                                    jQuery('.product_constractor_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.product_constractor_table tbody').append(result);
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }
                                if (jQuery('input[name="selected_rate"]').length > 0) {
                                    jQuery('input[name="selected_rate"]').val('');
                                }
                                if (jQuery('select[name="product"]').length > 0) {
                                    jQuery('select[name="product"]').val('').trigger('change');
                                }
                                CalculateTotalRate();
                            }
                        });
                    }
                    else {
                        jQuery('.product_constractor_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product & Type Already Exists</span>');
                    }
                }
                else {
                    if (all_errors_check == 0) {
                        jQuery('.product_constractor_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product & Qty Details</span>');
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}


function AddConsumptionProducts() {
    var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1; var limit_errors_check = 1;
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
                }

                var godown = "";
                if (godown_type == '1') {
                    if (jQuery('select[name="overall_godown"]').is(":visible")) {
                        if (jQuery('select[name="overall_godown"]').length > 0) {
                            godown = jQuery('select[name="overall_godown"]').val();
                            godown = jQuery.trim(godown);
                            if (typeof godown == "undefined" || godown == "" || godown == 0) {
                                all_errors_check = 0;
                            }
                        }
                    }
                }
                else if (godown_type == '2') {
                    if (jQuery('select[name="indv_godown"]').is(":visible")) {
                        if (jQuery('select[name="indv_godown"]').length > 0) {
                            godown = jQuery('select[name="indv_godown"]').val();
                            godown = jQuery.trim(godown);
                            if (typeof godown == "undefined" || godown == "" || godown == 0) {
                                all_errors_check = 0;
                            }
                        }
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
                var selected_consumption_content = "";
                if (jQuery('select[name="selected_consumption_content"]').is(":visible")) {
                    if (jQuery('select[name="selected_consumption_content"]').length > 0) {
                        selected_consumption_content = jQuery('select[name="selected_consumption_content"]').val();
                        selected_consumption_content = jQuery.trim(selected_consumption_content);
                        if (typeof selected_consumption_content == "undefined" || selected_consumption_content == "" || selected_consumption_content == 0) {
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
                var subunit_need = 0;
                if (jQuery('input[name="subunit_need"]').length > 0) {
                    subunit_need = jQuery('input[name="subunit_need"]').val();
                }
                // if(selected_quantity > 0 && selected_quantity != "") {
                // 	var limit = $('input[name = "stock_limit"]').val();
                // 	var negative = $('input[name = "stock_negative"]').val();
                // 	if(product != "" && selected_unit_type != "" && godown != "") {
                //         if(jQuery('input[name="godown_id[]"]').length > 0) {
                // 			if(jQuery('input[name="product_id[]"]').length > 0) {
                // 				if(jQuery('input[name="unit_type[]"]').length > 0) {
                // 					jQuery('.product_consumption_table tbody').find('tr').each(function () {
                // 						var prev_unit_type = ""; var perv_quantity = "";
                // 						prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                // 						perv_quantity = jQuery(this).find('input[name="quantity[]"]').val();
                // 						var perv_subunit_contains = jQuery(this).find('input[name="consumption_content[]"]').val();
                // 						var prev_godown_id = jQuery(this).find('input[name="godown_id[]"]').val();
                // 						var prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                // 						if (prev_godown_id == godown && prev_product_id == product) {
                // 							if(prev_unit_type == 1) {
                // 								if(selected_unit_type == 1) {
                // 									var total = perv_quantity + selected_quantity;
                // 									if(parseFloat(total) > parseFloat(limit) && negative == 0) {
                // 										limit_errors_check = 0;
                // 									}
                // 								} else if (selected_unit_type == 2) {
                // 									var total = selected_quantity + parseFloat( perv_quantity/ selected_consumption_content);
                // 									if(parseFloat(total) > parseFloat(limit) && negative == 0) {
                // 										limit_errors_check = 0;
                // 									}
                // 								} 
                // 							} else if(prev_unit_type == 2) {
                // 								if(selected_unit_type == 1) {
                // 									var total = parseFloat(perv_quantity / perv_subunit_contains) + parseFloat(selected_quantity);
                // 									if(parseFloat(total) > parseFloat(limit) && negative == 0) {
                // 										limit_errors_check = 0;
                // 									}
                // 								} else if(selected_unit_type == 2) {
                // 									var total = perv_quantity + selected_quantity;
                // 									if(parseFloat(total) > parseFloat(limit) && negative == 0) {
                // 										limit_errors_check = 0;
                // 									}
                // 								}
                // 							}
                // 						}

                // 					});
                // 				}
                // 			}
                //         }
                //     }
                // 	if(parseFloat(selected_quantity) > parseFloat(limit) && negative == 0) {
                // 		limit_errors_check = 0;
                // 	}
                // }

                if (parseFloat(all_errors_check) == 1 && parseFloat(unit_sub_error) == 1) {
                    var add = 1;
                    if (product != "" && selected_unit_type != "" && godown != "") {
                        if (jQuery('input[name="godown_id[]"]').length > 0) {
                            if (jQuery('input[name="product_id[]"]').length > 0) {
                                if (jQuery('input[name="unit_type[]"]').length > 0) {
                                    jQuery('.product_consumption_table tbody').find('tr').each(function () {
                                        var prev_product_id = ""; var prev_unit_type = ""; var prev_godown_id = "";
                                        prev_godown_id = jQuery(this).find('input[name="godown_id[]"]').val();
                                        prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                        prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                                        if (prev_godown_id == godown && prev_product_id == product && prev_unit_type == selected_unit_type) {
                                            add = 0;
                                        }
                                    });
                                }
                            }
                        }
                    }
                    if (parseFloat(add) == 1) {
                        var product_count = 0;
                        product_count = jQuery('input[name="product_count"]').val();
                        product_count = parseInt(product_count) + 1;
                        jQuery('input[name="product_count"]').val(product_count);
                        var post_url = "action_changes.php?product_consumption_row_index=" + product_count + "&godown=" + godown + "&product=" + product + "&selected_unit_type=" + selected_unit_type + "&selected_quantity=" + selected_quantity + "&unit_subunit=" + globalVar + "&selected_consumption_content=" + selected_consumption_content + "&subunit_need=" + subunit_need;
                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.product_consumption_table tbody').find('tr').length > 0) {
                                    jQuery('.product_consumption_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.product_consumption_table tbody').append(result);
                                }
                                if (jQuery('input[name="selected_quantity"]').length > 0) {
                                    jQuery('input[name="selected_quantity"]').val('');
                                }

                                if (godown_type == '2') {
                                    if (jQuery('.indv_godown').length > 0) {
                                        jQuery('.indv_godown').removeClass('d-none');
                                    }
                                }
                                else {
                                    if (jQuery('.indv_godown').length > 0) {
                                        jQuery('.indv_godown').addclass('d-none');
                                    }
                                }
                                if (jQuery('select[name="godown"]').length > 0) {
                                    jQuery('select[name="godown"]').val('').trigger('change');
                                }

                                if (jQuery('select[name="product"]').length > 0) {
                                    jQuery('select[name="product"]').val('').trigger('change');
                                }
                                CalculateTotalQuantity();
                            }
                        });
                    }
                    else {
                        jQuery('.product_consumption_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product & Type Already Exists</span>');
                    }
                }
                else {
                    if (all_errors_check == 0) {
                        jQuery('.product_consumption_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Godown, Product & Qty Details</span>');
                    }
                    if (limit_errors_check == 0) {
                        jQuery('.product_consumption_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Stock Limit Exceeded</span>');
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}


function AddPurchaseProducts() {
    var check_login_session = 1; var all_errors_check = 1; var unit_sub_error = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                if (jQuery('.infos').length > 0) {
                    jQuery('.infos').each(function () { jQuery(this).remove(); });
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

                var quantity = "";
                if (jQuery('input[name="quantity"]').length > 0) {
                    quantity = jQuery('input[name="quantity"]').val();
                    quantity = jQuery.trim(quantity);
                    if (typeof quantity == "undefined" || quantity == "" || quantity == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(quantity) == false) {
                        all_errors_check = 0;
                    }
                    else if (parseFloat(quantity) > 99999) {
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
                if (jQuery('input[name="content"]').is(":visible")) {
                    if (jQuery('input[name="content"]').length > 0) {
                        content = jQuery('input[name="content"]').val();
                        content = jQuery.trim(content);
                        if (selected_unit_type == '2' && (typeof content == "undefined" || content == "" || content == 0)) {
                            all_errors_check = 0;
                        }
                        else if (selected_unit_type == '2' && numbers_regex.test(content) == false) {
                            all_errors_check = 0;
                        }
                        else if (parseFloat(content) > 99999) {
                            all_errors_check = 0;
                        }
                    }
                }

                var product_group = "";
                if (jQuery('select[name="product_group"]').length > 0) {
                    product_group = jQuery('select[name="product_group"]').val();
                    product_group = jQuery.trim(product_group);
                    if (typeof product_group == "undefined" || product_group == "" || product_group == 0) {
                        all_errors_check = 0;
                    }
                }

                var rate = "";
                if (jQuery('input[name="rate"]').length > 0) {
                    rate = jQuery('input[name="rate"]').val();
                    rate = jQuery.trim(rate);
                    if (typeof rate == "undefined" || rate == "" || rate == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(rate) == false) {
                        all_errors_check = 0;
                    }
                    else if (parseFloat(rate) > 99999) {
                        all_errors_check = 0;
                    }
                }

                var per = "";
                if (jQuery('input[name="per"]').length > 0) {
                    per = jQuery('input[name="per"]').val();
                    per = jQuery.trim(per);
                    if (typeof per == "undefined" || per == "" || per == 0) {
                        all_errors_check = 0;
                    }
                    else if (price_regex.test(per) == false) {
                        all_errors_check = 0;
                    }
                    else if (parseFloat(per) > 99999) {
                        all_errors_check = 0;
                    }
                }

                var purchase_per_type = "";
                if (jQuery('select[name="purchase_per_type"]').is(":visible")) {
                    if (jQuery('select[name="purchase_per_type"]').length > 0) {
                        purchase_per_type = jQuery('select[name="purchase_per_type"]').val();
                        purchase_per_type = jQuery.trim(purchase_per_type);
                        if (typeof purchase_per_type == "undefined" || purchase_per_type == "" || purchase_per_type == 0) {
                            all_errors_check = 0;
                        }
                    }
                }

                var amount = "";
                if (jQuery('input[name="amount"]').length > 0) {
                    amount = jQuery('input[name="amount"]').val();
                    amount = jQuery.trim(amount);
                    if (typeof amount == "undefined" || amount == "" || amount == 0) {
                        all_errors_check = 0;
                    } else if (price_regex.test(amount) == false) {
                        all_errors_check = 0;
                    } else if (parseFloat(amount) > 99999) {
                        all_errors_check = 0;
                    }
                }

                var location_id = "";
                if (jQuery("select[name='location_type']").length > 0) {
                    location_type = jQuery("select[name='location_type']").val();
                    if (location_type == "1") {
                        if (product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                            location_id = jQuery("select[name='selected_godown_id']").val();
                        } else if (product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
                            location_id = jQuery("select[name='selected_magazine_id']").val();
                        }
                    }
                    else if (location_type == "2") {
                        if (product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                            location_id = jQuery("select[name='selected_godown_id']").val();
                        } else if (product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
                            location_id = jQuery("select[name='selected_magazine_id']").val();
                        }
                    }
                }

                if (location_id == "") {
                    all_errors_check = 0;
                }

                if (parseFloat(all_errors_check) == 1 && parseFloat(unit_sub_error) == 1) {
                    var add = 1;
                    if (product != "" && selected_unit_type != "" && godown != "") {
                        if (jQuery('input[name="location_id[]"]').length > 0) {
                            if (jQuery('input[name="product_id[]"]').length > 0) {
                                if (jQuery('input[name="unit_type[]"]').length > 0) {
                                    if (jQuery('input[name="entry_content[]"]').length > 0) {
                                        jQuery('.purchase_entry_table tbody').find('tr').each(function () {
                                            var prev_product_id = ""; var prev_unit_type = ""; var prev_location_id = ""; var prev_entry_content = "";
                                            prev_product_id = jQuery(this).find('input[name="product_id[]"]').val();
                                            prev_unit_type = jQuery(this).find('input[name="unit_type[]"]').val();
                                            prev_location_id = jQuery(this).find('input[name="location_id[]"]').val();
                                            prev_entry_content = jQuery(this).find('input[name="entry_content[]"]').val();
                                            if (prev_product_id == product && prev_unit_type == selected_unit_type && prev_location_id == location_id && prev_entry_content == per) {
                                                add = 0;
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

                        var post_url = "action_changes.php?purchase_entry_row_index=" + product_count + "&product=" + product + "&unit_type=" + selected_unit_type + "&quantity=" + quantity + "&content=" + content + "&rate=" + rate + "&per=" + per + "&per_type=" + purchase_per_type + "&amount=" + amount + "&unit_subunit=" + globalVar + "&location_id=" + location_id + "&product_group=" + product_group;

                        jQuery.ajax({
                            url: post_url, success: function (result) {
                                if (jQuery('.purchase_entry_table tbody').find('tr').length > 0) {
                                    jQuery('.purchase_entry_table tbody').find('tr:first').before(result);
                                }
                                else {
                                    jQuery('.purchase_entry_table tbody').append(result);
                                }
                                var location_type = "";
                                if ($("select[name='location_type']").length > 0) {
                                    $("select[name='location_type']").attr("disabled", true)
                                    location_type = $("select[name='location_type']").val();
                                    $("select[name='product_group']").attr("disabled", true)
                                    if (location_type == "1") {
                                        if (product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                                            $("select[name='selected_godown_id']").attr("disabled", true)

                                        } else if (product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
                                            $("select[name='selected_magazine_id']").attr("disabled", true)
                                        }
                                    }
                                    else if (location_type == "2") {
                                        if (product_group == "4d5449774e4449774d6a55784d44557a4d444a664d444d3d" || product_group == "4d5449774e4449774d6a55784d4455794e4464664d44493d") {
                                            $("select[name='selected_godown_id']").attr("disabled", false)
                                        }
                                        else if (product_group == "4d5449774e4449774d6a55784d4455794d7a4e664d44453d") {
                                            $("select[name='selected_magazine_id']").attr("disabled", false)
                                        }
                                    }
                                }
                                if (jQuery('input[name="quantity"]').length > 0) {
                                    jQuery('input[name="quantity"]').val('');
                                }
                                if (jQuery('input[name="rate"]').length > 0) {
                                    jQuery('input[name="rate"]').val('');
                                }
                                if (jQuery('input[name="content"]').length > 0) {
                                    jQuery('input[name="content"]').val('');
                                }
                                if (jQuery('input[name="per"]').length > 0) {
                                    jQuery('input[name="per"]').val('');
                                }
                                if (jQuery('select[name="product"]').length > 0) {
                                    jQuery('select[name="product"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="raw_material_group"]').length > 0) {
                                    jQuery('select[name="raw_material_group"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="semi_finished_group"]').length > 0) {
                                    jQuery('select[name="semi_finished_group"]').val('').trigger('change');
                                }
                                if (jQuery('select[name="finished_group"]').length > 0) {
                                    jQuery('select[name="finished_group"]').val('').trigger('change');
                                }
                                calcPurchaseEntrySubTotal();
                                CheckCharges();
                            }
                        });

                    }
                    else {
                        if (error == "") {
                            jQuery('.purchase_entry_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">This Product & Type Already Exists</span>');
                        }
                        else {
                            jQuery('.purchase_entry_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">' + error + '</span>');
                        }
                    }
                }
                else {
                    if (all_errors_check == 0) {
                        jQuery('.purchase_entry_table').before('<span class="infos w-50 text-center mb-3" style="font-size: 15px;">Check Product & Qty Details</span>');
                    }
                }
            }
            else {
                window.location.reload();
            }
        }
    });
}

function getSalesRate() {

    if (jQuery('select[name="group"]').length > 0) {
        group = jQuery('select[name="group"]').find('option:selected').text().trim().toLowerCase();
    }

    if (group != 'finished') {
        if (jQuery('.sales_rate_div').length > 0) {
            jQuery('.sales_rate_div').addClass('d-none');
        }
        if (jQuery('.per_div').length > 0) {
            jQuery('.per_div').addClass('d-none');
        }
        if (jQuery('input[name="sales_rate"]').length > 0) {
            jQuery('input[name="sales_rate"]').val('');
        }
        if (jQuery('input[name="per"]').length > 0) {
            jQuery('input[name="per"]').val('');
        }
        if (jQuery('select[name="per_type"]').length > 0) {
            jQuery('select[name="per_type"]').val('').trigger('change');
        }

    } else {
        if (jQuery('.sales_rate_div').length > 0) {
            jQuery('.sales_rate_div').removeClass('d-none');
        }
        if (jQuery('.per_div').length > 0) {
            jQuery('.per_div').removeClass('d-none');
        }

        var subunit_need = jQuery('#subunit_need').val();
        if (typeof subunit_need != undefined && subunit_need != '') {
            if (subunit_need == 1) {
                if (jQuery('select[name="per_type"]').length > 0) {
                    jQuery('select[name="per_type"]').val('2').trigger('change');
                }
            }
        }

    }
}

//Muniaraj
function AddUnitForStock() {
    var subunit_need = "";
    var unit_id = jQuery('select[name="unit_id"]').val();
    var subunit_id = jQuery('select[name="subunit_id"]').val();
    var per_type = jQuery('select[name="per_type"]').val();
    if (jQuery('#subunit_need').length > 0) {
        subunit_need = jQuery('#subunit_need').val();
    } else {
        if (jQuery('input[name="subunit_need"]').length > 0) {
            subunit_need = jQuery('input[name="subunit_need"]').val();
        }
    }

    var listdetials = [];
    var list = {
        unit_id: unit_id,
        subunit_id: subunit_id,
        subunit_need: subunit_need,
        per_type: per_type,
    };

    listdetials.push(list);
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "product_changes.php?unit_select_change=" + JSON.stringify(listdetials);
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {

                            if ($("select[name='per_type']").length > 0) {
                                $("select[name='per_type']").empty().append(result);
                            }
                        }
                    }
                });
            }
        }
    });
}

function AddUnitForStockProductAppend() {
    var subunit_need = "";
    var unit_id = jQuery('select[name="unit_id"]').val();
    var subunit_id = jQuery('select[name="subunit_id"]').val();
    var per_type = jQuery('select[name="per_type"]').val();
    if (jQuery('#subunit_need').length > 0) {
        subunit_need = jQuery('#subunit_need').val();
    } else {
        if (jQuery('input[name="subunit_need"]').length > 0) {
            subunit_need = jQuery('input[name="subunit_need"]').val();
        }
    }

    var listdetials = [];
    var list = {
        unit_id: unit_id,
        subunit_id: subunit_id,
        subunit_need: subunit_need,
        per_type: per_type,
    };

    listdetials.push(list);
    var check_login_session = 1;
    var post_url = "dashboard_changes.php?check_login_session=1";
    jQuery.ajax({
        url: post_url, success: function (check_login_session) {
            if (check_login_session == 1) {
                post_url = "product_changes.php?unit_select_change_for_stock_append=" + JSON.stringify(listdetials);
                jQuery.ajax({
                    url: post_url, success: function (result) {
                        if (result != "") {
                            if ($("select[name='selected_unit_type']").length > 0) {
                                $("select[name='selected_unit_type']").empty().append(result);
                            }
                        }
                    }
                });
            }
        }
    });
}

function agentChange() {
    var agent_id = '';
    if (jQuery("select[name='agent_id']").length > 0) {
        agent_id = jQuery("select[name='agent_id']").val();
    }

    if (agent_id != '') {
        if (jQuery(".opening_balance_div").length > 0) {
            jQuery(".opening_balance_div").addClass('d-none');
        }
    } else {
        if (jQuery(".opening_balance_div").length > 0) {
            jQuery(".opening_balance_div").removeClass('d-none');
        }
    }
}