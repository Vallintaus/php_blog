<?php
if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkBoxValueId) {

        $bulk_options = escape($_POST['bulk_options']);

        switch ($bulk_options) {

            case 'approved':
                $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = '{$checkBoxValueId}'";
                $publish_checked = mysqli_query($connection, $query);
                checkQuery($publish_checked);
                break;


            case 'Unapproved':
                $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = '{$checkBoxValueId}'";
                $draft_checked = mysqli_query($connection, $query);
                checkQuery($draft_checked);
                break;

            case 'delete':
                $query = "DELETE FROM comments WHERE comment_id = '{$checkBoxValueId}'";
                $delete_checked = mysqli_query($connection, $query);
                checkQuery($delete_checked);
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
                    <option value="approved">Approve</option>
                    <option value="Unapproved">Disapprove</option>
                    <option value="delete">Delete</option>
                </select>
            </div>

            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
            </div>
        </div>

        <thead class="thead-dark">
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Disapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>


            <?php

            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];


                echo "<tr>";
            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>
            <?php

                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";

                echo "<td>{$comment_email}</td>";
                echo "<td>$comment_status</td>";


                // $query = "SELECT * FROM comments ";
                // $select_comment_id = mysqli_query($connection, $query);

                // while ($row = mysqli_fetch_assoc($select_comment_id)) {
                //     $comment_id = $row['comment_id'];


                //     echo "<td>{$comment_id}</td>";
                // }


                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                $get_post_id_to_comment = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($get_post_id_to_comment)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                }

                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a href='comments.php?disapprove=$comment_id'>Disapprove</a></td>";
                echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>


<?php

if (isset($_GET['approve'])) {
    $comment_id_to_approve = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $comment_id_to_approve ";
    $disapprove_query = mysqli_query($connection, $query);
    header("Location:comments.php ");
}



if (isset($_GET['disapprove'])) {
    $comment_id_to_disapprove = $_GET['disapprove'];

    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $comment_id_to_disapprove ";
    $disapprove_query = mysqli_query($connection, $query);
    header("Location:comments.php ");
}






if (isset($_GET['delete'])) {
    $comment_id_delete = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$comment_id_delete}";

    $delete_query = mysqli_query($connection, $query);


    header("Location:comments.php");
}

?>