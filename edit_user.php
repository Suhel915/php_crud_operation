<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/db.php";
?>
<?php
    if (isset($_GET['edit'])) {
            $user_id = $_GET['edit'];

            $query = "SELECT * FROM users WHERE id = $user_id";
            $select_user = mysqli_query($connection, $query);

                 if (!$select_user) {
                         die("Query Failed: " . mysqli_error($connection));
                                    }

                            $row = mysqli_fetch_assoc($select_user);
                            $name = $row['name'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $address = $row['address'];
                            $username = $row['username'];
                            

   
                        if (isset($_POST['update_user'])) {
                            $new_name = $_POST['name'];
                            $new_email = $_POST['email'];
                            $new_phone = $_POST['phone'];
                            $new_address = $_POST['address'];
                            $new_username = $_POST['username'];
                            
                            if (empty($new_name) || empty($new_email) || empty($new_phone) || empty($new_address) || empty($new_username) ) {
                                echo "All fields are required.";
                            } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                                echo "Invalid email.";
                            } elseif (!preg_match('/^[0-9]{10}$/', $new_phone)) {
                                echo "Invalid phone number.";
                            } else {
                            $query = "UPDATE users SET name = '$new_name', email = '$new_email', phone = '$new_phone', address = '$new_address', username = '$new_username' WHERE id = $user_id";
                            $update_user_query = mysqli_query($connection, $query);

                            if (!$update_user_query) {
                                die("Query Failed: " . mysqli_error($connection));
                            }

                        
                            header("Location: view_all_users.php");
                            }
                        }
                            }
                    else {
                    
                        header("Location: view_all_users.php");
                    }

?>

<div class="container mt-5">
    <h2>Edit User</h2>
    
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="phone" class="form-control" name="phone" value="<?php echo $phone; ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="form-group mt-3">
            <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
        </div>
    </form>
               
                </div>
            </div>
        </div>
    </div>
</div>