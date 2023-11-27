    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-file"></i> Posts<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">View Posts</a>
                    </li>
                    <li>
                        <a href="posts.php?source=add_post">Add post</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="./users.php">View users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add user</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
            </li>
            <li class="">
                <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
            </li>
            <li>
                <a href="./profile.php"><i class="fa fa-user"></i> Profile</a>
            </li>

            <li><a href="../index.php">Back to frontpage</a></li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
    </nav>