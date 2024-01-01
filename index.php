<!DOCTYPE html>
<html>
    <body style="background: #f5f2ea">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Daily Activities</title>
       </head>

       <div class="container d-flex flex-column">
        <div class="row justify-content-center pt-5 px-5">
            <div class="col-md-4">
                <form method="post" action="login.php" class="border rounded m-3 p-5 bg-white">
                    <h1 class="text-center text-primary font-weight-bold">Log in</h1>
                    <p class="text-center">Enter your details to get signed<br>in to your account</p>


                    <div class="mb-3">
                       <strong><label for="username" class="form-label">Username</label></strong>
                       <input type="text" class="form-control" name="username" placeholder="Enter your Username">
                   </div>
                   <div class="mb-3">
                        <strong><label for="password" class="form-label">Password</label></strong>
                        <input type="text" class="form-control" name="password" id="pass" placeholder="Enter your Password">
                   </div>
                   <div class="row mx-0 mb-3">
                    <button type="submit" class="btn btn-primary">Log in</button>
                   </div>

                   <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                   <div class="row">
                      <p class="text-center">Don't have an account? <strong><a href="register.php" class="text-primary text-decoration-none">Register</a></strong></p>
                    </div>
                </form>
            </div>
        </div>
       </div>








    </body>
</html>