<!doctype html>
<html lang="zh-en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/static/Demo/js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="/static/Demo/css/phoneScan.css">
    <title>扫码登录</title>
</head>
<style>


</style>
<body>
<div id="qrcodeLoginDiv" class="qrcodeLoginDiv" style="display: block;">
    <img src="https://www.goeasy.io/images/computer.png">

    <p class="qrcodeLoginDiv-span">是否登录?</p>
    <span class="qrcodeLoginDiv-login" onclick="isLogin('login')">登录</span>
    <span class="qrcodeLoginDiv-nologin" onclick="isLogin('nologin')">取消登录</span>

</div>
</body>
<script>
    var code = {{$code}}
    const ws = new WebSocket('ws:39.101.137.78:9501');
    var isLogin = function(param){
        $('.qrcodeLoginDiv-login').hide()
        $('.qrcodeLoginDiv-nologin').hide()
        if(param == 'login'){
            $('.qrcodeLoginDiv-span').html('登录成功');
            $('#qrcodeLoginDiv img').attr('src','https://www.goeasy.io/images/computer_successful.png')
        }else if(param == 'nologin'){
            $('.qrcodeLoginDiv-span').html('登录被拒绝');
            $('#qrcodeLoginDiv img').attr('src','https://www.goeasy.io/images/computer_failed.png')
        }
        // var data = {"statu":param,"code":code}
        var str = param + '|' + code
        ws.send(str)

    }


</script>
</html>