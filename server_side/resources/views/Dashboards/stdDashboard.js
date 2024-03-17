// Mock data for pie charts
const course1Data = [30, 70];
const course2Data = [50, 50];
const course3Data = [20, 80];

// Render pie charts
renderPieChart('course1Chart', 'Course 1 Progress', course1Data);
renderPieChart('course2Chart', 'Course 2 Progress', course2Data);
renderPieChart('course3Chart', 'Course 3 Progress', course3Data);

function renderPieChart(canvasId, label, data) {
  const ctx = document.getElementById(canvasId).getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Completed', 'Remaining'],
      datasets: [{
        label: label,
        data: data,
        backgroundColor: [
          'rgba(75, 192, 192, 0.5)',
          'rgba(255, 99, 132, 0.5)'
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
          'rgba(255, 99, 132, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });
}
