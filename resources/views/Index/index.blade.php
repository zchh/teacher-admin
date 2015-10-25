@extends("Index.base")

@section("left_nav")
     <div class="col-sm-2">
         <ul class="list-group">
                <li class="list-group-item">
                  <span class="badge">14</span>
                  Cras justo odio
                </li>
                <li class="list-group-item">
                  <span class="badge">14</span>
                  Cras justo odio
                </li>
                <li class="list-group-item">
                  <span class="badge">14</span>
                  Cras justo odio
                </li>
                <li class="list-group-item">
                  <span class="badge">14</span>
                  Cras justo odio
                </li>
              </ul>
     </div>
@stop


@section("main")
     <div class="col-sm-10">
        <div class="col-sm-12 " style="background-color:#58646F;height:100px">
            <div class="col-sm-12" style="height:10px"></div>
            <div class="col-sm-12">
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation" class="active"><a href="#">Home <span class="badge">42</span></a></li>
                    <li role="presentation"><a href="#">Profile</a></li>
                    <li role="presentation"><a href="#">Messages <span class="badge">3</span></a></li>
                </ul>
            </div>
        </div>
        
         <div class="col-sm-2" >
              
        </div>
         
          <div class="col-sm-10">
              <div class="col-sm-12" style="height:10px"></div>
                <div class="col-sm-3">
                  <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                      <h3>Thumbnail label</h3>
                      <p>...</p>
                      <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                  </div>
                </div>
             
              
                <div class="col-sm-3 ">
                  <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                      <h3>Thumbnail label</h3>
                      <p>...</p>
                      <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                  </div>
                </div>
              
              
                <div class="col-sm-3">
                  <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                      <h3>Thumbnail label</h3>
                      <p>...</p>
                      <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                  </div>
                </div>
              
        </div>
     </div>
@stop
