<?php
$host = 'localhost';
$dbname = 'gastenboek';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


    try {
        $conn = new pdo ("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
             echo "Connection failed: " . $e->getMessage();
        }


?>

