<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Styled DataTable</title>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4 text-center">User List</h2>
  <table id="myTable" class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {
  $('#myTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "datatable_fetch.php",
    responsive: true,
    language: {
      searchPlaceholder: "Search records...",
      search: "",
    }
  });
});
</script>

</body>
</html>
