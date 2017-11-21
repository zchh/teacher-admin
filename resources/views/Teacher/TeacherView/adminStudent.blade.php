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
                                    <label for="exampleInputName2" style="margin-left: 4px;">排序：</label>
                                    <select name="order" class="form-control">
                                        <option name="order" value="" @if($requestParam['order'] == null) selected="selected" @endif>--</option>
                                        <option name="order" value="1" @if($requestParam['order'] == 1) selected="selected" @endif>按分数正序</option>
                                        <option name="order" value="2" @if($requestParam['order'] == 2) selected="selected" @endif>按分数倒序</option>
                                        <option name="order" value="3" @if($requestParam['order'] == 3) selected="selected" @endif>按学号正序</option>
                                    </select>
                                    <input name='keywords' value="{{ $requestParam['keywords'] }}" type="text" class="form-control" id="exampleInputEmail2" placeholder="请输入学号或者学生姓名" style="width:320px;margin-left: 4px;">
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
                                        <th>备注</th>
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
                                            <td>{{ $single->remark }}</td>
                                            <td>
                                                <a href="#grade_{{ $single->student_id }}" class="btn btn-outline btn-success" data-toggle="modal">打分</a>
                                                <a href="/t_get_grade_log/{{ $single->student_id }}" class="btn btn-outline btn-success" data-toggle="modal">查看得分记录</a>
                                                <a href="/t_student_grade_trend/{{ $single->student_id }}" class="btn btn-outline btn-success" data-toggle="modal">成绩走势</a>
                                                <a href="#remark_{{ $single->student_id }}" class="btn btn-outline btn-success" data-toggle="modal">备注</a>
                                            </td>

                                            <div id="grade_{{ $single->student_id }}" class="modal fade makeGrade" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="m-t-none m-b">打分</h3>
                                                                    <div class="hr-line-dashed"></div>
                                                                    <div class="form-horizontal">
                                                                        <form role="form" class="form-horizontal" action="/t_make_grade" method="post">
                                                                            <input type="hidden" name="student_id" value="{{$single->student_id }}">
                                                                            <div class="form-group">
                                                                                <label class="col-sm-2 control-label">类型</label>
                                                                                <div class="col-sm-10">
                                                                                    <select name="type_id" class="form-control">
                                                                                        @foreach($gradeConfigArr as $grade)
                                                                                            <option name="type_id" value="{{ $grade->type_id }}">{{ $grade->type_name }}{{ $grade->grade }}</option>
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


                                            <div id="remark_{{$single->student_id}}" class="modal fade makeRemark" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="m-t-none m-b">备注</h3>
                                                                    {{--<p>姓名：{{ $single->name }} | 学号：{{ $single->student_number }}</p>--}}
                                                                    <div class="hr-line-dashed"></div>
                                                                    <div class="form-horizontal">
                                                                        <form role="form" class="form-horizontal" action="/t_make_student_remark" method="post">
                                                                            {{--<input type="hidden" name="student_id" value="{{ $single->student_id }}">--}}
                                                                            <div class="form-group">
                                                                                <label class="col-sm-2 control-label">备注</label>
                                                                                <div class="col-sm-10">
                                                                                    {{--<input type="text" placeholder="请输入备注信息" class="form-control" name="remark" value="{{ $single->remark }}" required>--}}
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
                                <?php echo $arr->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    {{--<script>--}}
        {{--$("#makeGrade").click(function(){--}}
            {{--$("p").hide();--}}
        {{--});--}}

        {{--$("#makeRemark").click(function(){--}}
            {{--$("p").show();--}}
        {{--});--}}
    {{--</script>--}}


@stop
@section("footer")
@stop