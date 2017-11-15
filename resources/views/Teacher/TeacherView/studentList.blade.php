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
                        <div class="ibox-content">


                            <form class="form-inline" style="margin-top:15px;" action="/t_get_student" method="post">
                                <div class="form-group">
                                    <label for="exampleInputName2" style="margin-left: 4px;">班级：</label>
                                    <select name="class_id" class="form-control">
                                        @foreach($classArr as $single)
                                        <option name="class_id" value="{{ $single['class_id'] }}" @if($requestParam['class_id'] == $single['class_id']) selected="selected" @endif>{{ $single['class_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-left: 4px;">确定</button>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>头像</th>
                                        <th>学号</th>
                                        <th>姓名</th>
                                        <th>性别</th>
                                        <th>分数</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($arr as $single)
                                        <tr>
                                            <td><img src="/get_pic/{{$single->pic_id}}" style="width:100%; max-width: 80px;max-height: 80px;"></td>
                                            <td>{{$single->student_number}}</td>
                                            <td>{{$single->name}}</td>
                                            <td>
                                                @if($single->sex == '1')
                                                    男
                                                @else
                                                    女
                                                @endif
                                            </td>
                                            <td>{{ $single->grade }}</td>
                                            <td>
                                                <a href="#make_grade_{{ $single->student_id }}" class="btn btn-outline btn-success" data-toggle="modal">打分</a>
                                                <a href="#edit-form_{{ $single->student_id }}" class="btn btn-outline btn-success" data-toggle="modal">查看得分记录</a>
                                            </td>

                                            <div id="make_grade_{{ $single->student_id }}" class="modal fade" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="m-t-none m-b">打分</h3>
                                                                    <div class="hr-line-dashed"></div>
                                                                    <div class="form-horizontal">
                                                                        <form role="form" class="form-horizontal" action="/t_make_grade" method="post" onsubmit="checkEditStaff(this)">
                                                                            <input type="hidden" name="id" value="{{$single->student_id }}">
                                                                            <div class="form-group">
                                                                                <label class="col-sm-2 control-label">类型</label>
                                                                                <div class="col-sm-10">
                                                                                    {{--gradeConfigArr--}}
                                                                                    <select name="grade" class="form-control">
                                                                                        @foreach($gradeConfigArr as $single)
                                                                                            <option name="type_id" value="{{ $single->type_id }}">{{ $single->type_name }}{{ $single->grade }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-4 col-sm-offset-2">
                                                                                    <button class="btn btn-primary" type="submit">保存</button>
                                                                                    <button class="btn btn-white" data-dismiss="modal" type="button">取消</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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