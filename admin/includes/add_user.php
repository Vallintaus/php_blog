<?php

if (isset($_POST['add_user'])) {
    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];


    $user_role = escape($_POST['user_role']);

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));


    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";

    $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}', '{$user_lastname}','{$user_email}','{$user_image}','{$user_role}') ";

    $add_user_query = mysqli_query($connection, $query);


    checkQuery($add_user_query);

    echo "<h4 class='alert alert-success'><strong>User created</strong><a href='../users.php'></a></h4>";
}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>


    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">Image</label>
        <input type="file" name="image">
    </div>


    <div class="form-group">
        <label for="user_role"></label>
        <select name="user_role" id="">
            <option value="user">Select role</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Post">

</form>