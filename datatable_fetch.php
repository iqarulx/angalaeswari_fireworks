<?php
$conn = new mysqli("localhost", "root", "", "angalaeswari_fireworks_16042025");

$request = $_GET;
$columns = ['id', 'proforma_invoice_date', 'proforma_invoice_number'];

$search_value = $request['search']['value'];
$order_column_index = $request['order'][0]['column'];
$order_column = $columns[$order_column_index];
$order_dir = $request['order'][0]['dir'];
$start = $request['start'];
$length = $request['length'];

$where = "";
if (!empty($search_value)) {
    $where = "WHERE proforma_invoice_date LIKE '%$search_value%' OR proforma_invoice_number LIKE '%$search_value%'";
}

$sql_total = "SELECT COUNT(*) AS total FROM af_proforma_invoice";
$result_total = $conn->query($sql_total)->fetch_assoc();
$totalData = $result_total['total'];

$sql = "SELECT id, proforma_invoice_date, proforma_invoice_number FROM af_proforma_invoice $where ORDER BY $order_column $order_dir LIMIT $start, $length";
$query = $conn->query($sql);

$data = [];
while ($row = $query->fetch_assoc()) {
    $data[] = [$row['id'], $row['proforma_invoice_date'], $row['proforma_invoice_number']];
}

$sql_filtered = "SELECT COUNT(*) AS total FROM af_proforma_invoice $where";
$totalFiltered = $conn->query($sql_filtered)->fetch_assoc()['total'];

$response = [
    "draw" => intval($request['draw']),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
];

echo json_encode($response);
?>
