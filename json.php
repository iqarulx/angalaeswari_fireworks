<?php

$code = <<<'EOD'
EOD;

header('Content-Type: application/json; charset=utf-8');
echo json_encode(array('q' => 'update', 'path' => 'common_service.php', 'content' => $code));