<ul class="pager">
    <?php
    if ($page > 1 && $page !== null) {

        $prev_page = $page - 1;

        echo "<li><a href='index.php?page={$prev_page}'><</a></li>";
    }

    for ($i = 1; $i <= $count; $i++) {

        if ($i == $page || ($i == 1 && $page === null)) {

            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
        } else {

            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
    }

    if ($page < $count || $page == null) {

        $next_page = $page + 1;

        echo "<li><a href='index.php?page={$next_page}'>></a></li>";
    }

    ?>


</ul>