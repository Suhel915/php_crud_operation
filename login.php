<?php 
session_start();
include "includes/header.php";
include "includes/nav.php"; ?>
<?php include "includes/db.php" ?>
<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Database query failed: " . mysqli_error($connection));
            }

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashed_password_from_db = $row["password"];
                // var_dump($password); 
                // var_dump($hashed_password_from_db);
            if ($password == $hashed_password_from_db) {
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                header("Location: home.php");
                } else {
                echo "Invalid password. Please try again.";
                }
                } else {
                echo "User not found. Please register if you don't have an account.";
                }
            }
?>
<div class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
              
                <div class="card ">
                    <div class="card-header">
                        <h5>Login</h5>
                    </div>
                    <div class="card-body">
                        <form  method="post">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>
