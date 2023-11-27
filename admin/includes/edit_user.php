<?php

if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_user_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}




if (isset($_POST['edit_user'])) {
    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];



    $user_role = escape($_POST['user_role']);



    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";

        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $user_image = $row['user_image'];
        }
    }


    if (!empty($user_password)) {

        $query_password = "SELECT user_password FROM users WHERE user_id = '{$the_user_id}'";
        $get_user_query = mysqli_query($connection, $query_password);
        checkQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);

        $db_user_password = $row['user_password'];

        if (password_verify($user_password, $db_user_password)) {

            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        }


        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE user_id = {$the_user_id}";

        $update_user_query = mysqli_query($connection, $query);
        checkQuery($update_user_query);
    }
    header("Location:users.php");
}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input autocomplete="off" type="password" value="" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>


    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <img width='200' src="../images/<?php echo $user_image; ?>" alt="">
        <label for="user_image"></label>
        <input type="file" name="image">
    </div>


    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php
            if ($user_role == 'admin') {
                echo "<option value='user'>user</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Post">

</form>