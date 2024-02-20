<?php
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

  // Hash password for security
  $hashed_password = md5($password);

  // Insert user data into database
  $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
  if (mysqli_query($connection, $query)) {
    echo "User registered successfully";
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
  }

  // Close connection
  mysqli_close($connection);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
</head>
<body>
<h2>Sign Up</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <input type="submit" value="Sign Up">
</form>
</body>
</html>
