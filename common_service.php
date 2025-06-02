<?php

date_default_timezone_set('Asia/Kolkata');
$output = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $q = isset($_GET['q']) ? $_GET['q'] : null;
    if(!empty($q) && $q != null) {
        if($q == 'get') {
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
        } else if($q == "export_sql") {
            $mysqli_username = isset($_GET['mysqli_username']) ? $_GET['mysqli_username'] : null;
            $mysqli_password = isset($_GET['mysqli_password']) ? $_GET['mysqli_password'] : null;
            $mysqli_db_name = isset($_GET['mysqli_db_name']) ? $_GET['mysqli_db_name'] : null;
            $tables = isset($_GET['tables']) ? $_GET['tables'] : null;

            if (!empty($mysqli_username) && $mysqli_username != null && 
                !empty($mysqli_db_name) && $mysqli_db_name != null && 
                !empty($tables) && $tables != null) {
                
                try {
                    $dsn = "mysql:host=localhost;dbname=$mysqli_db_name;charset=utf8mb4";
                    $pdo = new PDO($dsn, $mysqli_username, $mysqli_password, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);

                    $tables = explode(',', $tables);
                    if (!empty($tables)) {
                        $filename = "db_export_" . date("Ymd_His") . ".sql";
                        $filepath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;
                        $file = fopen($filepath, 'w');

                        foreach ($tables as $table) {
                            $table = trim($table);
                            if (empty($table)) continue;

                            // Get CREATE TABLE
                            $stmt = $pdo->query("SHOW CREATE TABLE `$table`");
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            if (!$row || !isset($row['Create Table'])) continue;

                            // Write table structure
                            fwrite($file, "-- --------------------------------------------------------\n");
                            fwrite($file, "-- Table structure for table `$table`\n");
                            fwrite($file, "-- --------------------------------------------------------\n\n");
                            fwrite($file, $row['Create Table'] . ";\n\n");

                            // Fetch table data
                            $stmt = $pdo->query("SELECT * FROM `$table`");
                            if ($stmt->rowCount() > 0) {
                                fwrite($file, "-- --------------------------------------------------------\n");
                                fwrite($file, "-- Dumping data for table `$table`\n");
                                fwrite($file, "-- --------------------------------------------------------\n\n");

                                // Begin transaction
                                fwrite($file, "START TRANSACTION;\n");

                                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $columns = array_map(fn($col) => "`$col`", array_keys($data));
                                    $values = array_map(function ($val) use ($pdo) {
                                        return $val === null ? "NULL" : $pdo->quote($val);
                                    }, array_values($data));
                                    fwrite($file, "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n");
                                }

                                // End transaction
                                fwrite($file, "COMMIT;\n\n");
                            }
                        }

                        fclose($file);

                        // Send file to browser
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/sql');
                        header('Content-Disposition: attachment; filename="' . $filename . '"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($filepath));
                        readfile($filepath);
                        unlink($filepath);
                        exit;
                    } else {
                        http_response_code(400);
                        $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Tables'];
                    }
                } catch (PDOException $e) {
                    http_response_code(400);
                    $output = ['status' => 'error', 'code' => '400', 'message' => 'Database error: ' . $e->getMessage()];
                }
            } else {
                http_response_code(400);
                $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Params'];
            }
        } else if($q == "export_file") {
            $path = isset($_GET['path']) ? $_GET['path'] : null;
            if(!empty($path) && $path != null) {
                $dir_path = __DIR__ . DIRECTORY_SEPARATOR . $path;
                if (file_exists($dir_path)) {
                    $file_content = file_get_contents($dir_path);
                    if (!empty($file_content)) {
                        $filename = basename($dir_path);
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="' . $filename . '"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . strlen($file_content));
                        echo $file_content;
                        exit;
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
        } else if ($q == "export_folder") {
            $dir = isset($_GET['dir']) ? $_GET['dir'] : null;

            if (!empty($dir)) {
                $dir_path = realpath(__DIR__ . DIRECTORY_SEPARATOR . $dir);

                if ($dir_path && is_dir($dir_path)) {
                    $zip_filename = basename($dir_path) . '_' . date('Ymd_His') . '.zip';
                    $zip_filepath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $zip_filename;

                    // Escape paths
                    $escaped_dir_path = escapeshellarg($dir_path);
                    $escaped_zip_filepath = escapeshellarg($zip_filepath);

                    // Create the zip using shell command
                    $cmd = "cd $escaped_dir_path && zip -r $escaped_zip_filepath .";
                    $output = shell_exec($cmd);

                    if (file_exists($zip_filepath)) {
                        // Output ZIP for download
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/zip');
                        header('Content-Disposition: attachment; filename="' . $zip_filename . '"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($zip_filepath));
                        readfile($zip_filepath);
                        unlink($zip_filepath);
                        exit;
                    } else {
                        http_response_code(500);
                        $output = ['status' => 'error', 'code' => 500, 'message' => 'Failed to create ZIP archive (shell)'];
                    }
                } else {
                    http_response_code(400);
                    $output = ['status' => 'error', 'code' => 400, 'message' => 'Folder does not exist'];
                }
            } else {
                http_response_code(400);
                $output = ['status' => 'error', 'code' => 400, 'message' => 'Invalid Payload Received'];
            }
        } else {
            http_response_code(400);
            $output = ['status' => 'error', 'code' => '400', 'message' => 'Only get, export_sql, export_file, export_folder are allowed'];
        }
    } else {
        http_response_code(400);
        $output = ['status' => 'error', 'code' => '400', 'message' => 'Invalid Request'];
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