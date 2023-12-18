
<?php
session_start();
include "includes/header.php";
include "includes/nav.php"; ?>

<?php include "includes/db.php"; ?>

<?php 
                        if(isset($_SESSION['status']))
                        {
                            echo "<h4>".$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "POST") 
                        {
                            $name = $_POST["name"];
                            $email = $_POST["email"];
                            $phone = $_POST["phone"];
                            $address = $_POST["address"];
                            $emailParts = explode('@', $email);
                            $username = $emailParts[0];
                            $password = $_POST["password"];
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                          
                            if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($username) || empty($password)) {
                                echo "All fields are required.";
                            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                echo "Invalid email.";
                            } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
                                echo "Invalid phone number.";
                            } else {
                            $query = "INSERT INTO users (name, email, phone, address, username, password) VALUES ('$name', '$email', '$phone', '$address', '$username', '$password')";
                            if (mysqli_query($connection, $query)) {
                            echo "Registration successful. You are now registered!";
                            header("Location: login.php");
                            } else {
                            echo "Error: " . $query . "<br>" . mysqli_error($connection);
                            }
                            }
                        }
?>

<div class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
              
                <div class="card ">
                    <div class="card-header">
                        <h5>Registration</h5>
                    </div>
                    <div class="card-body">
                        <form  method="post">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include "includes/footer.php"; ?>
