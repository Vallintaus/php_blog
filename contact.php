<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<?php


if (isset($_POST['submit'])) {

    $to = "jusa.vallintaus@hotmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $message = wordwrap($_POST['message'], 70);
    $header = "FROM: " . $_POST['email'];

    mail($to, $subject, $message, $header);
}
?>

<!-- Page Content -->
<div class="container">


    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" id="message" class="form-control" placeholder="Message" cols="40" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>