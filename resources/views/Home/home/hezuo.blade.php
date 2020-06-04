@extends('HomePublic.HomeIndex')
@section('title','友情链接')
@section('start')

<div id="bdwzbkx">
    <center>
    <table width="0" class="ssko" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td width="618"><table width="100%" class="sskoco" border="0" cellspacing="2" cellpadding="0">
		<form name="form1" id="form1" onsubmit="return CheckData(this);" action="/hezuo1" method="post">
          <tbody>
          <tr>
            <td align="right">* 网站名称：</td>
            <td align="left"><input name="name" type="text" size="30" maxlength="50">               <span class="sshui012">( 不能超过10个汉字 ) </span></td>
          </tr>
          <tr>
                  <td height="20" align="right">* 网址：</td>
            <td align="left"><input name="url" type="text" size="40" maxlength="100">              <span class="sshui012"> (不能超过60个字符)</span></td>
          </tr>
         
          
          <tr>
            <td align="right">*联系人：</td>
            <td align="left"><input name="linkman" type="text" maxlength="50"></td>
          </tr>
          <tr>
            <td align="right">* 联系邮箱：</td>
            <td align="left"><input name="email" type="email" maxlength="50">               <span class="sshui012">( 请输入有效的邮件地址，不能超过50个字符) </span></td>
          </tr>
          <tr>
            <td align="right">* 网站简介：</td>
            <td align="left"><textarea name="memo" rows="5" cols="40"></textarea></td>
          </tr>
          <tr>
            <td height="40" align="right">&nbsp;</td>
            <input type="hidden" name="applicant" value="{{session('email')}}">
            {{csrf_field()}}
            <td align="left"><input name="" type="submit" value="提交"> <input name="" type="submit" value="重置">
                    </td>
          </tr>
		  
        </tbody>
        </form>

    </table> 
          </td>
        
      </tr>
    </tbody></table>
    @if(count(session('hezuo')))
    <div id="huifu">{{session('hezuo')}},(点击关闭)</div>
    <style type="text/css">
	#huifu{
		line-height: 40px;width: 200px;height: 40px;background:#E96912;font-family: 微软雅黑;color: #D6C9C9
	}

</style>
@endif
    </center>
    </div>
    <script type="text/javascript">

		$('#huifu').click(function(){
			$(this).hide();
		})
    </script>
@endsection