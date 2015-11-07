<div class="panel panel-default">
  <!-- Default panel contents -->

  <div class="panel-body">
      <h2>热门推荐</h2>
  </div>

  <!-- Table -->
  <table class="table table-hover">
      @foreach($indexData as $data)
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