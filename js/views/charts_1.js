$(function (){
  'use strict';

  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
  var lineChartData = {
    labels : ['January','February','March','April','May','June','July'],
    datasets : [
      {
        label: 'Male',
        backgroundColor : 'rgba(220,220,220,0.2)',
        borderColor : 'rgba(0,204,102,0.2)',
        pointBackgroundColor : 'rgba(220,220,220,1)',
        pointBorderColor : '#fff',
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      },
      {
        label: 'Female',
        backgroundColor : 'rgba(151,187,205,0.2)',
        borderColor : 'rgba(0,153,255,0.2)',
        pointBackgroundColor : 'rgba(151,187,205,1)',
        pointBorderColor : '#red',
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      }
    ]
  }

  var ctx = document.getElementById('canvas-1');
  var chart = new Chart(ctx, {
    type: 'line',
    data: lineChartData,
    options: {
      responsive: true
    }
  });


  
});
