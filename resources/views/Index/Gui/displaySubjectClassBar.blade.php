<div class="panel panel-default">
  <!-- Default panel contents -->
 
  <div class="panel-body">
      <h2>{{$classData->class_name}}</h2>
    <p>{{$classData->class_intro}}</p>
  </div>

  <!-- Table -->
  <table class="table table-hover">
      @foreach($subjectData as $data)
    <tr>
          <td> 
              <a href="/index_articleDetail/{{$data->article_id}}">
                  {{$data->article_title}}
              </a><small>{{$data->article_create_date}}</small>
          </td>
       
         
      </tr> 
      @endforeach
  </table>
</div>