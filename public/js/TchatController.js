var app = angular.module('app', ['googlechart']); // une app initialisée


// configure l'affichage de nos données de la scope
app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('#{').endSymbol('}#');
});

//je crée un filtre
app.filter('ago', function(){

        return function(input){
					moment.locale('fr'); // initialize moment en français
					var dateTime = new Date(input);
					dateTime = moment(dateTime).fromNow();
          // fromNow() : transformer en format humains
					return dateTime;
        };
});

app.controller('TchatController', function TchatController(
  $scope, $http, $interval, $window) {




  //   angular.element('.slimscroll').bind("scroll", function(e, pos) {
  //     var raw = angular.element('.slimscroll');
  //      console.log('scrolling');
  //      console.log(pos);
  //     //  console.log(raw.scrollTop + raw.offsetHeight);
   //
  //  });

    // $http: permet d'interroger une URL et de retourner
    // les données en JSON

    // $interval : permet d'executer une fonction à travers
    // un intervale de temps

  $scope.titre = "Mon Tchat";

  $scope.messages = [];

  // je charge mes données en JSON avec le module $http



/*
* Différence entre 2 tableaux d'objets par leur IDs
* Passer de 90° à 45° sur le CPU
*/
function areDifferentByIds(a, b) {
    var idsA = a.map( function(x){ return x.id; } ).sort();
    var idsB = b.map( function(x){ return x.id; } ).sort();
    return (idsA.join(',') !== idsB.join(',') );
}

//initialisation
$scope.skipe = 0;
$scope.take = 5;

// evebnement quand je scroll
$('.slimscroll').scroll(function () {
  console.log($('.slimscroll').scrollTop());
  // il recupere la position depuis top de mon element $('.slimscroll')
  if($('.slimscroll').scrollTop() > 80){
    $scope.take += 5; // augmenter le take de 5
  }
});

$interval(function(){
  $http.get('/tchat/' + $scope.skipe + "/" + $scope.take)
    .then(function(response) {
        if(areDifferentByIds($scope.messages,response.data)){
          $scope.messages = response.data;  //
        }
        //response.data sont les données renvoyées du serveur
  });
}, 500);

  // ajout d'un tchat
  $scope.next = function(){
    $scope.skipe += 5;
  };

  $scope.add = function(){

      if($scope.content != undefined && $scope.content.length > 0){
        // $http post me permet de faire une REQUETE en POST
        $http.post('/tchat-add', // url (uri)
        {'content': $scope.content.trim() })
        // {'content': $scope.content.trim() }
        // content: c'est le name de mon input-group
        // $scope.content: c'est la value de mon input
        // envoies de données

        .then(function(response) {
          $scope.content = '';
        });
      }


  }



});
