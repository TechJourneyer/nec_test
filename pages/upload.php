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
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <h1>Upload File</h1>
        <form id="uploadForm" method="POST" action="upload.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" class="form-control" id="file" name="file" required>
                <p class="text-danger error_messages" id="file_error" style="display:none"></p>
            </div>
            <button type="button" id="uploadFormBtn" class="btn btn-primary">Upload</button>
            <p class="text-success error_messages" id="form_success" style="display:none"></p>
        </form>

    </div>

    <!-- jQuery for form validation -->
    <script>
        $(document).ready(function () {
            $('#uploadFormBtn').click(function () {
                var file = $('#file').prop('files')[0];

                // Simple validation
                if (file) {

                    var formData = new FormData();
                    formData.append('file', file);
                    $(".error_messages").hide();
                    $.ajax({
                        url: '../includes/upload.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            response = JSON.parse(response);
                            console.log(response);
                            if (response.success) {
                                $("#file_error").hide();
                                $("#file").val("");
                                $("#form_success").show();
                                $("#form_success").text(response.message);

                            } else {
                                $("#form_error").show();
                                $("#form_error").text(response.message);
                            }
                        }
                    });
                }


            })

        });
    </script>

</body >
</html >