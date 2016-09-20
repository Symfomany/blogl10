var app = angular.module('app', []); // une app initialisée


// configure l'affichage de nos données de la scope
app.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('#{').endSymbol('}#');
});

app.controller('TchatController', function TchatController(
  $scope, $http, $interval) {


  $scope.titre = "Mon Tchat";


  $scope.messages = [];

  // je charge mes données en JSON avec le module $http

$interval(function(){
  $http.get('/tchat')
    .then(function(response) {
        $scope.messages = response.data;  //
        //response.data sont les données renvoyées du serveur
  });
}, 1000);

  $scope.add = function(){

      $http.post('/tchat-add', {'content' : $scope.content})
      .then(function(response) {

        $scope.messages.push({
          'content' : $scope.content
        });
        $scope.content = '';


      });

  }



});
