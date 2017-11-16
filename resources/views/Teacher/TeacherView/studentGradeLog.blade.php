@extends("Teacher.TeacherView.base")
@section("content")
    <div class="wrapper wrapper-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>学生管理</h5>
                        </div>
                        <div>
                            <p>课程：{{ $studentInfo['course_name'] }} | 学生姓名：{{ $studentInfo['student']->name }} | 学号：{{ $studentInfo['student']->student_number }}</p>
                            <img src="/get_pic/{{ $studentInfo['student']->pic_id }}" style="width:100%; max-width: 80px;max-height: 80px;">
                        </div>
                        <div class="ibox-content">
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