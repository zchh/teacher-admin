@extends("User.File.base")
@section("main")
 <div class="col-sm-10">
        <div class="panel panel-default">
             <div class="panel-body">
                 <div class="col-sm-6"><h1>文件库</h1></div>
                 <div class="col-sm-6 ">
                       <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addFile">
                      添加文件
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addFile"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加文件</h4>
                          </div>
                          <div class="modal-body">
                              <p>将会添加到当前文件夹</p>
                              <form action="/user_aFile" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label >文件名</label>
                                          <input type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label >详情</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                         </div>
                                         <div class="form-group">
                                            <select class="form-control">
                                            <option >1</option>
                                            <option selected="selected">2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            </select>
                                         </div>
                                        <button type="submit" class="btn btn-default">添加</button>
                                 </form>
                              
                              
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                     
                     </div>
                 
                 <hr>
                 <table class="table table-hover">
                    <tr>
                          <th>文件名</th>
                          <th>大小</th>
                          <th>创建时间</th>
                          <th>访问权限</th>
                          <th>操作</th>
                    </tr>
                    <tr>
                          <td>文件名</td>
                          <td>大小</td>
                          <td>创建时间</td>
                          <td>访问权限</td>
                          <td>操作</td>
                    </tr>
                  </table>
              </div>
        </div>
</div>

@stop