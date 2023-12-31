<?php include "./admin/includes/modal.php"; ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Mitähän tänään syötäisiin?</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    $category_class = "";

                    $registration_class = "";

                    $contact_class = "";

                    $pageName = basename($_SERVER['PHP_SELF']);

                    $registration = 'registration.php';

                    $contact = 'contact.php';

                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {

                        $category_class = "active";
                    } else if ($pageName == $registration) {
                        $registration_class = 'active';
                    } else if ($pageName == $contact) {
                        $contact_class = 'active';
                    }
                    echo "<li class='{$category_class}'><a href='category.php?category={$cat_id}'> {$cat_title} </a></li>";
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class='<?php echo $contact_class; ?>'><a href='contact.php'>Contact</a></li>

                <?php
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                    echo "<li><a href='admin/index.php'>Admin</a></li>";
                }

                if (isset($_SESSION['user_role'])) {
                ?>

                    <li>
                        <a href="" id="logoutLink"><i class='fa fa-fw fa-power-off'></i>Log Out</a>
                        <script>
                            // function confirmLogout() {
                            //     var confirmLogout = confirm('Are you sure you want to log out?');
                            //     return confirmLogout;
                            // }

                            $(document).ready(function() {
                                $("#logoutLink").on("click", function(e) {
                                    e.preventDefault();
                                    $("#myModal .modal-body").html("<h3>Are you sure you want to log out?</h3>");
                                    $("#myModal .modal-footer").html('<button type="button" class="btn btn-danger" id="logoutButton">Logout</button>' +
                                        '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');

                                    $("#myModal").modal("show");
                                });

                                $("#myModal").on("click", "#logoutButton", function() {
                                    window.location.href = 'includes/logout.php';
                                });

                                $("#myModal .btn-default").on("click", function() {
                                    $("#myModal").modal("hide");
                                });

                                $("#myModal .close").on("click", function() {
                                    $("#myModal").modal("hide");
                                });
                            });
                        </script>
                    </li>
                <?php
                } else {
                    echo "<li class='$registration_class'><a href='registration.php'>Registration</a></li>";
                }

                if (isset($_SESSION['user_role']) && isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];
                    echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit post</a></li>";
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>