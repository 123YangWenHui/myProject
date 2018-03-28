<?php
namespace app\admin\controller;

use app\common\model\Admin;
use think\Controller;

class Login extends Controller
{
    public function login()
    {
        if(request()->isPost()){
        	$res = (new Admin())->login(input('post.'));
        	if ($res['valid']) {
        		$this->success($res['msg'],'Index/index');
        	}else{
        		$this->error($res['msg']);
        	}
        }
    }
    public function index(){
    	return $this->fetch('login');
    }
}
