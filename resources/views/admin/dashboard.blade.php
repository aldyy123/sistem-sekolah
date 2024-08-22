@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Dashboard</h1>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Siswa</span>
                        <h4 class="mb-0 font-weight-medium total-student">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Guru</span>
                        <h4 class="mb-0 font-weight-medium total-teacher">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Admin</span>
                        <h4 class="mb-0 font-weight-medium total-admin">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-success text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Total Akun</span>
                        <h4 class="mb-0 font-weight-medium">{{count($users)}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card">
            <div class="body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Statistik Akun</h6>
                    </div>
                    <ul class="nav nav-tabs2">
                        <li class="nav-item"><a class="nav-link active">Bulan</a></li>
                    </ul>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <small>Laporan kenaikan jumlah akun siswa dan guru perbulan</small>
                        <div class="d-flex justify-content-start mt-3">
                            <div class="mr-5">
                                <label class="mb-0">Siswa</label>
                                <h4 class="total-student">0</h4>
                            </div>
                            <div>
                                <label class="mb-0">Guru</label>
                                <h4 class="total-teacher">0</h4>
                            </div>
                        </div>
                        <div id="chart-donut-stats" style="height: 250px"></div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div id="chart-flot-stats" class="flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/bundles/flotscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/jvectormap.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/knob.bundle.js')}}"></script>

<script src="{{asset('assets/js/index4.js')}}"></script>

<script>
    const months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    const teacherStats = months.map(month => [month, 0]);
    const studentStats = months.map(month => [month, 0]);

    const users = {!! json_encode($users) !!};
    let totalAdmin = 0;
    let totalTeacher = 0;
    let totalStudent = 0;

    users.forEach(user => {
        if (user.role === 'ADMIN') {
            totalAdmin++;
            $('.total-admin').html(totalAdmin);
        } else if (user.role === 'TEACHER') {
            totalTeacher++;
            $('.total-teacher').html(totalTeacher);

            const month = parseInt(user.created_at.substr(5, 2));
            if (months.includes(month)) {
                const index = month - 1;
                teacherStats[index][1]++;
            }
        } else if (user.role === 'STUDENT') {
            totalStudent++;
            $('.total-student').html(totalStudent);

            const month = parseInt(user.created_at.substr(5, 2));
            if (months.includes(month)) {
                const index = month - 1;
                studentStats[index][1]++;
            }
        }
    });

    c3.generate({
        bindto: '#chart-donut-stats',
        data: {
            columns: [
                ['data1', totalTeacher],
                ['data2', totalStudent]
            ],
            type: 'donut',
            colors: {
                'data1': '#17C2D7',
                'data2': '#9367B4',
            },
            names: {
                // name of each serie
                'data1': 'Guru',
                'data2': 'Murid'
            }
        },
        axis: {
        },
        legend: {
            show: false,
        },
        padding: {
            bottom: 20,
            top: 0
        },
    });


    $.plot('#chart-flot-stats', [{
            data: teacherStats,
            color: '#17C2D7',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
            }
        },{
            data: studentStats,
            color: '#9367B4',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
            }
        }],
        {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 8
            },
            yaxis: {
                show: true,
                        min: 0,
                        max: 100,
                ticks: [[0,''],[20,'25'],[50,'50'],[75,'75'],[100,'100']],

            },
            xaxis: {
                show: true,
                ticks: [[1, 'JAN'],[2,'FEB'],[3,'MAR'],[4,'APR'],[5,'MEI'],[6, 'JUN'],[7,'JUL'],[8,'AGU'],[9,'SEP'],[10,'OKT'],[11,'NOV'],[12,'DES']],
            }
        });
</script>
@endsection
