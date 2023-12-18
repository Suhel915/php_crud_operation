
<?php
session_start();
include "includes/header.php";
include "includes/nav.php";
include "includes/db.php";
?>
<div class="py-5">
    <?php

        if (isset($_GET['q'])) {
        
            $search = mysqli_real_escape_string($connection, $_GET['q']);
            $query = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) 
            {
                echo "<table class='table table-bordered table-hover'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Id</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Address</th>";
                echo "<th>Username</th>";
                echo "<th>Created</th>";
                echo "<th>View</th>";
                echo "<th>Edit</th>";
                echo "<th>Delete</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $address = $row['address'];
                    $username = $row['username'];
                    $created_at = $row['created_at'];

                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td>{$email}</td>";
                    echo "<td>{$address}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$created_at}</td>";
                    echo "<td><a href='view_user.php?view={$id}'>View</a></td>";
                    echo "<td><a href='edit_user.php?edit={$id}'>Edit</a></td>";
                    echo "<td><a href='view_all_users.php?delete={$id}'>Delete</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                } else {
                echo "No results found.";
            }
        }
    ?>
</div>

<?php
include "includes/footer.php";
?>
