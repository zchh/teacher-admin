@extends("Teacher.TeacherView.base")
@section("content")
    <div class="wrapper wrapper-content">
        <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div>
                                        <span class="pull-right text-right">
                                        <small>学生姓名：<strong>{{ $baseInfo['studentInfo']->name }}</strong></small>
                                        <br/>
                                        <small>学号：<strong>{{ $baseInfo['studentInfo']->student_number }}</strong></small>
                                        </span>
                        <h3 class="font-bold no-margins">
                            过去15天学生成绩走势（科目：{{ $baseInfo['courseName'] }}）
                        </h3>
                        <input type="hidden" name="arr" value="{{ $arr }}" id="arr">
                        <small>单位（分）</small>
                    </div>

                    <div class="m-t-sm">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <canvas id="lineChart" height="64"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   </div>
    </div>


    <script src="{{ asset('teacher/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('teacher/js/plugins/chartJs/Chart.min.js') }}"></script>
    <script>
        var jsonArr = $("#arr").val();
        var arr =  JSON.parse(jsonArr);
        var periodArr = arr.periodArr;
        var gradeArr = arr.gradeArr;
        $(document).ready(function() {
            var lineData = {
                labels: periodArr,
                datasets: [{
                    label: "充电消费",
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,179,148,0.7)",
                    pointColor: "rgba(26,179,148,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: gradeArr
                }]
            };
            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions)
        });
    </script>


@stop
@section("footer")
@stop