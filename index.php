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
   display: grid;
   grid-template-columns: 1fr;
   gap: 2rem;
   align-items: start;
   max-width: 1400px;
   margin: 0 auto;
}

.hero-content h1,
.hero-content > p,
.hero-content .cta-button {
   grid-column: 1 / -1;
   text-align: center;
}

.left-content {
   width: 100%;
   max-width: 1400px;
   margin: 0 auto;
}

.media-container {
   display: grid;
   grid-template-columns: 2fr 1fr;
   gap: 2rem;
   margin-bottom: 2rem;
}

.empty-video {
   width: 100%;
   height: 800px;
}

.empty-video iframe {
   width: 100%;
   height: 100%;
   border-radius: 10px;
   background: #2e2e46;
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.empty-image {
   background: #2e2e46;
   border-radius: 10px;
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
   overflow: hidden;
   width: 70%;
   justify-self: end;
}

.empty-image img {
   width: 100%;
   height: 100%;
   object-fit: cover;
}

.empty-text {
   width: 80%;
   margin: 0 auto;
   text-align: center;
   background: #2e2e46;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
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
   .media-container {
       grid-template-columns: 1fr;
   }
   
   .empty-video, .empty-image {
       height: 500px;
   }
   
   .empty-image {
       width: 90%;
       margin: 0 auto;
   }
   
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
   
   .empty-text {
       width: 90%;
   }
   
   .empty-image {
       width: 100%;
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
    <h1></h1>
    <p></p>
    

    <!-- Empty image holder
    <div class="empty-image" style="display: none;">
        <img src="v.png" alt="placeholder" style="width: 100%; height: 100%; object-fit: cover;">
    </div> -->
    
   
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

             

              $sql = "SELECT * FROM movies";
              $result = mysqli_query($conn, $sql);
              
              while($row = mysqli_fetch_assoc($result)) { ?>
                <?php echo '<div class="image-container">'; ?>
              <img src="<?php echo $row['Movie_Poster']; ?>" 
                   onclick="showId(<?php echo $row['Movie_ID']; ?>)" 
                   alt="<?php echo $row['Movie_Name']; ?>">
                   <?php echo '</div>'; ?>
          <?php } ?>
            
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
       


        let selectedId;

       
let currentlyExpanded = null;
const expandedRow = document.querySelector('.expanded-row');
const expandedImage = document.querySelector('.expanded-image');
const movieDescription = document.getElementById('movie-description');

function showId(id) {
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

function setId(id) {
    selectedId = id;

   


}
    </script>
</body>
</html>