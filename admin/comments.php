<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_topbar.php" ?>
    <?php include "includes/admin_sidebar.php" ?>





    <div id="page-wrapper">

        <div class="container-fluid">
            <h1 class="page-header">
                Welcome to Admin
                <small>Author name</small>
            </h1>



            <?php
            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = "";
            }

            switch ($source) {

                case "add_comment";
                    include "includes/add_comment.php";
                    break;


                case 'edit_comment';
                    include "includes/edit_comment.php";
                    break;


                default:
                    include "includes/view_all_comments.php";
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