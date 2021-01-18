<script>
    new Vue({
        el: '#app',
        data: {
            date: "{{$date}}",
            chart: null,
        },
        methods: {
            getLineGraph() {
                // Ajaxで家計簿データを取得
                fetch('/ajax/kakeibo?date=' + this.date).then(response => response.json()).then(data => {
                    if (this.chart) {
                        // チャートが存在していれば初期化
                        this.chart.destroy();
                    }
                    const groupedDate = _.groupBy(data, 'date');
                    const amounts = _.map(groupedDate, spendMoney => {
                        return _.sumBy(spendMoney, 'money');
                    });
                    const typeDate = _.keys(groupedDate);

                    // 円グラフを描画
                    const ctx = document.getElementById('mycanvas').getContext('2d');
                    this.chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            datasets: [{
                                label: '支出金額',
                                data: amounts,
                                borderColor: 'rgba(0, 128, 2, 1)',
                                fill: false,
                                borderWidth: 3,
                            }],
                            labels: typeDate,
                        },
                        options: {
                            title: {
                                display: true,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        userCallback: function(tick) {
                                            return tick.toString() + '円';
                                        },
                                        userCallback: function(label, index, labels) {
                                            if (Math.floor(label) === label) {
                                                return label;
                                            }
                                        },
                                    }
                                }]
                            },
                        },
                    });
                });
            }
        },
        mounted() {
            this.getLineGraph();
        },
    });
</script>