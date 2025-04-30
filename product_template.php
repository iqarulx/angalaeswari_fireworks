<script type="text/javascript" src="include/js/xlsx.full.min.js"></script>
<table id="tbl_product_list" class="data-table table nowrap tablefont" style="margin: auto; width: 900px;display:none;">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: center; width: 50px;">S.No</th>
            <th style="text-align: center; width: 125px;">Group</th>
            <th style="text-align: center; width: 125px;">Product Name</th>
            <th style="text-align: center; width: 125px;">HSN Code</th>
            <th style="text-align: center; width: 125px;">Unit</th>
            <th style="text-align: center; width: 125px;">SubUnit</th>
            <th style="text-align: center; width: 125px;">Case Rate</th>                 
            <th style="text-align: center; width: 125px;">Per</th>                 
            <th style="text-align: center; width: 125px;">Per Type</th>                 
        </tr>
    </thead>
</table>
<script>
    ExportToExcel('xlsx');
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_product_list');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ('product_list.' + (type || 'xlsx')));
    }
    window.open("product.php","_self");
</script>