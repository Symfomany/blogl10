
app.controller('CommentController', function TchatController(
  $scope, $http, $interval, $window) {

  //   angular.element('.slimscroll').bind("scroll", function(e, pos) {
  //     var raw = angular.element('.slimscroll');
  //      console.log('scrolling');
  //      console.log(pos);
  //     //  console.log(raw.scrollTop + raw.offsetHeight);
   //
  //  });

$scope.comments = [];
//initialisation
$scope.take = 2;

/*
* Différence entre 2 tableaux d'objets par leur IDs
* Passer de 90° à 45° sur le CPU
*/
function areDifferentByIds(a, b) {
    var idsA = a.map( function(x){ return x.id; } ).sort();
    var idsB = b.map( function(x){ return x.id; } ).sort();
    return (idsA.join(',') !== idsB.join(',') );
}

$scope.article = $('[data-article]').data('article');

$interval(function(){
  console.log($scope.take);
  $http.get('/comments/' + $scope.article + "/" + $scope.skipe + "/" + $scope.take)
    .then(function(response) {
        if(areDifferentByIds($scope.comments,response.data)){
          $scope.comments = response.data;  //
        }
        //response.data sont les données renvoyées du serveur
  });
}, 2000);

  // ajout d'un tchat
  $scope.next = function(){
    $scope.take += 2;
  };

  $scope.remove = function(comment) {

    $http.get('/comments-remove/' + comment.id)
      .then(function(response) {
    });
  }

  $scope.getNumber = function(num) {
    return _.range(num);
  }

  $scope.moyenne = function(moyenne) {
    var resultat =  _.reduce(moyenne, function(memo, num) {
        return memo + num.note;
    }, 0) / (moyenne.length === 0 ? 1 : moyenne.length);

    return resultat;
  }

  $scope.add = function(){

      if($scope.content.length > 0){
        // $http post me permet de faire une REQUETE en POST
        $http.post('/comment-add/' + $scope.article, // url (uri)
        {
          'content': $scope.content.trim(),
          'note': $scope.note,
          'article_id': $scope.article,
        })
        .then(function(response) {
          $scope.content = '';
          $scope.note = 2;
        });
      }
  }



});
