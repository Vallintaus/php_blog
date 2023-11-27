<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_topbar.php" ?>
    <?php include "includes/admin_sidebar.php" ?>





    <div id="page-wrapper">

        <div class="container-fluid">
            <h1 class="page-header">
                Welcome to admin
                <small>Author</small>
            </h1>
            <?php
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                $_SESSION['message'] = "";
                echo "<h2 class='bg-success text-center py-3'>$message</h2>";
            }
            ?>



            <?php
            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = "";
            }

            switch ($source) {

                case "add_user";
                    include "includes/add_user.php";
                    break;


                case 'edit_user';
                    include "includes/edit_user.php";
                    break;


                default:
                    include "includes/view_all_users.php";
                    break;
            }



            ?>





            <div class="row">

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>