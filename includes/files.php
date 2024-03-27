<?php
// Include the database configuration file
require_once '../config/config.php';
require_once ROOTDIR . 'classes/DBManager.php';
if (!isSessionValid()) {
    response(false, "Please login first");
}

// Define your files table name
$tableFiles = 'files';
$dbm = new DBManager(HOST, USERNAME, PASSWORD, DBNAME);
$dbm->connect();
// Get data for DataTable
$result = $dbm->get_result("SELECT * FROM $tableFiles where user_id = {$_SESSION['user_id']} order by id desc ");

$data = [];
foreach ($result as $row) {
    $fullpath = $row['filepath'];
    $filename = $row['filename'];
    $downloadUrl = BASE_URL . $fullpath;
    $downloadLink = "<a href='$downloadUrl' download='$filename' target='_blank'>Download</a>";
    $data[] = [
        $row['id'],
         $row['filename'],
         $downloadLink
    ];
}
$totalRecords = count($data);
$response = [
    "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords, // For simplicity, assuming no filtering is applied
    "data" => $data
];
// Return data as JSON
echo json_encode($response);
?>
