<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Sign Up</title>
  <style>
    /* Your CSS styles here */
  </style>
</head>
<body>

<?php
// Define server-side logic for login and sign up actions
function validateLogin() {
  // Server-side validation logic can be implemented here
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Example validation, replace with your own logic
  if ($username === "user123" && $password === "password123") {
    // Redirect to a specific page on successful login
    header("Location: https://www.ainventions.com");
    exit(); // Ensure script execution stops after redirect
  } else {
    // Display error message
    echo '<div class="error-message" id="login-error-message">Username or Password is incorrect</div>';
  }
}

function signUp() {
  // Server-side validation logic can be implemented here
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Example logic for sign up, replace with your own logic
  // If sign up is successful, you can redirect or perform other actions
  // For demonstration purposes, assume successful signup and display alert
  echo '<script>alert("Signed up successfully! Please log in.");</script>';
}

// Check if form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login-submit'])) {
  validateLogin();
}

// Check if form is submitted for sign up
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup-submit'])) {
  signUp();
}
?>

<div class="container">
  <!-- Login Form -->
  <form id="login-form" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Login</h2>
    <input type="text" name="username" id="username" placeholder="Username" required>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <input type="submit" name="login-submit" value="Login">
    <!-- Error message for login -->
    <div class="error-message" id="login-error-message"></div>
  </form>

  <!-- Sign Up Form -->
  <form id="signup-form" class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Sign Up</h2>
    <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>
    <input type="text" name="username" id="signup-username" placeholder="Username" required>
    <input type="text" name="email" id="signup-email" placeholder="Email" required>
    <input type="password" name="password" id="signup-password" placeholder="Password" required>
    <input type="submit" name="signup-submit" value="Sign Up">
    <!-- Error message for sign up -->
    <div class="error-message" id="signup-error-message"></div>
  </form>

  <!-- Toggle button to switch between login and sign up -->
  <div class="toggle-button" onclick="toggleForms()">Don't have an account? Sign Up</div>
</div>

<script>
  // JavaScript code for client-side validation and form toggle
  // Keep your JavaScript code as it is
</script>
</body>
</html>
