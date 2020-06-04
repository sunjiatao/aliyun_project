@extends('HomePublic.HomeIndex')
@section('title','友情链接')
@section('start')
<div id="div">
	@foreach($data as $k=>$v)
	<div id="div1"><a id="qqq" href="{{$v->url}}" title="{{$v->memo}}">{{$v->name}}</a></div>
	@endforeach
	<div style="clear: both"></div>

</div>
<style type="text/css">
#div{width: 1200px;height: 400px;padding-top: 30px;padding-left: 40px;	}
#div1{width:250px;height: 40px;float: left;line-height: 40px;}
#qqq{text-decoration:none;color: #3B3535;font-size: 20px;}
</style>
@endsection