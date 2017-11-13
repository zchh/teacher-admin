@extends("Teacher.TeacherView.base")
@section("content")
        <div class="wrapper wrapper-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="ibox-content m-b-sm border-bottom" style="background: #fff;">
                            <div class="p-xs" style="padding: 20px 10px;">
                                <h2>欢迎您</h2>
                                <span>xxx</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"><i class="fa fa-flash"></i></span>
                                <h5>今日充电量</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">xxx</h1>
                                <small>单位（度）</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><i class="fa fa-flash"></i></span>
                                <h5>今日充电消费</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">xxxx</h1>
                                <small>单位（元）</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right"><i class="fa fa-archive"></i></span>
                                <h5>账户余额</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">xxx</h1>
                                <small>单位（元）</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div>
                                    <input type="hidden" id="latestMoneyArr" value="xx">
                                    <span class="pull-right text-right">
                                        {#<small>过去一周充电消费最多的员工：<strong>xxxx</strong></small>#}
                                        </span>
                                    <h3 class="font-bold no-margins">
                                        过去一周充电消费走势
                                    </h3>
                                    <small>单位（元）</small>
                                </div>

                                <div class="m-t-sm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="width:100%;height:320px">
                                                <div id="eChart" style="width:100%;height:320px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>员工今日充电消费情况</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>员工姓名</th>
                                            <th>充电量</th>
                                            <th>充电消费</th>
                                            <th>实付金额</th>
                                            <th>充电日期</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>xxx</td>
                                            <td>xxx度 </td>
                                            <td>xxx元</td>
                                            <td>xxx元</td>
                                            <td>xxxx</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{--{{ include('BusinessBundle:Default:bottom.html.twig') }}--}}
            </div>
        </div>


<script src="{{ asset('teacher/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('teacher/js/plugins/echarts/echarts.common.min.js') }}"></script>
{{--<script type="text/javascript">--}}
    {{--var latestMoneyArr = $("#latestMoneyArr").val();--}}
    {{--var dateArr = [];--}}
    {{--var moneyArr = [];--}}
    {{--var latestChargingMoneyArr =  JSON.parse(latestMoneyArr);--}}
    {{--for(var i = latestChargingMoneyArr.length - 1;i >= 0; i--)--}}
    {{--{--}}
        {{--dateArr.push(latestChargingMoneyArr[i].date);--}}
        {{--moneyArr.push(latestChargingMoneyArr[i].chargingMoney);--}}
    {{--}--}}
    {{--// 基于准备好的dom，初始化echarts实例--}}
    {{--var myChart = echarts.init(document.getElementById('eChart'));--}}

    {{--// 指定图表的配置项和数据--}}
    {{--var option = {--}}
        {{--color: ['#03a9f5'],--}}
        {{--grid: {--}}
            {{--left: '0%',--}}
            {{--right: '0.4%',--}}
            {{--bottom: '3%',--}}
            {{--top: '2%',--}}
            {{--containLabel: true--}}
        {{--},--}}
        {{--legend: {--}}
            {{--//data:['销量']--}}
        {{--},--}}
        {{--xAxis: {--}}
            {{--data: dateArr,--}}
            {{--axisLine:{--}}
                {{--lineStyle:{--}}
                    {{--color:'#999',--}}
                {{--}--}}
            {{--}--}}
        {{--},--}}
        {{--yAxis: {--}}
            {{--splitLine:{--}}
                {{--lineStyle:{--}}
                    {{--color:'#eee',--}}
                {{--}--}}
            {{--},--}}
            {{--axisLine:{--}}
                {{--lineStyle:{--}}
                    {{--color:'#999',--}}
                {{--}--}}
            {{--}--}}
        {{--},--}}
        {{--series: [{--}}
            {{--name: '消费金额',--}}
            {{--type: 'bar',--}}
            {{--barWidth: '42%',--}}
            {{--label:  {--}}
                {{--normal: {--}}
                    {{--show: true,--}}
                {{--}--}}
            {{--},--}}
            {{--data:moneyArr,--}}
        {{--}],--}}
        {{--itemStyle: {--}}
            {{--normal: {--}}

                {{--color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{--}}
                    {{--offset: 0,--}}
                    {{--color: 'rgba(26,179,148,0.8)'--}}
                {{--}, {--}}
                    {{--offset: 1,--}}
                    {{--color: 'rgba(3, 169,245, 0.1)'--}}
                {{--}]),--}}
                {{--shadowColor: 'rgba(0, 0, 0, 0.1)',--}}
                {{--shadowBlur: 10--}}
            {{--}--}}
        {{--}--}}
    {{--};--}}
    {{--window.onresize =  myChart.resize;--}}
    {{--// 使用刚指定的配置项和数据显示图表。--}}
    {{--myChart.setOption(option);--}}

    {{--$("#eChart").find("canvas").css('width',$("#eChart").width());--}}

{{--</script>--}}
@stop
@section("footer")
@stop