<?php
namespace app\common\model;
use think\Loader;
use think\Model;
class Admin extends Model{
	protected $pk = 'login_id';//主键
	protected $table = 'blog_login';
	public function login($data){
		//执行验证
		$validate = Loader::validate('Admin');
		
		if (!$validate->check($data)) {
			return ['valid' => 0,'msg' => $validate->getError()];
		}
		//比对用户名密码
		$userInfo = $this->where('login_name',$data['login_name'])->where('login_pwd',md5($data['login_pwd']))->find();
		if (!$userInfo) {
			return ['valid' => 0,'msg' => '用户名或密码不正确！'];
		}
		//将用户的信息存到session中
		session('login.login_id',$userInfo['login_id']);
		session('login.login_name',$userInfo['login_name']);
		session('login.login_nickname',$userInfo['login_nickname']);
		return ['valid' => 1,'msg' => '登陆成功！'];
	}
}
