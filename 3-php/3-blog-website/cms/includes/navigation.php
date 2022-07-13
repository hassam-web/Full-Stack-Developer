<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Blog Site</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("query failed" . mysqli_error($connection));
                    }
                    ?>
                     <?php if ($result->num_rows > 0): ?>
                       <?php while($row = mysqli_fetch_assoc($result)){ ?>     
                            <li>
                                <a href="category.php?cat_id=<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></a>
                            </li>
                       <?php } ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>