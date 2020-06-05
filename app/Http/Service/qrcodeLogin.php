<?php
namespace App\Http\Service;
class qrcodeLogin {
    CONST HOST = '0.0.0.0';
    CONST PORT = 9501;

    public $serv; //websocket 连接
    public $clients = []; //用户连接池

    public function __construct(){
        $this->serv = new \Swoole\WebSocket\Server(self::HOST,self::PORT);
        $this->serv->on('open',[$this,'onOpen']);
        $this->serv->on('message',[$this,'onMessage']);
        $this->serv->on('close',[$this,'onClose']);
    }

    public function onOpen($serv,$request){
        echo "用户-".$request->fd."-已连接".PHP_EOL;
        $url = "http://39.101.137.78/scanLogin/{$request->fd}";
        $push_data = json_encode(['type'=>'url','data'=>$url]);
        $serv->push($request->fd,$push_data);
    }

    public function onMessage($serv,$farme){
      //设置返回的消息
//        echo $farme->data . PHP_EOL;
        $data = explode('|',$farme->data);
//        print_r($data);
        $login_statu = $data[0];  //是否同意登录
        $push_id = $data[1];  //推送的pc端 socket  id
        $push_data = json_encode(['type'=>'login_statu','data'=>$login_statu]);
        $serv->push($push_id,$push_data);

    }

    public function onClose($serv,$fd){
//        echo "客户端断开连接-{$fd}".PHP_EOL;
//        //获取断开连接的名字
//        $close_name = $this->clients['fd'][$fd]['name'];
//        //清除断开连接的用户信息
//        unset($this->clients['fd'][$fd]);
//        foreach($this->clients['fd'] as $i){
//            $serv->push($i['id'],json_encode(["msg"=>"{$close_name}退出群聊"],JSON_UNESCAPED_UNICODE));
//        }
    }

    public function start(){
        $this->serv->start();
        return true;
    }

}
