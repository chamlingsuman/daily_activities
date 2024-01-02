<?php 
require('config.php');
session_start(); 

$errors = array();

$username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';

if(isset($_POST[$username])){
  $first_name = mysqli_real_escape_string($conn, $_POST['fname']);
  $last_name = mysqli_real_escape_string($conn, $_POST['lname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $state = mysqli_real_escape_string($conn, $_POST['state']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
}

$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
  if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
  }

  if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
  }

  // Check if there are no errors
  if (count($errors) == 0) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users (fname, lname, email, gender, username, password, city, state) 
                VALUES($first_name, $last_name, $email, $gender, $username, $password, $city, $state)";
      $stmt = mysqli_prepare($conn, $query);

      // Bind parameters
      mysqli_stmt_bind_param($stmt, "ssssssss", $first_name, $last_name, $email, $gender, $username, $hashed_password, $city, $state);

      // Execute the statement
      mysqli_stmt_execute($stmt);

      // Set session variables and redirect
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Registration successful! New data registered.";
      header('location: index.php');
      exit(); // Ensure no further code execution after redirection
  }
}


?>


<!DOCTYPE html>
<html>
    <body>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Daily Activities</title>
       </head>
       <div class="row m-3 font-weight-bold">
        <h3>Registration Form</h3>
       </div>
       <form class="row m-5 needs-validation border rounded m-2 p-2 bg-white" action="register.php" method="POST">
  <div class="col-md-6 mb-2">
    <label for="fname" class="form-label" name="fname">First name</label>
    <input type="text" class="form-control" id="validationCustom01" name="fname">
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input type="text" class="form-control" name="lname">
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="validationCustom04" class="form-label">Gender</label>
    <select class="form-select" name="gender" required>
      <option selected disabled value="">Select the Gender</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid Gender.
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="username" class="form-label">Username</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" aria-describedby="inputGroupPrepend" name="username" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="validationCustomUsername" class="form-label">Password</label>
    <div class="input-group has-validation">
      <input type="password" class="form-control" aria-describedby="inputGroupPrepend" name="password" required>
      <div class="invalid-feedback">
        Please enter the password.
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="validationCustom03" class="form-label">City</label>
    <input type="text" class="form-control" name="city">
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>
  <div class="col-md-6 mb-2">
    <label for="validationCustom04" class="form-label">State</label>
    <select class="form-select" name="state" required>
      <option selected disabled value="">Select the State</option>
      <option>Koshi</option>
      <option>Madhesh</option>
      <option>Bagmati</option>
      <option>Gandaki</option>
      <option>Lumbini</option>
      <option>Karnali</option>
      <option>Sudur Paschim</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
  <div class="col-12 d-flex justify-content-end">
    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
  </div>
</form>



    </body>
</html>
