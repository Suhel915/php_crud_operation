<?php 
session_start();
include  "includes/header.php";
include "includes/nav.php"; ?>
<?php include "includes/db.php"; ?> 


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                <?php
                    if (isset($_GET['view'])) 
                    {
                        $id = $_GET['view'];
                        $query = "SELECT * FROM users WHERE id = $id";
                        $result = mysqli_query($connection, $query);
                        if ($result && mysqli_num_rows($result) > 0) 
                        {
                        $user = mysqli_fetch_assoc($result);

                            echo "<div class='card'>";
                            echo "<div class='card-header'><h5>User Details</h5></div>";
                            echo "<div class='card-body'>";
                            echo "ID: " . $user['id'] . "<br>";
                            echo "Name: " . $user['name'] . "<br>";
                            echo "Email: " . $user['email'] . "<br>";
                            echo "Address: " . $user['address'] . "<br>";
                            echo "Username: " . $user['username'] . "<br>";
                            echo "Created at: " . $user['created_at'] . "<br>";
                            echo "</div></div>";
                        } 
                        else {
                            echo "User not found.";
                             }

                    
                    } else {
                            echo "Invalid request.";
                           }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>