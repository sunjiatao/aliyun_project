<!doctype html>
<html lang="zh-en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>demo示例</title>
    <link rel="stylesheet" href="/static/Demo/css/demo.css">

    <script src="/static/Demo/js/jquery-1.7.2.min.js"></script>
    <script src="/static/Demo/js/qrcode.min.js"></script>
</head>
<body>
<div class="app">
    <div class="conent-box">
        <div class="demo-title">
            <span>示例</span>
        </div>

        <div class="demo-content">
            <div class="example-box">
                <!-- 扫码登录start -->
                <div  id="demos-scanLogin" class="demo-box" style="cursor:pointer;">
                    <div class="inner-box">
                        <img class="inner-box-sweep-code" style="height:100px;width:100px;" src="/static/Demo/images/scancode.png" alt="websocket扫码登录">
                        <br>
                        <span class="btn-style">扫码登录</span>
                    </div>
                </div>
                <!-- 扫码登录end -->


            </div>
        </div>
    </div>


</div>
<div class="popOutBg"></div>
<div class="z-box">
    <span id="box-close" title="关闭" style="z-index: 999"> x </span>
{{-- 扫码登录start--}}
    <div id="demos-scanLogin-z" style="position: relative;">
        <span class="demos-title">二维码扫码登录</span>
        <div class="scanLogin-box">
            <div class="code">
                <span>请扫描二维码，在手机上确认是否允许登录</span>
                <div class="qrcode-img-box">
                    <div class="qrcode-img-content">
                        <div id="qrcode" class="qrcode">
                        </div>
                    </div>
                </div>
            </div>
            <div class="code-status login-success">
                <div class="login-status">
                    <img src="https://www.goeasy.io/images/qrcode-login-success.png" alt="">
                    <span>登录成功</span>
                    <div class="recode"><a href="javascript:;">再试一次</a></div>
                </div>

            </div>
            <div class="code-status login-error">
                <div class="login-status">
                    <img src="https://www.goeasy.io/images/qrcode-login-failed.png" alt="">
                    <span>登录失败</span>
                    <div class="recode"><a href="javascript:;">再试一次</a></div>
                </div>

            </div>
        </div>
        <img class="left-img" src="https://www.goeasy.io/images/left-new-persion.png" alt="">
        <img class="right-img" src="https://www.goeasy.io/images/right-new-persion.png" alt="">
    </div>
{{--    扫码登录end--}}
</div>

</body>
<script type="text/javascript">
    var qrcode = new QRCode('qrcode', {
        width: 160,
        height: 160
    });
    //关闭
    $('#box-close').click(function(){
        $('.popOutBg').hide();
        $('.z-box').hide();
        qrcode.clear();
    })

    //扫码弹出
    $('#demos-scanLogin').click(function(){

        $('.popOutBg').show();
        $('.z-box').show();
        $('#demos-scanLogin-z').show();
        const ws = new WebSocket('ws://39.101.137.78:9501');
        ws.onopen = function(){
            console.log('服务器已连接');
            //创建用户名

        }
        ws.onmessage = function(evt){
            var obj = JSON.parse(evt.data)
            if(obj.type == 'url'){
                qrcode.makeCode(obj.data);
            }else if(obj.type == 'login_statu'){
                if(obj.data == 'login'){
                    console.log('登录成功')
                    $('.code').hide();
                    $('.login-success').show();
                }else{
                    console.log('登录失败')
                    $('.code').hide();
                    $('.login-error').show();

                }
            }

        }

        $('.recode').click(function(){
            $('.code-status').hide();
            $('.code').show();
        })
    })


</script>
</html>