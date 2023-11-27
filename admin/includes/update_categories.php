                        <!-- UPDATE category  -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Edit category</label>


                                <?php
                                // Find all categories

                                if (isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];


                                    $query = "SELECT * FROM categories WHERE cat_id = '$cat_id' ";
                                    $select_categories_id = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                ?>


                                        <input value="<?php if (isset($cat_title)) {
                                                            echo $cat_title;
                                                        }  ?>" class="form-control" type="text" name="cat_title">

                                <?php
                                    }
                                }
                                ?>

                                <?php

                                if (isset($_POST['update'])) {
                                    $update_cat_title = escape($_POST['cat_title']);

                                    $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id =  {$cat_id}";

                                    $update_category = mysqli_query($connection, $query);
                                    if (!$update_category) {
                                        die("Query failed!" . mysqli_error($connection));
                                    } else {
                                        header("Location: categories.php");
                                        exit;
                                    }
                                }

                                ?>

                            </div>
                            <div class="form-group">

                                <input class="btn btn-primary" type="submit" name="update" value="Update category">
                            </div>


                        </form>