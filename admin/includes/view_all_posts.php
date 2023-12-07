<?php include "modal.php"; ?>

<?php
if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkBoxValueId) {

        $bulk_options = escape($_POST['bulk_options']);

        switch ($bulk_options) {

            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValueId}'";
                $publish_checked = mysqli_query($connection, $query);
                checkQuery($publish_checked);
                break;


            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValueId}'";
                $draft_checked = mysqli_query($connection, $query);
                checkQuery($draft_checked);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = '{$checkBoxValueId}'";
                $delete_checked = mysqli_query($connection, $query);
                checkQuery($delete_checked);
                break;

            case 'clone':
                // get data of post
                $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValueId}' ";
                $select_post_to_clone = mysqli_query($connection, $query);

                // Clone
                while ($row = mysqli_fetch_assoc($select_post_to_clone)) {
                    $post_author =      $row['post_author'];
                    $post_title =       $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status =      $row['post_status'];
                    $post_image =       $row['post_image'];
                    $post_tags =        $row['post_tags'];
                    $post_content =     $row['post_content'];
                    $post_date =        $row['post_date'];

                    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                    $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

                    $clone_post = mysqli_query($connection, $query);
                    checkQuery($clone_post);
                    break;
                }

            case 'reset_views':
                // Reset views logic
                $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = '{$checkBoxValueId}'";
                $reset_views = mysqli_query($connection, $query);
                checkQuery($reset_views);
                break;
        }
    }
}

?>


<form action="" method="post">
    <table class="table table-striped table-hover">

        <div class="row">
            <div class="col-xs-4" id="bulkOptionsContainer">
                <select name="bulk_options" id="bulk_options" class="form-control">
                    <option value="">Select option</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                    <option value="reset_views">Reset views</option>
                </select>
            </div>

            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
            </div>
        </div>

        <thead class="thead-dark">
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Made by</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>


            <?php

            $query = "SELECT * FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";

            $select_posts = mysqli_query($connection, $query);



            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id =              $row['post_id'];
                $post_author =          $row['post_author'];
                $post_title =           $row['post_title'];
                $post_category_id =     $row['post_category_id'];
                $post_status =          $row['post_status'];
                $post_image =           $row['post_image'];
                $post_tags =            $row['post_tags'];
                $post_comment_count =   $row['post_comment_count'];
                $post_date =            $row['post_date'];
                $post_view_count =      $row['post_view_count'];
                $category_title =       $row['cat_title'];

                echo "<tr>";
            ?>

                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

            <?php
                echo "<td>{$post_id}</td>";
                echo "<td><a href='author_posts.php?author=$post_author&p_id=$post_id'>$post_author</a></td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                echo "<td>{$category_title}</td>";
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                echo "<td>$post_tags</td>";


                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);

                $row = mysqli_fetch_array($send_comment_query);
                $comment_id = isset($row['comment_id']);
                $count_comments = mysqli_num_rows($send_comment_query);


                echo "<td><a href='post_comments.php?id={$post_id}'>$count_comments</a></td>";





                echo "<td>$post_view_count</td>";
                echo "<td>$post_date</td>";
                echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a class='btn btn-danger delete-link' href='javascript:void(0)' data-post-id='{$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>


<?php

if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = ?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_to_delete);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);


    header("Location: posts.php");
    exit();
}

?>

<script>
    $(document).ready(function() {
        $(".delete-link").on("click", function() {
            let postId = $(this).data("post-id");
            let deleteUrl = "posts.php?delete=" + postId;

            // dynamic content
            $("#myModal .modal-body").html("<h3>Are you sure you want to delete post " + postId + "?</h3>");
            $("#myModal .modal-footer").html('<a href="' + deleteUrl + '" class="btn btn-danger modal_delete_link">Delete</a>' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');

            $("#myModal").modal("show");
        });

        $("#myModal").on("click", ".modal_delete_link", function() {
            window.location.href = $(this).attr("href");
        });
    });
</script>