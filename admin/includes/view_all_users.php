<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Promote</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>


        <?php

        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            $to_admin = "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            $to_user = "<td><a href='users.php?change_to_user={$user_id}'>User</a></td>";


            echo "<tr>";

            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td><img width='50' src='../images/$user_image' alt='image'></td>";
            echo "<td>{$user_role}</td>";


            echo "<td class='align-middle'>";
            echo "<form method='post' action='users.php'>";
            echo "<div class='form-group'>";
            echo "<select class='form-control' name='user_role'>";
            echo "<option value='admin' " . ($user_role == 'admin' ? 'selected' : '') . ">admin</option>";
            echo "<option value='user' " . ($user_role == 'user' ? 'selected' : '') . ">user</option>";
            echo "</select>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<input type='hidden' name='user_id' value='{$user_id}'>";
            echo "<input class='btn btn-secondary' type='submit' name='update_role' value='Promote'>";
            echo "</div>";
            echo "</form>";
            echo "</td>";


            // echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
            // echo "<td><a href='users.php?change_to_user=$user_id'>User</a></td>";

            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>edit</a></td>";

            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'>Delete</a></td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>


<?php

// if (isset($_GET['change_to_admin'])) {
//     $user_to_admin = $_GET['change_to_admin'];

//     $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $user_to_admin ";
//     $to_admin_query = mysqli_query($connection, $query);
//     header("Location:users.php ");
// }

// if (isset($_GET['change_to_user'])) {
//     $admin_to_user = $_GET['change_to_user'];

//     $query = "UPDATE users SET user_role = 'user' WHERE user_id = $admin_to_user ";
//     $to_user_query = mysqli_query($connection, $query);
//     header("Location:users.php ");
// }

if (isset($_POST['update_role'])) {
    $user_id = escape($_POST['user_id']);
    $new_role = escape($_POST['user_role']);

    $query = "UPDATE users SET user_role = '$new_role' WHERE user_id = $user_id";
    $update_query = mysqli_query($connection, $query);

    if (!$update_query) {
        die("Query Failed: " . mysqli_error($connection));
    }

    header("Location: users.php");
}



if (isset($_GET['delete'])) {

    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {

            $user_delete_id = mysqli_real_escape_string($connection, $_GET['delete']);

            $query = "DELETE FROM users WHERE user_id = {$user_delete_id}";

            $delete_query = mysqli_query($connection, $query);


            header("Location:users.php");
        }
    }
}

?>