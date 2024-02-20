<?php
session_start();

// Check if the user is already logged in, redirect to home page
if(isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (assuming MySQL)
    $connection = mysqli_connect("localhost", "username", "password", "database_name");

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user input to prevent SQL Injection
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Hash password for comparison
    $hashed_password = md5($password);

    // Query to check if username and password match
    $query = "SELECT id FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = mysqli_query($connection, $query);

    // If result matched, table row must be 1 row
    if(mysqli_num_rows($result) == 1) {
        // Set session variables
        $_SESSION['user_id'] = $row['id'];
        header("Location: home.php"); // Redirect user to home page
    } else {
        $error = "Username or Password is incorrect";
    }

    // Close connection
    mysqli_close($connection);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php if(isset($error)) { echo "<div>" . $error . "</div>"; } ?>
</body>
</html>
