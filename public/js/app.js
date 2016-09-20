$(function(){


$.getJSON($('#revenue-chart').data('url'),
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

})
