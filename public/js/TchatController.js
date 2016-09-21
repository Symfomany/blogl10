var app = angular.module('app', []); // une app initialisée


// configure l'affichage de nos données de la scope
app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('#{').endSymbol('}#');
});

app.controller('TchatController', function TchatController(
  $scope, $http, $interval) {

    // $http: permet d'interroger une URL et de retourner
    // les données en JSON

    // $interval : permet d'executer une fonction à travers
    // un intervale de temps

  $scope.titre = "Mon Tchat";

  $scope.messages = [];

  // je charge mes données en JSON avec le module $http

$interval(function(){
  $http.get('/tchat')
    .then(function(response) {
        $scope.messages = response.data;  //
        //response.data sont les données renvoyées du serveur
  });
}, 500);

  // ajout d'un tchat
  $scope.add = function(){

      if($scope.content.length > 0){
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
