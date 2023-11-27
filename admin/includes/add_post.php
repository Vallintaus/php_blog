<?php

if (isset($_POST['create_post'])) {
    $post_title = escape($_POST['title']);
    $post_author = $_SESSION['username'];
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date('d-m-y'));
    // $post_comment_count = 0;

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];



    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) ";

    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);


    checkQuery($create_post_query);

    $post_id = mysqli_insert_id($connection);

    echo "<h2 class='bg-success text-center '>Post created <a href='../post.php?p_id={$post_id}'><br>View post</a></h2>";



    // header("Location:posts.php");
}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label></label>
        <select name="post_category_id" id="category">

            <?php
            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connection, $query);

            checkQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];


                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }

            ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->


    <div class="form-group">
        <select name='post_status' id="">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Post">

    </div>

</form>