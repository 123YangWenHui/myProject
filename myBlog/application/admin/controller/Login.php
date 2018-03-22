<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class Login extends Controller
{
	/**
	 * 登录
	 *   */
    public function login()
    {
// 		$loginName = $_POST['loginName'];//登录名
// 		$loginPwd = md5($_POST['loginPwd']);//密码
    	$loginName = '123';//登录名
    	$loginPwd = 123456;//密码
		$result = Db::name('login')->where('login_name',"$loginName")->where('login_pwd',"$loginPwd")->find();
		if ($result['login_id']) {
			unset($loginPwd);
			session('loginName',"$loginName");
			session('loginNickName',$result['login_nickname']);
			session('loginId',$result['loginId']);
			
			$this->success('登录成功', 'Index/index');
		}else{
			$this->error('登录失败','Login/login');
		}
    }
    /**
     * 注册
     *   */
    public function registered(){
    	$loginName = $_POST['loginName'];//登录名
    	$loginNickName = $_POST['login_nickname'];//用户昵称
    	$loginPwd = md5($_POST['loginPwd']);//密码
    	
    	$data = [
    		'login_name' => "$loginName",
    		'loginNickName' => "$loginNickName",
    		'loginPwd' => "$loginPwd"
    	];
    	
    	$result = Db::name('login')->save($data);
    	
    	if ($result) {
    		$this->success('注册成功', 'Login/login');
    	}else{
    		$this->error('注册失败');
    	}
    }
    /**
     * 退出登录
     *   */
    public function logout(){
    	session('loginName',NULL);
    	session('loginNickName',NULL);
    	
    	$this->success('退出登录成功', 'Login/login');
    }
    /**
     * 更改用户密码
     *   */
    public function updatepwd(){
    	$loginId = $_SESSION['loginId'];
    	
    	$result = Db::name('login')->where('login_id',$loginId)->update(['login_pwd' => $loginId]);
    	if ($result) {
    		return true;
    	}else{
    		return false;
    	}
    }
    /**
     * 用户完善信息
     *   */
    public function addinformation(){
    	$imgname = $_FILES['myfile']['name'];
    	$tmp = $_FILES['myfile']['tmp_name'];
    	$filepath = 'photo/';
    	$userPhone = isset($_POST['userPhone'])?$_POST['userPhone']:null;
    	$userEmail = isset($_POST['userEmail'])?$_POST['userEmail']:null;
    	$userAge = isset($_POST['userAge'])?$_POST['userAge']:null;
    	$userAddress = isset($_POST['userAddress'])?$_POST['userAddress']:null;
    	$userLike = isset($_POST['userLike'])?$_POST['userLike']:null;
    	
    	if(move_uploaded_file($tmp,$filepath.$imgname.".png")){
    		echo "上传成功";
    	}else{
    		echo "上传失败";
    	}
    }
}
