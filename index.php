<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ticketbooth";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Website</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1c1c2e, #3e3e58);
            color: #f4f4f4;
            line-height: 1.6;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background-color: #2e2e46;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.5rem;
        }

        nav img {
            max-height: 60px;
            border-radius: 50%;
        }

        .hero {
            min-height: 100vh;
            padding: 6rem 2rem 2rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            color: #ffcc00;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            text-align: center;
        }

        .image-gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 1rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        .image-container {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-container img {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .expanded-row {
            grid-column: 1 / -1;
            display: none;
            background: #2e2e46;
            border-radius: 1rem;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .expanded-row.active {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        .description-panel {
            background: #3e3e58;
            padding: 2rem;
            border-radius: 0.5rem;
            height: fit-content;
        }

        .expanded-image {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .expanded-image img {
            max-width: 100%;
            height: auto;
            max-height: 80vh;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .cta-button {
            display: inline-block;
            background: #ffcc00;
            color: #1c1c2e;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            background: #f9a825;
            transform: scale(1.1);
        }

        .features {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .features h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #ffcc00;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            padding: 2rem;
            background: #3e3e58;
            border-radius: 10px;
            border: 2px solid #ffcc00;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #ffcc00;
        }

        footer {
            background: #2e2e46;
            color: white;
            padding: 2rem;
            text-align: center;
        }

        @media (max-width: 1200px) {
            .image-gallery {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .image-gallery {
                grid-template-columns: repeat(2, 1fr);
            }
            .expanded-row.active {
                grid-template-columns: 1fr;
            }
            .expanded-image {
                order: -1;
            }
        }

        @media (max-width: 600px) {
            .image-gallery {
                grid-template-columns: 1fr;
            }
            .hero h1 {
                font-size: 20px;
            }
            .expanded-row {
                padding: 1rem;
            }
            .description-panel {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="#" style="font-size: 1.5rem; font-weight: bold;"><img src="v.png" alt="0"></a>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Welcome to Our Website</h1>
            <p>Experience the future of web design with our modern and responsive website template.</p>
            <a href="index2.php" class="cta-button">Get Started</a>
        </div>
        
        <div class="image-gallery">
            <?php
            $result = $conn->query("SELECT * FROM movies");

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="image-container">';
                    echo '<img src="' . $row["Movie_Poster"] . '" alt="movie poster" data-movie-id="' . $row["Movie_ID"] . '">';
                    echo '</div>';
                }
            }
            ?>
            <div class="expanded-row">
                <div class="description-panel">
                    <h2>Movie Details</h2>
                    <div id="movie-description">
                        <!-- Movie details will be loaded here -->
                    </div>
                </div>
                <div class="expanded-image">
                    <!-- Expanded image will be loaded here -->
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <h2>Our Features</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>Modern Design</h3>
                <p>Clean and contemporary design that puts your content first and ensures a great user experience across all devices.</p>
            </div>
            <div class="feature-card">
                <h3>Responsive Layout</h3>
                <p>Fully responsive design that looks and works great on desktop, tablet, and mobile devices.</p>
            </div>
            <div class="feature-card">
                <h3>Fast Performance</h3>
                <p>Optimized for speed and performance to ensure your website loads quickly and efficiently.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Your Website. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // start here
            const expandedRow = document.querySelector('.expanded-row');
            const expandedImage = document.querySelector('.expanded-image');
            const movieDescription = document.getElementById('movie-description');
            //
            let currentlyExpanded = null;

            document.querySelectorAll('.image-container img').forEach(img => {
                img.addEventListener('click', function() {
                    const container = this.closest('.image-container');
                    
                    if (currentlyExpanded === this) {
                        expandedRow.classList.remove('active');
                        currentlyExpanded = null;
                        return;
                    }

                    currentlyExpanded = this;

                    const expandedImg = document.createElement('img');
                    expandedImg.src = this.src;
                    
                    expandedImage.innerHTML = '';
                    expandedImage.appendChild(expandedImg);

                    const galleryItems = Array.from(document.querySelectorAll('.image-container'));
                    const clickedIndex = galleryItems.indexOf(container);
                    const rowSize = window.innerWidth > 1200 ? 4 : window.innerWidth > 900 ? 3 : window.innerWidth > 600 ? 2 : 1;
                    const rowEnd = Math.ceil((clickedIndex + 1) / rowSize) * rowSize;
                    const targetContainer = galleryItems[rowEnd - 1] || galleryItems[galleryItems.length - 1];
                    
                    targetContainer.parentNode.insertBefore(expandedRow, targetContainer.nextSibling);
                    expandedRow.classList.add('active');

                    expandedRow.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

                    const movieId = this.dataset.movieId;
                    movieDescription.innerHTML = `
                    <?php
                    
                       echo ' <h3>Movie Title</h3> ';
                       echo ' <p>Release Date: </p> ';
                       echo ' <p>Director: </p> ';
                       echo ' <p>Description: </p> ';
                    
                    
                    ?>
                        
                    `;
                });
            });
        });
    </script>
</body>
</html>