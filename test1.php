<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ticketbooth");

// Get all images
$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        img {
            width: 200px;
            cursor: pointer;
            margin: 10px;
        }
        #result {
            margin-top: 20px;
            padding: 10px;
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <img src="<?php echo $row['Movie_Poster']; ?>" 
             onclick="showId(<?php echo $row['Movie_ID']; ?>)" 
             alt="<?php echo $row['Movie_Name']; ?>">
    <?php } ?>

    <div id="result"></div>

    <script>
        function showId(id) {
            document.getElementById('result').innerHTML = 'Image ID: ' + id;
        }
    </script>
</body>
</html>