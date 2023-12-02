<?php
$per_page = 5;

if (isset($_GET['page'])) {

    $page = intval($_GET['page']);
} else {

    $page = 1;
}

if ($page == 1) {
    $page_1 = 0;
} else {
    $page_1 = ($page * $per_page) - $per_page;
}

$post_count_query = "SELECT * FROM posts WHERE post_status = 'published'";
$count_all_posts = mysqli_query($connection, $post_count_query);
$count = mysqli_num_rows($count_all_posts);

if ($count < 1) {
    echo "<h1 class='text-center'>No posts</h1>";
} else {
    $count = ceil($count / $per_page);


    $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, $per_page";
    $select_all_posts_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 75,);
        $post_status = $row['post_status'];





?>

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- Blog Post -->
        <h2>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
        <hr>
        <a href="post.php?p_id=<?php echo $post_id; ?>">
            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
        </a>
        <hr>
        <p><?php echo $post_content ?></p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

<?php
    }
}


?>