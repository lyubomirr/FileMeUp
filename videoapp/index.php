<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeTube</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <main>
        <h1>MeTube - Best video player online</h1>
        <?php 
            if(!isset($_GET["videoUrl"])) {
                echo "<h2>No video url provided! :( </h2>";
                die();
            }
        ?>

        <video width="650" height="420" controls>
            <source src="<?php echo $_GET["videoUrl"] ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </main>
</body>

</html>