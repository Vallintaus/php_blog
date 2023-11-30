<?php include "modal.php"; ?>

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
                    <a href="#" id="logoutLink"><i class='fa fa-fw fa-power-off'></i>Log Out</a>
                    <script>
                        // function confirmLogout() {
                        //     var confirmLogout = confirm('Are you sure you want to log out?');
                        //     return confirmLogout;
                        // }

                        $(document).ready(function() {
                            // Click event for the logout link
                            $("#logoutLink").on("click", function(e) {
                                e.preventDefault(); // Prevent the default action (i.e., navigating to the href)

                                // Set dynamic content for logout action
                                $("#myModal .modal-body").html("<h3>Are you sure you want to log out?</h3>");
                                $("#myModal .modal-footer").html('<button type="button" class="btn btn-danger" id="logoutButton">Logout</button>' +
                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');

                                $("#myModal").modal("show");
                            });

                            // Click event for the logout button within the modal
                            $("#myModal").on("click", "#logoutButton", function() {
                                // Perform the logout action
                                window.location.href = '../includes/logout.php';
                            });

                            // Optional: Close modal if cancel button is clicked
                            $("#myModal .btn-default").on("click", function() {
                                $("#myModal").modal("hide");
                            });

                            // Optional: Close modal if close button is clicked
                            $("#myModal .close").on("click", function() {
                                $("#myModal").modal("hide");
                            });
                        });
                    </script>
                </li>

            </ul>
        </li>
    </ul>