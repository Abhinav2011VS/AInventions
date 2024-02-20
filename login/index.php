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
  <style>
    lmno {
      color: white;
    }

    lmn {
      color: white;
    }

    a {
      text-decoration:none;
      font-family: arial;
      font-size: 16px;
    }

    c {
      text-decoration:none;
      font-family: arial;
      font-size: 16px;
    }

    body {
      background-image: url('Pictures/HomeBack.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .dropbtn {
      background-color: black;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: black;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: white;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }


    .dropdown:hover .dropdown-content {display: block;}

    * {
      margin: 0;
      padding: 0;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: center;
      position: sticky;
      top: 0;
      size: 10%;
      cursor: pointer;
    }

    .background {
      background: black;
      background-blend-mode: darken;
      background-size: cover;
    }

    .nav-list {
      width: 70%;
      display: flex;
      align-items: center;
    }

    .logo {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .logo img {
      width: 180px;
      border-radius: 50px;
    }

    .nav-list li {
      list-style: none;
      padding: 26px 30px;
    }

    .nav-list li a {
      text-decoration: none;
      color: white;
    }

    .nav-list li a:hover {
      color: grey;
    }

    .rightnav {
      width: 70%;
      text-align: right;
      align-items: center;
      display: flex;
      font-decoration: none;
      color: white;
      font-family: arial;
      font-size: 16px;
    }

    .rightnav-list li {
      list-style: none;
      padding: 26px 30px;
    }

    .rightnav-list li a {
      text-decoration: none;
      color: white;
    }

    .reightnav-list li a:hover {
      color: grey;
    }

    #search {
      padding: 5px;
      font-size: 17px;
      border: 2px solid grey;
      border-radius: 9px;
    }

    .firstsection {
      background-color: green;
      height: 400px;
    }

    .secondsection {
      background-color: blue;
      height: 400px;
    }

    .box-main {
      display: flex;
      justify-content: center;
      align-items: center;
      color: black;
      max-width: 80%;
      margin: auto;
      height: 80%;
    }

    .firsthalf {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .secondhalf {
      width: 30%;
    }

    .secondhalf img {
      width: 70%;
      border: 4px solid white;
      border-radius: 150px;
      display: block;
      margin: auto;
    }

    .text-big {
      font-family: 'Piazzolla', serif;
      font-weight: bold;
      font-size: 35px;
    }

    .text-small {
      font-size: 18px;
    }

    .btn {
      padding: 8px 20px;
      margin: 7px 0;
      border: 2px solid white;
      border-radius: 8px;
      background: none;
      color: white;
      cursor: pointer;
    }

    .btn-sm {
      padding: 6px 10px;
      vertical-align: middle;
    }

    .section {
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      max-width: 90%;
      margin: auto;
    }

    .section-Left {
      flex-direction: row-reverse;
    }

    .paras {
      padding: 0px 65px;
    }

    .thumbnail img {
      width: 250px;
      border: 2px solid black;
      border-radius: 26px;
      margin-top: 19px;
    }

    .center {
      text-align: center;
    }

    .text-footer {
      text-align: center;
      padding: 30px 0;
      font-family: 'Ubuntu', sans-serif;
      display: flex;
      justify-content: center;
      color: white;
    }
  </style>
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
