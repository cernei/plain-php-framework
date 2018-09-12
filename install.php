<?php

require_once __DIR__ . '/bootstrap.php';

$config = require_once __DIR__ . '/app/config/db.php';

$conn = new mysqli($config['host'], $config['username'], $config['password'] , $config['dbname']);
if ($conn) {
    $query = '';
    $sqlScript = file('dump.sql');
    foreach ($sqlScript as $line) {

        $startWith = substr(trim($line), 0, 2);
        $endWith = substr(trim($line), -1, 1);

        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }

        $query = $query . $line;
        if ($endWith == ';') {
            mysqli_query($conn, $query) or die('Problem in executing the SQL query ' . $query .  "\r\n");
            $query = '';
        }
    }
    echo 'SQL file imported successfully' . "\r\n";
} else {
    echo 'check db credentials in app/config/db' . "\r\n";
}
?>