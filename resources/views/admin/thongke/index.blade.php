@extends('admin.layouts.master')

@section('content')
  <div class="row project-wrapper">
        <!-- Column for Active Projects -->
        <div class="col-xxl-4 col-xl-6">
            <div class="col-xxl-12 col-xl-12">
                <div class="card card-animate">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Khách hàng mua từ 3 đơn trở lên</h4>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Số đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->order_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div><!-- end col -->
        </div><!-- end col -->

        
        <!-- Column for New Users -->
        <div class="col-xxl-4 col-xl-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                <i data-feather="award" class="text-warning"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-uppercase fw-medium text-muted mb-3">Số người dùng mới</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0">
                                    <span class="counter-value" data-target="{{ $newUsers }}">{{ $newUsers }}</span>
                                </h4>
                            </div>
                            <p class="text-muted mb-0">Người dùng mới trong ngày</p>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->

        <!-- Column for Total Orders -->
        <div class="col-xxl-4 col-xl-12">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                <i data-feather="clock" class="text-info"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-uppercase fw-medium text-muted mb-3">Thống kê đơn hàng</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0">
                                    <span class="counter-value" data-target="{{ $totalOrders }}">{{ $totalOrders }}</span>
                                </h4>
                            </div>
                            <p class="text-muted mb-0">Tổng số đơn hàng</p>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->
    </div><!-- end row -->

    <!-- Revenue Chart -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Doanh thu</h4>
                </div><!-- end card header -->

                <div class="card-body p-0 pb-2">
                    <div>
                        <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' dir="ltr" class="apex-charts"></div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <!-- External JS Files -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- projects js -->
    <script src="assets/js/pages/dashboard-projects.init.js"></script>

    <script>
        // Biểu đồ doanh thu
        var revenueData = @json($revenueData);
        var chartData = revenueData.map(function (item) {
            return { x: item.date, y: item.revenue };
        });

        var options = {
            series: [{
                name: "Doanh thu",
                data: chartData
            }],
            chart: {
                type: 'line',
                height: 350
            },
            xaxis: {
                type: 'category',
                categories: revenueData.map(function (item) { return item.date; }),
            },
            yaxis: {
                title: {
                    text: 'Doanh thu (VNĐ)'
                }
            },
            stroke: {
                curve: 'smooth'
            }
        };

        var chart = new ApexCharts(document.querySelector("#projects-overview-chart"), options);
        chart.render();
    </script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
@endsection
