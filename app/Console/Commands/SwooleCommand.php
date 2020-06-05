<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Service\qrcodeLogin;

class SwooleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole {action=start}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fire();
    }

    public function fire(){
        $action = $this->argument('action');
        switch ($action){
            case 'start':
                $this->start();
                break;
            default:
               break;
        }

    }

    //swoole启动方法
    public function start(){
        (new qrcodeLogin())->start();  //扫码登录 启动
    }



}
