@extends("Teacher.TeacherView.base")
@section("content")
    <div class="wrapper wrapper-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>学生管理</h5>
                            <br/>
                            <div>
                                <h6>课程：{{ $studentInfo['course_name'] }} | 学生姓名：{{ $studentInfo['student']->name }} | 学号：{{ $studentInfo['student']->student_number }}</h6>
                                <img src="/get_pic/{{ $studentInfo['student']->pic_id }}" style="width:100%; max-width: 80px;max-height: 80px;">
                            </div>
                        </div>
                        <div class="ibox-content">

                            <form class="form-inline" style="margin-top:15px;" action="/t_s_grade_log" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="student_id" value="{{ $requestParam['student_id'] }}">
                                    <label for="exampleInputName2">时间：</label>
                                    <input name="startDate" value="{{ $requestParam['startDate'] }}" type="text" class="form-control laydate-icon" id="start" placeholder="请选择开始时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                                    <span style="margin: 0 2px;">-</span>
                                    <input name="endDate" value="{{ $requestParam['endDate'] }}" type="text" class="form-control laydate-icon"  id="end" placeholder="请选择结束时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD'})">
                                    <label for="exampleInputName2" style="margin-left: 4px;">类型：</label>
                                    <select name="typeName" class="form-control">
                                        <option name="typeName" value="" @if($requestParam['typeName'] == null) selected="selected" @endif>--</option>
                                        @foreach($types as $single)
                                        <option name="typeName" value="{{ $single->type_name }}" @if($requestParam['typeName'] == $single->type_name) selected="selected" @endif>{{ $single->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 4px;">确定</button>
                            </form>



                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>类型</th>
                                        <th>分数</th>
                                        <th>时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($arr != null )
                                    @foreach($arr as $single)
                                        <tr>
                                            <td>{{ $single->type_name }}</td>
                                            <td>{{ $single->grade }}</td>
                                            <td>{{ $single->create_time }}</td>

                                            {{--<div id="make_grade_{{ $single->student_id }}" class="modal fade" aria-hidden="true">--}}
                                                {{--<div class="modal-dialog">--}}
                                                    {{--<div class="modal-content">--}}
                                                        {{--<div class="modal-body">--}}
                                                            {{--<div class="row">--}}
                                                                {{--<div class="col-sm-12">--}}
                                                                    {{--<h3 class="m-t-none m-b">打分</h3>--}}
                                                                    {{--<div class="hr-line-dashed"></div>--}}
                                                                    {{--<div class="form-horizontal">--}}
                                                                        {{--<form role="form" class="form-horizontal" action="/t_make_grade" method="post" onsubmit="checkEditStaff(this)">--}}
                                                                            {{--<input type="hidden" name="student_id" value="{{$single->student_id }}">--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<label class="col-sm-2 control-label">类型</label>--}}
                                                                                {{--<div class="col-sm-10">--}}
                                                                                    {{--gradeConfigArr--}}
                                                                                    {{--<select name="type_id" class="form-control">--}}
                                                                                        {{--@foreach($gradeConfigArr as $single)--}}
                                                                                            {{--<option name="type_id" value="{{ $single->type_id }}">{{ $single->type_name }}{{ $single->grade }}</option>--}}
                                                                                        {{--@endforeach--}}
                                                                                    {{--</select>--}}
                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="form-group">--}}
                                                                                {{--<div class="col-sm-4 col-sm-offset-2">--}}
                                                                                    {{--<button class="btn btn-primary" type="submit">保存</button>--}}
                                                                                    {{--<button class="btn btn-white" data-dismiss="modal" type="button">取消</button>--}}
                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                        {{--</form>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}



                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



@stop
@section("footer")
@stop