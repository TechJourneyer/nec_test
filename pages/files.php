<?php

require_once '../config/config.php';
if (!isSessionValid()) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <style>
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            padding: 20px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }

        /* Content */
        .content {
            margin-left: 250px;
            /* Same as sidebar width */
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include ROOTDIR . 'includes/sidebar.php'; ?>

    <!-- Content -->
    <div class="content">
        <h1>Files</h1>
        <table id="filesTable" class="table table-bordered">
        <thead>
            <tr>
            <th>ID</th>
            <th>Filename</th>
            <th>Uploaded At</th>
            </tr>
        </thead>
        </table>

    </div>

    <!-- jQuery for form validation -->
    <script>
        $(document).ready(function() {
            $('#filesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "../includes/files.php"
            });
        });
    </script>

</body >
</html >