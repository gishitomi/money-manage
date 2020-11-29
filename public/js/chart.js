var data = [　　{　　　　 value: 140, 　　　　color: "#F7464A", 　　　　highlight: "#FF5A5E", 　　　　label: "趣味"　　 }, 　　 {　　　　 value: 50, 　　　　color: "#46BFBD", 　　　　highlight: "#5AD3D1", 　　　　label: "食費"　　 }, 　　 {　　　　 value: 100, 　　　　color: "#FDB45C", 　　　　highlight: "#FFC870", 　　　　label: "家賃"　　 }];

var myChart = new Chart(document.getElementById("mycanvas").getContext("2d")).Doughnut(data);

// window.makeChart = function make_chart(labels, data) {
// var ctx = document.getElementById('mycanvas').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'pie',
//     data: {
//         labels: ['食費', '家賃'],
//         datasets: [{
//             label: '学生居場所割合',
//             data: [20, 10],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {}
// });
// }