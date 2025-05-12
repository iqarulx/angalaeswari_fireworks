<?php

$output = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $path = isset($_GET['path']) ? $_GET['path'] : null;

    if(!empty($path) && $path != null) {
        $dir_path = __DIR__ . DIRECTORY_SEPARATOR . $path;
        if (file_exists($dir_path)) {
            $file_content = file_get_contents($dir_path);
            if (!empty($file_content)) {
                $escaped_content = htmlspecialchars($file_content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                echo '<pre><code>' . $escaped_content . '</code></pre>';
            } else {
                http_response_code(400);
                $output = [ 'status' => 'error', 'code' => '400', 'message' => 'File is empty'];
            }
        } else {
            http_response_code(400);
            $output = ['status' => 'error', 'code' => '400', 'message' => 'File does not exist'];
        }
    } else {
        http_response_code(400);
        $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Payload Received'];
    }
} else {
    http_response_code(400);
    $output = ['status' => 'error', 'code' => '400', 'message' => 'Only GET methods are allowed'];
}

if(!empty($output)) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
}