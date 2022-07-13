<?php include "includes/admin_header.php"; ?>

<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Panel
                             <?php if (isset($_SESSION['username'])): ?>
                             <small><?php echo strtoupper($_SESSION['username']); ?></small>
                             <?php endif; ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                  <div class="row">
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                 </div>
                                 <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo table_row_count(); ?></div>
                                    <div>Posts</div>
                                 </div>
                              </div>
                           </div>
                           <a href="posts.php">
                              <div class="panel-footer">
                                 <span class="pull-left">View Details</span>
                                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                 <div class="clearfix"></div>
                              </div>
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                 </div>
                                 <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo table_row_count('comments'); ?></div>
                                    <div>Comments</div>
                                 </div>
                              </div>
                           </div>
                           <a href="comments.php">
                              <div class="panel-footer">
                                 <span class="pull-left">View Details</span>
                                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                 <div class="clearfix"></div>
                              </div>
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                 </div>
                                 <div class="col-xs-9 text-right">
                                     
                                    <div class='huge'><?php echo table_row_count('users'); ?></div>
                                    <div> Users</div>
                                 </div>
                              </div>
                           </div>
                           <a href="users.php">
                              <div class="panel-footer">
                                 <span class="pull-left">View Details</span>
                                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                 <div class="clearfix"></div>
                              </div>
                           </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                           <div class="panel-heading">
                              <div class="row">
                                 <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                 </div>
                                 <div class="col-xs-9 text-right">
                                     
                                    <div class='huge'><?php echo table_row_count('categories'); ?></div>
                                    <div>Categories</div>
                                 </div>
                              </div>
                           </div>
                           <a href="categories.php">
                              <div class="panel-footer">
                                 <span class="pull-left">View Details</span>
                                 <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                 <div class="clearfix"></div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- /.row -->

                  <div class="row">
                     <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                  </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>
        google.load("visualization", "1.1", {packages:["bar"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],
                ['Posts' , <?php echo table_row_count(); ?>],
                ['Comments' , <?php echo table_row_count('comments'); ?>],
                ['Users' , <?php echo table_row_count('users'); ?>],
                ['Categories' , <?php echo table_row_count('categories'); ?>]
            ]);

            var options = {
              chart: {
                title: '',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, options);
        }
    </script>
<?php include "includes/admin_footer.php"; ?>