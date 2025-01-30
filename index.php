<?php
// Start the session
session_start();

// Database connection
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
    // Sanitize form input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    // Insert review into the database
    $sql = "INSERT INTO reviews (name, email, review) VALUES ('$name', '$email', '$review')";

    if (mysqli_query($conn, $sql)) {
        // Set session variable for success message
        $_SESSION['review_submitted'] = true;

        // Optionally, redirect back to the homepage or a confirmation page
        header('Location: index.php'); // Redirect to refresh the page
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
    <title>Welcome to My Website</title>
    <link rel="stylesheet" href="style.css"> <!-- Linking the external CSS file -->
</head>
<body>
    <header>
        <nav>
           <img src="ShowPick icon.png" alt="0"></a>
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

                while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="image-container">
                        <img src="<?php echo $row['Movie_Poster']; ?>" onclick="showId(<?php echo $row['Movie_ID']; ?>)" alt="<?php echo $row['Movie_Name']; ?>">
                    </div>
                <?php } ?>
        </div>
    </section>

    <footer>
        <div class="review-form">
            <h3>Leave a Review</h3>

            <!-- Show success message if review is successfully submitted -->
            <?php if (isset($_SESSION['review_submitted']) && $_SESSION['review_submitted'] == true): ?>
                <div class="success-message" style="color: green; font-weight: bold;">
                    Review has been submitted successfully!
                </div>
                <?php
                // Clear the session variable after showing the success message
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

            // Show the empty holders
            document.querySelector('.empty-text').style.display = "block";
            document.querySelector('.empty-image').style.display = "block";
            document.querySelector('.empty-video').style.display = "block";

            fetch(`get_movie_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    // Update text and image
                    document.querySelector('.empty-text h3').textContent = data.Movie_Name;
                    document.querySelector('.empty-text p').textContent = data.Movie_Description;
                    document.querySelector('.empty-image img').src = data.Movie_Poster;

                    // Convert YouTube URL to embed format
                    let videoId = data.Movie_Trailer.split('v=')[1];
                    // Handle if there are additional parameters
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
