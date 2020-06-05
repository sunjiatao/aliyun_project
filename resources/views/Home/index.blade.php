        @extends('HomePublic.HomeIndex')
        @section('title','前台首页')
        @section('start')
        <style type="text/css"> b.line{display: block;width:100%;height:2px ;border-bottom:2px solid #d2364c;z-index:5;}    
     }</style>
       
        <b class="line"></b>
          <div class="bannerTwo">
                      <!--轮播 -->
            <div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
              <ul class="am-slides">
                @foreach($lunbo as $v)
                <li class="banner2"><a><img style="width: 760px;height: 320px;" title="{{$v->name}}" src="{{$v->pic}}" /></a></li>
               
                @endforeach
              </ul>
            </div>
            <div class="clear"></div> 
          </div>

            <!--侧边导航 -->
            <div id="nav" class="navfull" style="position: static;">
              <div class="area clearfix" style="height: 550px;">
                <div class="category-content" id="guide_2">
                  
                  <div class="category" style="box-shadow:none ;margin-top: 2px; height: 550px;">
                    <ul class="category-list navTwo" id="js_climit_li">
                      @foreach($cates as $v)
                      <li>
                        <div class="category-info">
                          <h3 class="category-name b-category-name"><i><img src="{{$v->img}}"></i><a class="ml-22" title="点心">{{$v->name}}</a></h3>
                          <em>&gt;</em></div>
                        <div class="menu-item menu-in top" >
                          <div class="area-in">
                            
                            <div class="area-bg">
                               
                              <div class="menu-srot">
                               
                                <div class="sort-side">
                                  @foreach($v->suv as $v1)
                                  <dl class="dl-sort">
                                    <dt><span title="">{{$v1->name}}</span></dt>
                                    @foreach($v1->suv as $v2)
                                    <dd><a title="" href="#"><span>{{$v2->name}}</span></a></dd>
                                    @endforeach
                                  </dl>
                                 @endforeach
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      <b class="arrow"></b> 
                      </li>
                      @endforeach
                    
                    </ul>
                  </div>
                </div>

              </div>
            </div>
            <!--导航 -->
            <script type="text/javascript">
              (function() {
                $('.am-slider').flexslider();
              });
              $(document).ready(function() {
                $("li").hover(function() {
                  $(".category-content .category-list li.first .menu-in").css("display", "none");
                  $(".category-content .category-list li.first").removeClass("hover");
                  $(this).addClass("hover");
                  $(this).children("div.menu-in").css("display", "block")
                }, function() {
                  $(this).removeClass("hover")
                  $(this).children("div.menu-in").css("display", "none")
                });
              })
            </script>


          <!--小导航 -->
          <div class="am-g am-g-fixed smallnav">
            <div class="am-u-sm-3">
              <a href="sort.html"><img src="/static/Home/images/navsmall.jpg" />
                <div class="title">商品分类</div>
              </a>
            </div>
            <div class="am-u-sm-3">
              <a href="#"><img src="/static/Home/images/huismall.jpg" />
                <div class="title">大聚惠</div>
              </a>
            </div>
            <div class="am-u-sm-3">
              <a href="#"><img src="/static/Home/images/mansmall.jpg" />
                <div class="title">个人中心</div>
              </a>
            </div>
            <div class="am-u-sm-3">
              <a href="#"><img src="/static/Home/images/moneysmall.jpg" />
                <div class="title">投资理财</div>
              </a>
            </div>
          </div>

          
        <!--各类活动-->
        <div class="row">
          <li><a><img src="/static/Home/images/row1.jpg"/></a></li>
          <li><a><img src="/static/Home/images/row2.jpg"/></a></li>
          <li><a><img src="/static/Home/images/row3.jpg"/></a></li>
          <li><a><img src="/static/Home/images/row4.jpg"/></a></li>
        </div>
        <div class="clear"></div> 
          <!--走马灯 -->

          <div class="marqueenTwo">
            <span class="marqueen-title"><i class="am-icon-volume-up am-icon-fw"></i>商城头条<em class="am-icon-angle-double-right"></em></span>
            <div class="demo">

              <ul>
                @foreach($data as $k=>$v)                                                    
                <li><a target="_blank" href="/gonggao/{{$v->id}}"><span>[公告]</span>{{$v->title}} </a></li>
                @endforeach
            
              </ul>
                       
            </div>
          </div>
          <div class="clear"></div>
        
        </div>
        
        
              
        <script type="text/javascript">
          if ($(window).width() < 640) {
            function autoScroll(obj) {
              $(obj).find("ul").animate({
                marginTop: "-39px"
              }, 500, function() {
                $(this).css({
                  marginTop: "0px"
                }).find("li:first").appendTo(this);
              })
            }
            $(function() {
              setInterval('autoScroll(".demo")', 3000);
            })
          }
        </script>
      </div>
      <div class="shopMainbg">
        <div class="shopMain" id="shopmain">

          <!--热门活动 -->

          <div class="am-container" style="display: none;">
          
                     <div class="sale-mt">
                       <i></i>
                       <em class="sale-title">限时秒杀</em>
                       <div class="s-time" id="countdown">
                          <span class="hh">01</span>
                          <span class="mm">20</span>
                          <span class="ss">59</span>
                       </div>
                    </div>

          
            <div class="am-g am-g-fixed sale">
            <div class="am-u-sm-3 sale-item">
              <div class="s-img">
                <a href="# "><img src="/static/Home/images/sale3.jpg" /></a>
              </div>
                           <div class="s-info">
                               <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                               <div class="s-price">￥<b>9.90</b>
                                  <a class="s-buy" href="#">秒杀</a>
                               </div>                             
                           </div>               
            </div>
            
            <div class="am-u-sm-3 sale-item">
              <div class="s-img">
                <a href="# "><img src="/static/Home/images/sale2.jpg" /></a>
              </div>
                           <div class="s-info">
                               <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                               <div class="s-price">￥<b>9.90</b>
                                  <a class="s-buy" href="#">秒杀</a>
                               </div>                             
                           </div>               
            </div>          
            
            <div class="am-u-sm-3 sale-item">
              <div class="s-img">
                <a href="# "><img src="/static/Home/images/sale1.jpg" /></a>
              </div>
                           <div class="s-info">
                               <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                               <div class="s-price">￥<b>9.90</b>
                                  <a class="s-buy" href="#">秒杀</a>
                               </div>                             
                           </div>               
            </div>
            
            <div class="am-u-sm-3 sale-item">
              <div class="s-img">
                <a href="# "><img src="/static/Home/images/sale2.jpg " /></a>
              </div>
                           <div class="s-info">
                               <a href="#"><p class="s-title">ZEK 原味海苔</p></a>
                               <div class="s-price">￥<b>9.90</b>
                                  <a class="s-buy" href="#">秒杀</a>
                               </div>                             
                           </div>               
            </div>
            
            </div>
                   </div>
          <div class="clear "></div>
          @foreach($cates as $k=>$v)
            <div class="f1">
          <!--甜点-->
          
          <div class="am-container " >
            <div class="shopTitle ">
              <h4 class="floor-title">{{$v->name}}</h4>
              <div class="floor-subtitle"><h3>每一道甜品都有一个故事</h3></div>
              
              <div class="today-brands " style="right:0px ;top:13px;">
                @foreach($v->suv as $vv)
                <a href="">{{$vv->name}}</a>|
               @endforeach
              </div>
              
            </div>
          </div>
          
          <div class="am-g am-g-fixed floodSix ">       
            <div class="am-u-sm-5 am-u-md-3 text-one list">
              <div class="word">
                <a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
                              
              </div>              
              <a href="# ">
                <img src="/static/Home/images/5.jpg" />
                <div class="outer-con ">
                  <div class="title ">
                    零食大礼包开抢啦
                  </div>
                  <div class="sub-title ">
                    当小鱼儿恋上软豆腐
                  </div>
                </div>
              </a>
              <div class="triangle-topright"></div> 
            </div>
            
            @foreach($shop as $sv)
            @foreach($sv as $svv)
            @foreach($v->suv as $vv)
            @if($svv->cid == $vv->id)
            <li>
            <div class="am-u-md-2 am-u-lg-2 text-three">
              <div class="boxLi"></div>
              <div class="outer-con ">
                <div class="title ">
                  {{$svv->sname}}
                </div>                
                <div class="sub-title ">
                  ¥{{$svv->price}}
                </div>
                
              </div>
              <a href="/index/{{$svv->sid}}"><img style="width: 147px;height: 147px;" src="{{$svv->pic}} " /></a>
            </div>
            </li>
            @endif
            @endforeach          
            @endforeach          
            @endforeach          
          </div>

          <div class="clear "></div>
            </div>
         @endforeach


            @endsection