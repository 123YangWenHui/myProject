<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{
	protected $rule = [
		'login_name' => 'require',
		'login_pwd' => 'require',
		'checkNum'=>'require|captcha'
	];
	protected $message = [
		'login_name.require' => '请输入用户名',
		'login_pwd.require' => '请输入密码',
		'checkNum.require' => '请输入验证码',
		'checkNum.captcha' => '验证码不正确',
	];
}