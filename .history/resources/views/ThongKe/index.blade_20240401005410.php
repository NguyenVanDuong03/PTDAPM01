@extends('layouts.admin')

@section('content')
<div class="col-8 col-md-10 px-5">
    <div>
        <h3>Báo cáo thống kê</h3>
    </div>
    <div class="">
        <div class="d-grid gap-3">
            <form id="findInfoWithDate" action="{{route('thongkes.index')}}" method="get">
                <div class="d-flex gap-3">
                    <h5 class="mb-0">Kiểu thống kê</h5>
                    <select name="kieuthongke" id="kieuthongke" class="w-25 border rounded-2 ">
                        <option value="doanhthu" name="">Doanh thu</option>
                        <option value="sokhach">Số khách</option>
                        <option value="tylebanve">Tỷ lệ bán vé</option>
                    </select>
                </div>
                <div class=" row d-flex justify-content-between">
                    @csrf
                    <div class=" col-12 col-md-6 d-flex flex-column gap-2">
                        <label for="start-day">Từ ngày</label>
                        <input type="date" class="py-1 px-2 rounded border" name="start_day" id="start-day">
                    </div>
                    <div class=" col-12 col-md-6  d-flex flex-column gap-2">
                        <label for="end-day">Đến ngày</label>
                        <input value="{{$end_day}}" type="date" class="py-1 px-2 rounded border" name="end_day" id="end-day" onchange="checkAndSubmitForm()">
                    </div>
                </div>
            </form>
        </div>
        <div id="tylebanve" class="mt-5">
            <canvas id="canvas"></canvas>
        </div>
        <div id="sokhach">
            <div class="">
                <h5 class="border border-1 rounded-2 p-3 my-5 w-25 m-auto d-flex flex-column gap-4 fw-normal text-center">
                    Số khách
                    <span>
                        {{$soluong}}
                    </span>

                </h5>
            </div>
        </div>
        <div id="doanhthu">
            <div class="">
                <h5 class="border border-1 rounded-2 p-3 my-5 w-25 m-auto d-flex flex-column gap-4 fw-normal text-center">
                    Doanh thu
                    <span>
                        11112 VNĐ
                    </span>

                </h5>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    const startDayInput = document.getElementById('start-day');
    const endDayInput = document.getElementById('end-day');

    function checkAndSubmitForm() {
        var selectDate = document.getElementById('end-day').value;
        document.getElementById('findInfoWithDate').submit();
    }

    startDayInput.addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDate = new Date(endDayInput.value);

        if (startDate >= endDate) {
            alert('Ngày bắt đầu phải nhỏ hơn ngày kết thúc.');
            this.value = '';
        }
    });

    endDayInput.addEventListener('change', function() {
        const startDate = new Date(startDayInput.value);
        const endDate = new Date(this.value);

        if (startDate >= endDate) {
            alert('Ngày kết thúc phải lớn hơn ngày bắt đầu.');
            this.value = '';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        //
        const valueData = [1000, 2000, 3000, 4000, 5000, 6000];
        const timeData = ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6'];

        var BarChart = {
            type: 'bar',
            data: {
                labels: timeData,
                datasets: [{
                    label: 'Tỷ lệ bán vé',
                    data: valueData,
                    backgroundColor: ['#49E33C', '#FF5733', '#3498DB', '#F1C40F', '#8E44AD',
                        '#16A085'
                    ],
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
                        },
                        title: {
                            display: true,
                            text: 'Số vé',
                            fontSize: 24,
                            fontColor: '#ff8540'
                        },
                    },
                    x: {
                        ticks: {
                            fontSize: 14,
                            fontColor: '#ff8540'
                        },
                        title: {
                            display: true,
                            text: 'Ngày',
                            fontSize: 24,
                            fontColor: '#ff8540'
                        },
                    }
                },
                // Thiết lập chiều rộng của cột
                plugins: {
                    legend: false,
                    tooltip: false,
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                    }
                },
                scales: {
                    x: {
                        barPercentage: 0.8
                    }
                }
            }
        };

        var ctx = document.getElementById('canvas').getContext('2d');
        var myBarChart = new Chart(ctx, BarChart);


        // Hiện thị doanh thu
        const kieuthongkeSelect = document.getElementById('kieuthongke');

        const showDefaultElement = function() {
            const defaultElement = document.getElementById('doanhthu');
            if (defaultElement) {
                defaultElement.style.display = 'block';
            }

            const otherElements = document.querySelectorAll('[id^="tylebanve"], [id^="sokhach"]');
            otherElements.forEach(element => {
                element.style.display = 'none';
            });
        };

        showDefaultElement();

        kieuthongkeSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const selectedElementId = selectedValue.replace(/\s+/g, '-');

            const allElements = document.querySelectorAll(
                '[id^="tylebanve"], [id^="sokhach"], [id^="doanhthu"]');
            allElements.forEach(element => {
                element.style.display = 'none';
            });

            const selectedElement = document.getElementById(selectedElementId);
            if (selectedElement) {
                selectedElement.style.display = 'block';
            }
        });
    });
</script>
@endsection