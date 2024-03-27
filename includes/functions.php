<?php 

// Api Response
function response($success, $message, $data = []) {
    echo json_encode(
        [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]
    );
    exit;
}

function isSessionValid() {
    if (!isset($_SESSION['username'])) {
        return false;
    }
    return  true;
}