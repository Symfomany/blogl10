@extends('layout')


@section('css')
  @parent
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <style media="screen">
    #repartition{
      width: 350px;
      height: 200px;
    }
  </style>
@endsection

@section('js')
  @parent
{{-- <script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script> --}}
{{-- <script src="http://bouil.github.io/angular-google-chart/ng-google-chart.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-google-chart/0.1.0/ng-google-chart.min.js" type="text/javascript"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script> --}}
<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js" charset="utf-8"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
$(function () {

  $('.slimscroll').slimScroll({
    color: '#000',
    size: '5px',
    height: '350px',
  });

  // var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  // var pieChart = new Chart(pieChartCanvas);

  // var PieData;

  // AJAX => Asynchronisation Javascript
  // $.getJSON("/categories-stats",
  // function(data) { // data est la fonction de retour
  //   PieData = data; // valeur de retour
  //   pieChart.Doughnut(data, pieOptions);
  //   //chargement du plugin Do
  // });


  // var pieOptions = {
  //   //Boolean - Whether we should show a stroke on each segment
  //   segmentShowStroke: true,
  //   //String - The colour of each segment stroke
  //   segmentStrokeColor: "#fff",
  //   //Number - The width of each segment stroke
  //   segmentStrokeWidth: header2,
  //   //Number - The percentage of the chart that we cut out of the middle
  //   percentageInnerCutout: 50, // This is 0 for Pie charts
  //   //Number - Amount of animation steps
  //   animationSteps: 100,
  //   //String - Animation easing effect
  //   animationEasing: "easeOutBounce",
  //   //Boolean - Whether we animate the rotation of the Doughnut
  //   animateRotate: true,
  //   //Boolean - Whether we animate scaling the Doughnut from the centre
  //   animateScale: false,
  //   //Boolean - whether to make the chart responsive to window resizing
  //   responsive: true,
  //   // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  //   maintainAspectRatio: true,
  //   //String - A legend template
  //   legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  // };




  // $.getJSON("/comments-stats",
  //
  // function(data) {
  //     new Morris.Line({
  //     // ID of the element in which to draw the chart.
  //     element: 'myfirstchart',
  //     // Chart data records -- each entry in this array corresponds to a point on
  //     // the chart.
  //     data: data,
  //     // The name of the data record attribute that contains x-values.
  //     xkey: 'year',
  //     // A list of names of data record attributes that contain y-values.
  //     ykeys: ['value'],
  //
  //     labels: ['Value']
  //
  //   });
  //
  // });

});
</script>


<script src="{{ asset('js/TchatController.js') }}"></script>
<script src="{{ asset('js/CommentController.js') }}"></script>
<script src="{{ asset('js/ChartController.js') }}"></script>
<script src="{{ asset('js/VideoController.js') }}"></script>
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

<div class="row" ng-controller="ChartController">

  <div class="col-md-4">
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
            <div  class="box-body chart-responsive">

              <div google-chart chart="chart"
               style="width:300px">
              </div>
{{--
              <div class="chart"
              data-url="{{ route('statsArticles') }}" id="revenue-chart" style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
              </div> --}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
  <div class="col-md-4">
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
              <div google-chart chart="chart2"
                   style="width:300px">
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>

  <div class="col-md-4">

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
</div>

<div class="row">
<div class="col-md-6" ng-controller="CommentController">
  <!-- Box Comment -->
  <div class="box box-widget">
    <div class="box-header with-border">
      <div class="user-block">
        <img class="img-circle" src="{{ $oneArt->image }}" alt="User Image">
        <span class="username"><a href="#">{{ $oneArt->titre }}</a> <span class="text-warning">{!! str_repeat("<span class='fa fa-star'></span>", $oneArt->note) !!}</span></span>
        <span class="description"><b>Catégorie {{ $oneArt->categorie->titre }}</b></span>
        <span class="description">Publié le 16/03/1988 à 20h00</span>
      </div>
      <!-- /.user-block -->
      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
          <i class="fa fa-circle-o"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <!-- post text -->
      <p>
        {{ str_limit($oneArt->description, 500, '...') }}
        <a href="#">Voir plus</a>

      </p>
      <!-- Social sharing buttons -->
      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
      <span class="pull-right text-muted"><b>#{moyenne(comments)}# / 20</b> #{comments.length}# commentaires</span>
    </div>
    <!-- /.box-body -->
    <div class="box-footer box-comments">


      <div class="box-comment" ng-repeat="comment in comments">
        <!-- User image -->
        <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">

        <div class="comment-text">
              <span class="username">
                {{-- {{ title_case($comment->user->prenom) }} {{ title_case($comment->user->nom) }} --}}
                <span class="text-muted pull-right">#{comment.date_created}#  <span class="fa fa-times" ng-click='remove(comment)'></span> </span>
              </span><!-- /.username -->
              <b> #{comment.content}# </b>
              <i ng-repeat="x in getNumber(comment.note)" class="fa fa-star"></i>
              <span class="pull-right small"><i class="fa fa-clock-o"></i> #{comment.created_at|ago}#</span>
        </div>
        <!-- /.comment-text -->
      </div>



    </div>
    <a ng-if="comments.length" ng-click='next()' style="text-align: center;padding-left: 140px;">Voir plus de commentaires</a>

    <!-- /.box-footer -->
    <div class="box-footer">
      <form name="form" data-article="{{ $oneArt->id}}" ng-submit="add()">
        <img class="img-responsive img-circle img-sm" src="http://www.iconpot.com/icon/preview/male-user-avatar.jpg" alt="Alt Text">
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
          <select ng-model="note" class="form-control input-sm">
              <option value="5">Super</option>
              <option value="4">Excellent</option>
              <option value="3">Bien</option>
              <option value="2">Bof</option>
              <option value="1">Null</option>
              <option value="0">NAZ</option>
          </select>
          <input name="message" required pattern="[a-zA-Z0-9\-\ ]{3,10}" ng-model="content" type="text" class="form-control input-sm" placeholder="Press enter to post comment">
          <span class="text-danger" ng-show="form.message.$error.required">Le champs est obligatoire</span>
          <span  class="text-warning" ng-show="form.message.$error.pattern">Le champs est invalide</span>

        </div>
      </form>
    </div>
    <!-- /.box-footer -->
  </div>
  <!-- /.box -->
</div>

<div class="col-md-6" ng-controller="TchatController">

<div class="box box-success">

<div class="box-header ui-sortable-handle" style="cursor: move;">

  <h3 class="box-title">#{ titre }#</h3>

</div>

<div class="box-body" >
  <div class="slimscroll">
      <div ng-repeat="message in messages" style="padding:15px">
        <div class="clear clearfix">
            <i class="fa fa-comment"></i>
            #{message.content}#
          <span class="pull-right">#{message.created_at|ago}#</span>
        </div>
        <hr />
      </div>
  </div>

</div>
</div>
<!-- /.chat -->
<div class="box-footer">
  <div class="input-group"></div>
  <!-- chat item -->
  <div class="item">
    <form ng-submit="add()">
      {{ csrf_field() }}
      <input ng-model="content" class="form-control" placeholder="Type message...">
    </form>
    <button ng-click='next()' type="button" class="btn btn-xs btn-primary">
      Voir les suivants
    </button>
  </div>
</div>
</div>


<div class="col-md-12" ng-controller="VideoController">
  <div class="box row">
  <div class="box-header">
      <h3><i class="fa fa-video-camera"></i> Ma vidéo</h3>
  </div>
  <div class="box-body">
    <div class="row">

      <div class="col-md-6" ng-repeat="data in datas">
        <p class="pull-right"><i ng-click="remove(data)" class="fa fa-times"></i></p>
          <h4>#{data.titre}# <small>#{data.annee}#</small></h4>
          <p>#{data.description}#</p>
          <p><i>#{data.created_at|ago}#</i></p>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe width="560" height="315" src="#{formattage(data.url)}#" frameborder="0" allowfullscreen></iframe>
          </div>
      </div>
    </div>

  </div>
  </div>
  <div class="box row">
  <div class="box-header">
      <h3><i class="fa fa-video-camera"></i> Créer une vidéo</h3>
  </div>
  <div class="box-body">
    <form >
      <input class="form-control" type="text" ng-model="titre" required placeholder="Titre">
      <textarea class="form-control"  ng-model="description" required placeholder="Description.."></textarea>
      <input class="form-control" type="url" ng-model="url" required placeholder="Url: youtube, dailymotion">
      <input class="form-control" type="text" ng-model="annee" required placeholder="Année de sortie">
      <input class="form-control" type="text" ng-model="created_at" required placeholder="Date de sortie">
      <button ng-click="add()" type="submit" class="btn btn-primary" name="button"><i class="fa fa-check"></i>Ajouter la vidéo</button>
    </form>

  </div>
  </div>

</div>
</div>

</div>


@endsection
