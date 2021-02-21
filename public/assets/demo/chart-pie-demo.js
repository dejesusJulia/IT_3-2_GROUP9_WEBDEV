// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var nonAnon = document.getElementById("nonAnon").value;
var anon = document.getElementById("anon").value;
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    // labels: ["Blue", "Red", "Yellow", "Green"],
    // labels: ["Blue", "Yellow"],
    labels: ["Non Anonymous", "Anonymous"],
    datasets: [{
      data: [nonAnon, anon],
      // backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
      backgroundColor: ['#007bff', '#ffc107'],
    }],
  },
});
