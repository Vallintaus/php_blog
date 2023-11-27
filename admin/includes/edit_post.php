<?php

if (isset($_GET['p_id'])) {

    $get_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = {$get_post_id} ";
$select_posts_by_id = mysqli_query($connection, $query);



while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_author = $row['post_author'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {


    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['category']);
    $post_status = escape($_POST['post_status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = escape($_POST['tags']);
    $post_content = escape($_POST['content']);


    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $get_post_id ";

        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }


    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$get_post_id}";

    $update_post_query = mysqli_query($connection, $query);


    checkQuery($update_post_query);

    echo "<h2 class='bg-success text-center '>Post updated <a href='../post.php?p_id={$get_post_id}'><br>View post</a></h2>";


    // header("Location:posts.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label></label>
        <select name="category" id="category">

            <?php
            $query = "SELECT * FROM categories";
            $get_categories_query = mysqli_query($connection, $query);
            checkQuery($get_categories_query);

            while ($row = mysqli_fetch_array($get_categories_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($post_category_id == $cat_id) {
                    echo "<option value='$cat_id' selected>$cat_title</option>";
                } else {
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            }
            ?>
        </select>

    </div>


    <div class="form-group">
        <select name='post_status' id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>

            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>draft</option>";
            } else {
                echo "<option value='published'>published</option>";
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <img width='200' src="../images/<?php echo $post_image; ?>" alt="">
        <label for="post_image"></label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update">

    </div>

</form>