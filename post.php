<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['p_id'])) {

                $the_post_id = $_GET['p_id'];

                $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $the_post_id ";
                $send_query = mysqli_query($connection, $view_query);

                if (!$send_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_view_count = $row['post_view_count'];

            ?>

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p class="">
                        Views - <kbd><?php echo $post_view_count ?></kbd>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>

                    <hr>

            <?php
                }
            } else {
                header("Location: index.php");
            }
            ?>


            <!-- Blog Comments -->

            <?php

            if (isset($_SESSION['username'])) {





                if (isset($_POST['create_comment'])) {

                    $the_post_id = $_GET['p_id'];

                    $comment_content = escape($_POST['comment_content']);

                    $comment_author = $_SESSION['username'];
                    $comment_email = $_SESSION['user_email'];

                    if (!empty($comment_content)) {


                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'approved', now()) ";

                        $create_comment_query = mysqli_query($connection, $query);

                        if (!$create_comment_query) {
                            die("QUERY FAILED" . mysqli_error($connection));
                        }
                    } else {
                        echo "<script>alert('Field cannot be empty')</script>";
                    }
                    header("Location: post.php?p_id={$the_post_id}");
                }






            ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <label>Your name</label>
                        <div class="form-group">
                            <p><?php echo $_SESSION['username']; ?></p>
                        </div>

                        <label>Comment</label>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

            <?php } else {
                echo "Login to leave a comment.";
            } ?>



            <!-- Posted Comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'Approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);


            if (!$select_comment_query) {
                die("QUERY FAILED!" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
            ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>



            <?php } ?>





        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>

    <?php include "includes/footer.php" ?>