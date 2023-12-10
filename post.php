<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>


<?php
if (isset($_POST['liked'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    // SELECT POST
    $query = $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $select_post_query = mysqli_query($connection, $query);
    $post_result = mysqli_fetch_array($select_post_query);
    $likes = $post_result['post_likes'];

    //UPDATE LIKES - INCREMENT
    mysqli_query($connection, "UPDATE posts SET post_likes = $likes+1 WHERE post_id = $post_id");

    // CREATE LIKES FOR POST
    mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    exit();
}

if (isset($_POST['unliked'])) {


    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    // SELECT POST
    $query = $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $select_post_query = mysqli_query($connection, $query);
    $post_result = mysqli_fetch_array($select_post_query);
    $likes = $post_result['post_likes'];

    //UPDATE LIKES - DECREMENT
    mysqli_query($connection, "UPDATE posts SET post_likes = $likes-1 WHERE post_id = $post_id");

    // DELETE LIKES
    mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
    exit();
}

?>



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


                    <!-- Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <p class="label label-default">
                        Views - <?php echo $post_view_count ?>
                    </p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>

                    <div class="row">
                        <p class="pull-right" style="font-size: 2rem;">Likes: <?php getPostLikes($the_post_id); ?></p>
                    </div>
                    <div class=" clearfix">
                    </div>

            <?php
                }
            } else {
                header("Location: index.php");
            }
            ?>


            <!-- Blog Comments -->

            <?php

            if (isset($_SESSION['username'])) {

            ?>
                <hr>
                <div class="row">
                    <p class="pull-right" style="font-size: 2rem;"><a class="<?php echo userLikedThisPost($the_post_id) ? 'unlike' : 'like'; ?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo userLikedThisPost($the_post_id) ? ' Unlike' : ' Like'; ?></a></p>
                </div>
                <?php



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
                echo "Login to like and leave a comment.";
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

    <script>
        $(document).ready(function() {
            let post_id = <?php echo $the_post_id; ?>;
            let user_id = <?php echo loggedInUserId(); ?>

            // LIKE
            $('.like').click(function() {
                $.ajax({
                    url: "post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            })

            // UNLIKE
            $('.unlike').click(function() {
                $.ajax({
                    url: "post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                });
            })

        });
    </script>