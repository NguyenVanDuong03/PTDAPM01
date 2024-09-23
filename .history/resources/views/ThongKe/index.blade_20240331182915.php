@extends('layouts.admin')

@section('content')
<div class="col-8 col-md-10 px-5">
    <div>
        <h3>Thông kê</h3>
    </div>
    <div>
        <canvas id="canvas"></canvas>
    </div>
    <div>
        <button id="toggleBtn">Toggle Time Scale</button>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const monthlyData = [1000, 2000, 3000, 4000, 5000, 6000];
        const weeklyData = [200, 300, 400, 500, 600, 700];
        let currentData = monthlyData;
        let currentLabels = ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6'];

        var BarChart = {
            type: 'bar',
            data: {
                labels: currentLabels,
                datasets: [{
                    label: 'Doanh thu',
                    data: currentData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            fontSize: 14,
                            fontColor: '#ff8540'
                        }
                    },
                    x: {
                        ticks: {
                            fontSize: 14,
                            fontColor: '#ff8540'
                        }
                    }
                }
            }
        };

        var ctx = document.getElementById('canvas').getContext('2d');
        var myBarChart = new Chart(ctx, BarChart);

        document.getElementById('toggleBtn').addEventListener('click', function() {
            if (currentData === monthlyData) {
                currentData = weeklyData;
                currentLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'];
            } else {
                currentData = monthlyData;
                currentLabels = ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6'];
            }

            myBarChart.data.datasets[0].data = currentData;
            myBarChart.data.labels = currentLabels;
            myBarChart.update();
        });
    });
</script>
@endsection