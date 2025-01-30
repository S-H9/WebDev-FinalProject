<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "ticketbooth";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    $sql = "INSERT INTO reviews (name, email, review) VALUES ('$name', '$email', '$review')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['review_submitted'] = true;
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowPick</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .floating-image {
            animation: float 3s ease-in-out infinite;
        }

        .image-container {
            display: inline-block;
            margin: 10px;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        #IMDB {
            width: 50px;
  height: 50px;
  background-color: red;
  position: relative;
  animation-name: example;
  animation-duration: 4s;
  animation-iteration-count: infinite;
        }
        @keyframes example {
  0%   {background-color:red; left:0px; top:0px;}
  25%  {background-color:yellow; left:200px; top:0px;}
  50%  {background-color:blue; left:0px; top:0px;}
 
}
    </style>
</head>
<body>
    <header>
        <h1>Welcome to ShowPick</h1>
        <nav>
           <img src="ShowPick icon.png" alt="0"></a>
           <a href="https://www.imdb.com/" class="cta-button" target="_blank" id="IMDB"
             style="margin-left: auto; text-decoration: none; font-weight: normal; color: white; background-color: blue; ">IMDB</a>
           <a href="contact.php" class="cta-button" style="margin-left: auto; text-decoration: none; font-weight: normal;">Contact Us</a>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1></h1>
            <p></p>
        </div>
        <div class="left-content">
            <div class="media-container">
                <div class="empty-video" style="display: none;">
                    <iframe width="100%" height="600" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>

                <div class="empty-image" style="display: none;">
                    <img src="v.png" alt="placeholder" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            <div class="empty-text" style="display: none; font-size: 40px">
                <h3>sssss</h3>
                <p>sssssss</p>
            </div>
        </div>

        <div class="image-gallery">
            <?php
                // Fetch movies from the database
                $sql = "SELECT * FROM movies";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("Database query failed: " . mysqli_error($conn));
                }

                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $class = ($count > -1) ? 'floating-image' : ''; // Apply the class to the first image
                    $count++;
            ?>
                    <div class="image-container">
                        <img src="<?php echo $row['Movie_Poster']; ?>" onclick="showId(<?php echo $row['Movie_ID']; ?>)" alt="<?php echo $row['Movie_Name']; ?>" class="<?php echo $class; ?>">
                    </div>
                <?php } ?>
        </div>
    </section>

    <footer>
        <div class="review-form">
            <h3>Leave a Review</h3>

            <?php if (isset($_SESSION['review_submitted']) && $_SESSION['review_submitted'] == true): ?>
                <div class="success-message" style="color: green; font-weight: bold;">
                    Review has been submitted successfully!
                </div>
                <?php
                unset($_SESSION['review_submitted']);
                ?>
            <?php endif; ?>

            <form id="reviewForm" action="index.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="review">Review:</label>
                    <textarea id="review" name="review" rows="4" required></textarea>
                </div>
                <button type="submit" class="cta-button">Submit Review</button>
            </form>
        </div>
        <p>&copy; 2025 Your Website. All rights reserved.</p>
    </footer>

    <script>
        let selectedId;

        let currentlyExpanded = null;
        const expandedRow = document.querySelector('.expanded-row');
        const expandedImage = document.querySelector('.expanded-image');
        const movieDescription = document.getElementById('movie-description');

        function showId(id) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            selectedId = id;

            document.querySelector('.empty-text').style.display = "block";
            document.querySelector('.empty-image').style.display = "block";
            document.querySelector('.empty-video').style.display = "block";

            fetch(`get_movie_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {

                    document.querySelector('.empty-text h3').textContent = data.Movie_Name;
                    document.querySelector('.empty-text p').textContent = data.Movie_Description;
                    document.querySelector('.empty-image img').src = data.Movie_Poster;

                    let videoId = data.Movie_Trailer.split('v=')[1];

                    const ampersandPosition = videoId.indexOf('&');
                    if(ampersandPosition != -1) {
                        videoId = videoId.substring(0, ampersandPosition);
                    }
                    const embedUrl = `https://www.youtube.com/embed/${videoId}`;
                    document.querySelector('.empty-video iframe').src = embedUrl;
                });
        }
    </script>
</body>
</html>