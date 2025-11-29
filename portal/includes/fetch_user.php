<?php
require '../../includes/dbh.php';
header('Content-Type: application/json');
error_reporting(E_ERROR | E_PARSE); // hide warnings

// -----------------------------
// 1. Get parameters safely
// -----------------------------
$draw = isset($_GET['draw']) ? intval($_GET['draw']) : 0;
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$length = isset($_GET['length']) ? intval($_GET['length']) : 10;

$searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

// Optional ordering (column index & direction)
$orderColumnIndex = isset($_GET['order'][0]['column']) ? intval($_GET['order'][0]['column']) : 0;
$orderDir = isset($_GET['order'][0]['dir']) && in_array($_GET['order'][0]['dir'], ['asc','desc']) ? $_GET['order'][0]['dir'] : 'desc';

// Map column index to table column
$columns = ['id', 'labno', 'patient_name', 'investigation', 'date_receive', 'status'];
$orderColumn = $columns[$orderColumnIndex] ?? 'id';

// -----------------------------
// 2. Total records without filter
// -----------------------------
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM user_info");
$stmt->execute();
$totalRecords = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

// -----------------------------
// 3. Total records with filter
// -----------------------------
$whereSQL = "";
$params = [];
$paramTypes = "";

if($searchValue != ''){
    $whereSQL = " WHERE labno LIKE ? OR patient_name LIKE ? OR investigation LIKE ? ";
    $params = ["%$searchValue%", "%$searchValue%", "%$searchValue%"];
    $paramTypes = "sss";

    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM user_info $whereSQL");
    $stmt->bind_param($paramTypes, ...$params);
    $stmt->execute();
    $totalFiltered = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
} else {
    $totalFiltered = $totalRecords;
}

// -----------------------------
// 4. Fetch records with limit
// -----------------------------
$sql = "SELECT * FROM user_info $whereSQL ORDER BY $orderColumn $orderDir LIMIT ?, ?";
$stmt = $conn->prepare($sql);

if($whereSQL != ''){
    $paramTypes .= "ii";
    $params[] = $start;
    $params[] = $length;
    $stmt->bind_param($paramTypes, ...$params);
}else{
    $stmt->bind_param("ii", $start, $length);
}

$stmt->execute();
$data = $stmt->get_result();

// -----------------------------
// 5. Prepare data for DataTables
// -----------------------------
$records = [];
$sn = $start + 1;

while($row = $data->fetch_assoc()){
    $actions = '
    <div class="dropdown">
      <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu'.$row['id'].'" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu'.$row['id'].'">
        <li><a class="dropdown-item" href="update.php?pid='.$row['pid'].'">Edit Patient Info</a></li>
        <li><a class="dropdown-item" href="edit.php?pid='.$row['pid'].'">Enter Result</a></li>
        <li><a class="dropdown-item" href="print_result.php?pid='.$row['pid'].'">Print Result</a></li>
        <li><a class="dropdown-item" href="pdf.php?pid='.$row['pid'].'">Generate PDF</a></li>
        <li><a class="dropdown-item" href="receipt.php?pid='.$row['pid'].'">Print Receipt</a></li>
         <li><a class="dropdown-item" href="view.php?id='.$row['id'].'">Delete</a></li>
      </ul>
    </div>
    
    ';

    $records[] = [
        "sn" => $sn++,
        "labno" => $row['labno'],
        "fullname" => $row['patient_name'],
        "investigation" => $row['investigation'],
        "date" => date("d M Y", strtotime($row['date_receive'])),
        "status" => strtolower($row['printed']) === 'yes' ? '<span class="badge bg-success">Completed</span>' : '<span class="badge bg-warning">Pending</span>',
        "actions" => $actions
    ];
}


// -----------------------------
// 6. Send JSON response
// -----------------------------
echo json_encode([
    "draw" => $draw,
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalFiltered,
    "aaData" => $records
]);
