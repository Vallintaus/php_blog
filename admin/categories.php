<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_topbar.php" ?>
    <?php include "includes/admin_sidebar.php" ?>





    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author name</small>
                    </h1>

                    <!-- CREATE CATEGORY -->
                    <div class="col-xs-6">

                        <?php create_new_category(); ?>


                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add category</label>

                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">

                                <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                            </div>


                        </form>


                        <!-- UPDATE CATEGORY -->

                        <?php
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];


                            include "includes/update_categories.php";
                        }
                        ?>
                    </div>


                    <div class="col-xs-6">


                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Category title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <?php find_all_categories() ?>

                                    <!-- DELETE CATEGORY -->
                                    <?php delete_category() ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>