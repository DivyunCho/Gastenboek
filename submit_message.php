<?php
include 'connect.php';

// Start or resume the session
session_start();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user has already submitted a message in this session
    if(isset($_SESSION['submitted']) && $_SESSION['submitted'] === true) {
        header("Location: index.php"); // Redirect back to the guestbook
        exit();
    }

    // Set a session variable to indicate that the user has submitted a message
    $_SESSION['submitted'] = true;
    // Set session expiration time to 1 hour
    $_SESSION['expire_time'] = time() + 3600;

    $name = $_POST['name'];
    $message = $_POST['message'];
    $date_time = date('Y-m-d H:i:s');

    // File upload
    $fileName = ''; // Initialize fileName variable
    if(isset($_FILES["FileToUpload"]["name"]) && $_FILES["FileToUpload"]["name"] != '') {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["FileToUpload"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if (!in_array($fileType, $allowTypes)) {
            echo "File type not allowed.";
            exit();
        }

        // Upload file to server
        if (!move_uploaded_file($_FILES["FileToUpload"]["tmp_name"], $targetFilePath)) {
            echo "Error uploading file.";
            exit();
        }
    }

    // Insert message and image into database
    $stmt = $pdo->prepare('INSERT INTO berichten (name, message, image, date_time) VALUES (:name, :message, :image, :date_time)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':image', $fileName); // Bind the fileName variable
    $stmt->bindParam(':date_time', $date_time);
    $stmt->execute();

    header("Location: index.php"); // Redirect back to the guestbook
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
