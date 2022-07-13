<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                    $cat_query = "SELECT * FROM categories";
                    $cat_result = mysqli_query($connection,$cat_query);
                    if (!$cat_result) {
                        die('category query failed'.mysqli_error($connection));
                    }

                    // echo "<pre>";
                    // print_r($cat_result->num_rows);
                    // echo "</pre>";
                     ?>
                     <?php if ($cat_result->num_rows > 0): ?>
                        <?php while($cat_row = mysqli_fetch_assoc($cat_result)){ ?>
                             <li><a href="category.php?cat_id=<?php echo $cat_row['cat_id']; ?>"><?php echo $cat_row["cat_title"]; ?></a></li>
                        <?php }  ?>
                     <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <!-- <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div> -->

</div>