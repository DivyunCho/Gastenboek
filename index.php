<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Guestbook</title>
</head>
<body>
<header>
        <h1>Guestbook</h1>
</header>

    <div class="container">
        <?php
        include 'retrieve.php'
        ?>
        <h2>Add a Message</h2>
        <form action="submit_message.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message"></textarea><br>
            <label for="image">Upload Image:</label><br>
            <input type="file" id="FileToUpload" name="FileToUpload"  accept="image/*" capture><br>
            <input type="submit" value="Submit" class="button">
        </form>
    </div>

</body>
</html>
