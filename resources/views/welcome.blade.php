@extends('layout')


@section('css')
  @parent
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('js')
  @parent
<script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script type="text/javascript">
$(function () {

  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);

  var PieData;

  // AJAX => Asynchronisation Javascript
  $.getJSON("/categories-stats",
  function(data) { // data est la fonction de retour
    PieData = data; // valeur de retour
    pieChart.Doughnut(data, pieOptions);
    //chargement du plugin Do
  });


  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 2,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };

  $.getJSON("/articles-stats",
  function(data) { // data est la fonction de retour

    //DONUT CHART
   var donut = new Morris.Donut({
     element: 'revenue-chart',
     resize: true,
     colors: ["#3c8dbc", "#f56954", "#00a65a"],
     data: data,
     hideHover: 'auto'
   });

  });


  $.getJSON("/comments-stats",

  function(data) {
      new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: data,
      // The name of the data record attribute that contains x-values.
      xkey: 'year',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      
      labels: ['Value']

    });

  });

});
</script>
@endsection

@section('content')
  <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Articles en ligne</span>
              <span class="info-box-number">{{ $nbArticles }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Catégories remplies</span>
              <span class="info-box-number">{{ $nbCategories }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Medias utilisés</span>
              <span class="info-box-number">{{ $nbMedias }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Commentaires actifs</span>
              <span class="info-box-number">{{ $nbComment }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
  </div>

<div class="row">

  <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Répartition des commentaires</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
  <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Variation des commentaires</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id="myfirstchart" style="height: 250px;"></div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>

  <div class="col-md-6">

  <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Répartition des articles par catégories</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <canvas id="pieChart" style="height: 259px; width: 800px;" height="259" width="519"></canvas>
  </div>
  <!-- /.box-body -->
</div>
</div>

<div class="col-md-6">

<div class="box box-success">
<div class="box-header ui-sortable-handle" style="cursor: move;">
  <i class="fa fa-comments-o"></i>

  <h3 class="box-title">Chat</h3>

</div>
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
  <!-- chat item -->
  <div class="item">
    <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">

    <p class="message">
      <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
        Mike Doe
      </a>
      I would like to meet you to discuss the latest news about
      the arrival of the new theme. They say it is going to be one the
      best themes on the market
    </p>
    <div class="attachment">
      <h4>Attachments:</h4>

      <p class="filename">
        Theme-thumbnail-image.jpg
      </p>

      <div class="pull-right">
        <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
      </div>
    </div>
    <!-- /.attachment -->
  </div>
  <!-- /.item -->
  <!-- chat item -->
  <div class="item">
    <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">

    <p class="message">
      <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
        Alexander Pierce
      </a>
      I would like to meet you to discuss the latest news about
      the arrival of the new theme. They say it is going to be one the
      best themes on the market
    </p>
  </div>
  <!-- /.item -->
  <!-- chat item -->
  <div class="item">
    <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">

    <p class="message">
      <a href="#" class="name">
        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
        Susan Doe
      </a>
      I would like to meet you to discuss the latest news about
      the arrival of the new theme. They say it is going to be one the
      best themes on the market
    </p>
  </div>
  <!-- /.item -->
</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 184.91124260355px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
<!-- /.chat -->
<div class="box-footer">
  <div class="input-gr</div>
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
  <!-- chat item -->
  <div class="item">oup">
    <input class="form-control" placeholder="Type message...">

    <div class="input-group-btn">
      <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
    </div>
  </div>
</div>
</div>
</div>

</div>


@endsection
