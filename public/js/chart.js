var data = [　　{　　　　 value: 140, 　　　　color: "#F7464A", 　　　　highlight: "#FF5A5E", 　　　　label: "趣味"　　 }, 　　 {　　　　 value: 50, 　　　　color: "#46BFBD", 　　　　highlight: "#5AD3D1", 　　　　label: "食費"　　 }, 　　 {　　　　 value: 100, 　　　　color: "#FDB45C", 　　　　highlight: "#FFC870", 　　　　label: "家賃"　　 }];

var myChart = new Chart(document.getElementById("mycanvas").getContext("2d")).Doughnut(data);