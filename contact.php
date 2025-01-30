<?php
// Start the session
session_start();

// Database connection parameters
$host = 'localhost';  // Change this to your database host (usually localhost)
$username = 'root';   // Change this to your database username
$password = '';       // Change this to your database password
$dbname = 'ticketbooth';  // The name of the database you created

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data and sanitize it
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare the SQL query to insert the data into the database
    $sql = "INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param('sss', $name, $email, $message);

    // Execute the query
    if ($stmt->execute()) {
        // Set a session variable to indicate success
        $_SESSION['success_message'] = "Message sent successfully!";
    } else {
        // Optionally handle error
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the same page to avoid resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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

        .contact-section {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            color: #ffcc00;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            text-align: center;
        }

        .success-message {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .contact-form {
            background: #3e3e58;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ffcc00;
            font-size: 20px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #2e2e46;
            border-radius: 5px;
            background: #2e2e46;
            color: #f4f4f4;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
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

        .contact-info {
            margin-top: 3rem;
            display: flex;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap; /* Ensures responsiveness */
        }

        .card {
            background-color: #2e2e46;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 300px;
            margin-bottom: 2rem;
        }

        .card h3 {
            color: #ffcc00;
            font-size: 20px;
            margin-bottom: 1rem;
        }

        .card ul,
        .card ol {
            list-style-position: inside;
            padding-left: 1rem;
        }

        /* Full width for table */
        table {
            width: 100%;
            margin-top: 2rem; /* Added space from the cards */
            border-collapse: collapse;
            text-align: left;
            background-color: #3e3e58;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        table th, table td {
            padding: 1rem;
            border: 1px solid #2e2e46;
        }

        table th {
            background-color: #2e2e46;
            color: #ffcc00;
        }

        table td {
            background-color: #3e3e58;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="ShowPick icon.png" alt="Logo">
            <a href="index.php" class="cta-button" style="margin-left: auto; text-decoration: none; font-weight: normal;">Home</a>
        </nav>
    </header>

    <div class="contact-section">
        <h1>Contact Us</h1>
        <div class="contact-form">
            <h2>Get in Touch</h2>
            <?php
            // Display success message if it exists
            if (isset($_SESSION['success_message'])) {
                echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']); // Clear the message after displaying
            }
            // Optionally display an error message
            if (isset($_SESSION['error_message'])) {
                echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']); // Clear the message after displaying
            }
            ?>
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="cta-button">Send Message</button>
            </form>
        </div>

        <div class="contact-info">
            <div class="card">
                <h3>Team Members</h3>
                <ul>
                    <li>Ashraf Jamal Zafarana</li>
                    <li>Mohammed Hani Zaid</li>
                    <li>Ahmed Abdullah Bijar</li>
                    <li>Suhaib Abdul Wahab Khayat</li>
                </ul>
            </div>

            <div class="card">
                <h3>List of our Pages</h3>
                <ol>
                    <li>Home Page</li>
                    <li>Contact us Page</li>
                </ol>
            </div>

            <div class="card">
                <h3>Our Emails</h3>
                <ol>
                    <li>s444005942@uqu.edu.sa</li>
                    <li>s444001565@uqu.edu.sa</li>
                    <li>s444001765@uqu.edu.sa</li>
                    <li>s444005836@uqu.edu.sa</li>
                </ol>
            </div>
        </div>

        <div>
            <h3>Team Members Details</h3>
            <table>
                <tr>
                    <th>Names</th>
                    <th>University ID</th>
                </tr>
                <tr>
                    <td>Suhaib Abdul Wahab Khayat</td>
                    <td>444005836</td>
                </tr>
                <tr>
                    <td>Ashraf Jamal Zafarana</td>
                    <td>444005942</td>
                </tr>
                <tr>
                    <td>Mohammed Hani Zaid</td>
                    <td>444001565</td>
                </tr>
                <tr>
                    <td>Ahmed Abdullah Bijar</td>
                    <td>444001765</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>