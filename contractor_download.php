<?php
    include("include.php");
?>
<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>

<table id="tbl_contractor_list" class="data-table table nowrap tablefont" style="margin:auto; display:none;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: center; width: 50px;">S.No</th>
            <th style="text-align: center; width: 500px;">Contractor Name</th>
            <th style="text-align: center; width: 500px;">Mobile Number</th>
            <th style="text-align: center; width: 500px;">Address</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $total_records_list = array();

            $search_text = "";
            if(isset($_REQUEST['search_text'])) {
                $search_text = $_REQUEST['search_text'];
            }

            $total_records_list = $obj->getTableRecords($GLOBALS['contractor_table'], '', '', 'DESC');

            if(!empty($search_text)) {
                $search_text = strtolower($search_text);
                $list = array();
                if(!empty($total_records_list)) {
                    foreach($total_records_list as $val) {
                        if(strpos(strtolower($obj->encode_decode('decrypt', $val['name_mobile_city'])), $search_text) !== false) {
                            $list[] = $val;
                        }
                    }
                }
                $total_records_list = $list;
            }

            $show_records_list = array();
            if(!empty($total_records_list)) {
                foreach($total_records_list as $key => $val) {
                    $show_records_list[] = $val;
                }
            }

            if(!empty($show_records_list)) {
                foreach($show_records_list as $key => $data) {
                    $index = $key + 1;
                    if(!empty($prefix)) { $index = $index + $prefix; } 
        ?>
                    <tr>
                        <td class="text-center"><?php echo $index; ?></td>
                        <td class="text-center">
                            <?php
                            if(!empty($data['contractor_name'])) {
                                $data['contractor_name'] = html_entity_decode($obj->encode_decode('decrypt',$data['contractor_name']));
                                echo $data['contractor_name'];
                            }
                            else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if(!empty($data['mobile']) && $data['mobile'] != $GLOBALS['null_value']) {
                                    $data['mobile'] = $obj->encode_decode('decrypt', $data['mobile']);
                                    echo $data['mobile'];
                                }else{
                                    echo "-";
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if(!empty($data['location']) && $data['location'] != $GLOBALS['null_value']) {
                                    $data['location'] = $obj->encode_decode('decrypt', $data['location']);
                                    echo html_entity_decode($data['location']);
                                }else{
                                    echo "-";
                                }
                            ?>
                        </td>
                    </tr>
        <?php 
                }
            }
        ?>
    </tbody>
</table>

<script>
    ExportToExcel('xlsx');
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_contractor_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('contractor_list.' + (type || 'xlsx')));
    }
    window.open("contractor.php","_self");
</script>