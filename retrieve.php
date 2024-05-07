<?php
include 'connect.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT name, message, image, date_time FROM berichten ORDER BY date_time DESC');
    $stmt->execute();

    $htmlString = ""; // Initialize an empty string to store the HTML

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $htmlString .= "<div class='message'>";
            $htmlString .= "<p><strong>Name:</strong> " . $row['name'] . "</p>";
            $htmlString .= "<p><strong>Message:</strong> " . $row['message'] . "</p>";
            $htmlString .= '<img src="uploads/' . $row['image'] . '" style="width: 50%; margin-bottom: 3%;">';

            $htmlString .= "<p><strong>Date:</strong> " . $row['date_time'] . "</p>";
            $htmlString .= "</div>";
        }
    } else {
        $htmlString = "<p>No messages yet.</p>";
    }

    echo $htmlString; // Output the HTML string
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
