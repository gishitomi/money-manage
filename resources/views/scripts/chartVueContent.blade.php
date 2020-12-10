<script>
    new Vue({
        el: '#app',
        data: {
            date: "{{$date}}",
            chart: null,
        },
        methods: {
            getKakeibo() {
                // Ajaxで家計簿データを取得
                fetch('/ajax/kakeibo?date=' + this.date).then(response => response.json()).then(data => {
                    if (this.chart) {
                         // チャートが存在していれば初期化
                        this.chart.destroy();
                    }
                    const groupedTypes = _.groupBy(data, 'type');
                    const amounts = _.map(groupedTypes, spendMoney => {
                        return _.sumBy(spendMoney, 'money');
                    });
                    const typeNames = _.keys(groupedTypes);

                    // 円グラフを描画
                    const ctx = document.getElementById('mycanvas').getContext('2d');
                    this.chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: amounts,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)',
                                ],
                            }],
                            labels: typeNames,
                        },
                        options: {
                            title: {
                                display: true,
                            },
                        }
                    });
                });
            }
        },
        mounted() {
            this.getKakeibo();
        }
    });
</script>