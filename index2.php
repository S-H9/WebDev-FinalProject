

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowPick - Home</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1c1c2e, #3e3e58);
            color: #f4f4f4;
        }

        h1 {
            font-size: 24px;
            color: #ffcc00;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            text-align: center;
        }

        button {
            background-color: #ffcc00;
            color: #1c1c2e;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background-color: #f9a825;
            transform: scale(1.1);
        }

        a {
            color: #ffcc00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Search Section Styles */
        #search-section {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #2e2e46;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        #logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        #header-logo {
            max-width: 60px;
            margin-right: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        #search-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        #search-bar {
            flex: 2;
            padding: 0px;
            margin-top: 0px;
            text-indent: 10pt;
            border: none;
            border-radius: 20px 0 0 25px;
            font-size: 16px;
            background: #3e3e58;
            color: #f4f4f4;
            height: 60px;
            width: 750px;
        }

        #search-bar:focus {
            outline: none;
        }

        .dropdown {
            padding: 20px;
            border: none;
            border-radius: 0;
            background: #3e3e58;
            color: #f4f4f4;
            font-size: 16px;
            cursor: pointer;
            height: 60px;
        }

        .dropdown:focus {
            outline: none;
        }

        #search-button {
            background: #ffcc00;
            border: none;
            border-radius: 0 25px 25px 0;
            padding: 10px;
            color: #1c1c2e;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            height: 60px;
            width: 100px;
        }

        #search-button:hover {
            background: #f9a825;
        }

        /* Logout Button */
        #logout-container {
            position: absolute;
            top: 22px;
            right: 60px;
        }

        #logout-button {
            background-color: #ffcc00;
            color: #1c1c2e;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 90px;
            height: 40px;
        }

        #logout-button:hover {
            background-color: #f9a825;
            transform: scale(1.1);
        }

        /* Content Section */
        #content {
            margin-top: 80px;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .movie-card {
            background: #3e3e58;
            margin: 10px;
            padding: 10px;
            width: 270px;
            text-align: center;
            border-radius: 10px;
            border: 2px solid #ffcc00;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .movie-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .movie-card h3 {
            color: #ffcc00;
            margin: 10px 0;
        }

        #random-movies-title {
            font-size: 28px;
            color: #ffcc00;
            text-align: center;
            margin-top: 100px;  /* Adjusted margin to push down below the search bar */
        }
    </style>
</head>
<body>
    <div id="search-section">
        <div id="logo-container">
            <img src="ShowPick icon.png" id="header-logo" alt="ShowPick Logo">
            <h1>ShowPick</h1>
        </div>
        <div id="search-container">
            <form method="GET" action="">
                <input type="text" id="search-bar" name="search" placeholder="Search...">
                <select name="age_class" class="dropdown">
                    <option value="all" selected>All</option>
                    <option value="kids">Kids</option>
                    <option value="adult">Adult</option>
                </select>
                <select name="genre" class="dropdown">
                    <option value="all" selected>All</option>
                    <option value="action">Action</option>
                    <option value="comedy">Comedy</option>
                    <option value="horror">Horror</option>
                    <option value="drama">Drama</option>
                    <option value="romance">Romance</option>
                </select>
                <button type="submit" name="filter" id="search-button">Search</button>
            </form>
        </div>
        <div id="logout-container">
            <form method="POST" action="logout.php">
                <button type="submit" id="logout-button">Logout</button>
            </form>
        </div>
    </div>

    <div id="random-movies-title"><?= htmlspecialchars($title) ?></div>

    <div id="content">
        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    <h3><?= htmlspecialchars($movie['title']) ?></h3>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No movies found. Use the search to find content.</p>
        <?php endif; ?>
    </div>
</body>
</html>
