<?php
session_start();
include  "includes/header.php";
include "includes/nav.php"; 
include "includes/db.php"; 
?>
<script>
function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete?")) {
       window.location.href = 'view_all_users.php?delete=' + userId;
    }
}
</script>


          <?php
          $records_per_page = 10;
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($current_page - 1) * $records_per_page; 
          $query = "SELECT * FROM users LIMIT $offset, $records_per_page";
          $select_users = mysqli_query($connection, $query);

          if (!$select_users) {
              die("Query Failed: " . mysqli_error($connection));
          }
          ?>

          <div class="container mt-3 mb-4">
            <form action="search.php" method="get">
                
                    <input type="text" id="search" name="q" placeholder="Search here">
                    <input type="submit" value="Search">
                </form>
          </div>

            <div  class="container" class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Username</th>
                            <th>Created</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php 
                        $query = "SELECT * FROM users LIMIT $offset, $records_per_page";
                        $select_users = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_users)) 
                        {
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
                        echo "<td><a href='javascript:void(0);' onclick='confirmDelete($id)'>Delete</a></td>";

                        echo "</tr>";
                        }
                        
                        
                            ?>
                    </tbody>
                </table>
                        <?php
                            if(isset($_GET['delete'])){
                            $id_del = $_GET['delete'];
                            $query = "DELETE FROM users WHERE id = {$id_del} ";
                             $delete_user_query = mysqli_query($connection, $query);
                             if (!$delete_user_query) {
                                die("Deletion failed: " . mysqli_error($connection));
                            }
                            
                        }
                        ob_end_flush();

                        ?>
                        <?php
                            $total_query = "SELECT COUNT(*) as total FROM users";
                            $total_result = mysqli_query($connection, $total_query);
                            $total_row = mysqli_fetch_assoc($total_result);
                            $total_records = $total_row['total'];
                            $total_pages = ceil($total_records / $records_per_page);
                            echo '<nav aria-label="Page navigation example"><ul class="pagination">';
                            for ($i = 1; $i <= $total_pages; $i++) 
                            {
                                echo '<li class="page-item';
                                if ($i == $current_page) 
                                {
                                    echo ' active';
                                }
                                echo '"><a class="page-link" href="view_all_users.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            echo '</ul></nav>';
                        ?>

