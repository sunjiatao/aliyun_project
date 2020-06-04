@extends('HomePublic.HomeIndex')
@section('title','公告')
@section('start')
<!--文章 -->
<div class="am-g am-g-fixed blog-g-fixed bloglist" style="width: 550px;">
  <div class="am-u-md-9">
    <article class="blog-main">
      <h3 class="am-article-title blog-title">
        <a href="#">{{$data->title}}</a>
      </h3>
      <h4 class="am-article-meta blog-meta">2014-06-17 09:52</h4>

      <div class="am-g blog-content">
        <div class="am-u-sm-12">
          {!!$data->descr!!}
          
         
          <div class="Row">
            
            <li><img style="width: 200px;" src="{{$data->thumb}}"/></li>
          </div>
          


        
          
          
          
        

        </div>
  
      </div>

    </article>

      <div>作者:{{$data->editor}}</div>
    <hr class="am-article-divider blog-hr">
    <ul class="am-pagination blog-pagination">
      <li class="am-pagination-prev"><a href="">&laquo; 上一页</a></li>
      <li class="am-pagination-next"><a href="">下一页 &raquo;</a></li>
    </ul>
  </div>

  

</div>
@endsection