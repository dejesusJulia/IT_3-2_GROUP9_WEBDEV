// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
// DATE LABELS
var date = new Date();
var month = date.toLocaleString('default', {month:'short'});
var date1 = month + ' 1';
var date2 = month + ' 10';
var date3 = month + ' 20';
var lastDay = new Date(date.getFullYear(), date.getMonth() +1, 0).getDate();
var date4 = month + ' ' + lastDay;


// DATA
var wkOne = document.getElementById('wkOne').value;
var wkTwo = document.getElementById('wkTwo').value;
var wkThree = document.getElementById('wkThree').value;
var wkFour = document.getElementById('wkFour').value;

var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [date1, date2, date3, date4],
    datasets: [{
      label: "Posts",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [wkOne, wkTwo, wkThree, wkFour],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 3
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 30,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
