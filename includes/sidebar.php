<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form> <!-- search form -->
        <!-- /.input-group -->
    </div>

    <!-- LOGIN FORM -->
    <?php
    if (!isset($_SESSION['username'])) {
    ?>

        <div class="well">
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
                <div class="input-group">
                    <?php
                    if (isset($_SESSION['login_message'])) {
                        echo '<p>' . $_SESSION['login_message'] . '</p>';
                        unset($_SESSION['login_message']);
                    }
                    ?>
                    <input name="username" type="text" class="form-control" placeholder="Username">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <button name="login" class="btn btn-primary" type="submit">Login</button>
                    </span>
                </div>
            </form> <!-- search form -->
            <!-- /.input-group -->
        </div>
    <?php
    }

    ?>




    <!-- Blog Categories Well -->
    <div class="well">


        <?php

        $query = "SELECT * FROM categories LIMIT 4";
        $select_categories_sidebar = mysqli_query($connection, $query);

        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div> -->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "sidebar_widget.php" ?>

</div>