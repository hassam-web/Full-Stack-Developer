@extends('admin.layout.app')

@section('content')
         <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome To Dashboard Page
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
                            
                            <div class='huge'>{{ $post_count }}</div>
                            <div>Posts</div>
                         </div>
                      </div>
                   </div>
                   <a href="{{ route('posts') }}">
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
                            <div class='huge'>{{ $comment_count }}</div>
                            <div>Comments</div>
                         </div>
                      </div>
                   </div>
                   <a href="{{ route('comments') }}">
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
                            <div class='huge'>{{ $user_count }}</div>
                            <div> Users</div>
                         </div>
                      </div>
                   </div>
                   <a href="{{ route('users') }}">
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
                            <div class='huge'>{{ $category_count }}</div>
                            <div>Categories</div>
                         </div>
                      </div>
                   </div>
                   <a href="{{ route('categories') }}">
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
             <div id="columnchart_material" style="width: 'auto';height: 500px;"></div>
          </div>

    </div>
@endsection


@section('scripts')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
google.load("visualization", "1.1", { packages: ["bar"] });
google.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Data", "Count"],
    ["Posts", "{{ $post_count }}"],
    ["Categories", "{{ $category_count }}"],
    ["Comments", "{{ $comment_count }}"],
    ["Users", "{{ $user_count }}"],
  ]);
  var options = {
    chart: {
      title: "",
      subtitle: "",
    },
  };
  var chart = new google.charts.Bar(
    document.getElementById("columnchart_material")
  );
  chart.draw(data, options);
}
</script>
@endsection