app.controller('ChartController', function ChartController($scope, $http, $interval, $window) {
    var chart1 = {};
    var chart2 = {};

    chart1.type = "PieChart";
    chart2.type = "PieChart";


    chart1.options = chart2.options = {
        displayExactValues: true,
        width: 400,
        height: 200,
        is3D: true,
        chartArea: {left:10,top:10,bottom:0,height:"100%"}
    };

      $http.get('/categories-stats').then(function(response){
        chart1.data = response.data;
      });
      $http.get('/comments-stats').then(function(response){
        console.log(response.data);
        chart2.data = response.data;
      });
      $scope.chart = chart1;
      $scope.chart2 = chart2;





});
