<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Blog admin</a>
    </div>


    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

        <!-- <li><a href="">Users online: <?php // echo users_online(); 
                                            ?></a></li> -->

        <li><a href="">Users online: <span class="usersonline"></span></a></li>



        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="../profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../index.php"> -- Main page</a>
                </li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>

            </ul>
        </li>
    </ul>