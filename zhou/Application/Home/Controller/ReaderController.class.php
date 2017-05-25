<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class ReaderController extends CommonController {
	  	
	public function login(){
      //		echo "用户名".I("post.Readername");    用来测试
	  	if(session('homeReader')) {
           $this->redirect('/index.php?c=index');
     }
	  	$this->display();
	}
	public function check(){
		$readername = $_POST['readername'];
        $readerpwd = $_POST['readerpwd'];
        if(!trim($readername)) {
            return show(0,'用户名不能为空');
        }
        if(!trim($readerpwd)) {
            return show(0,'密码不能为空');
        }
//大D实例化Model层
        $ret = D('Home')->getHomeByReadername($readername);
        if(!$ret || $ret['status'] !=1) {
            return show(0,'该用户不存在');
    	}

        if($ret['readerpwd'] != getMd5Readerpwd($readerpwd)) {
            return show(0,'密码错误');
        }

		 D("Home")->updateByReaderId($ret['reader_id'],array('lasttime'=>time()));
        session('homeReader', $ret);
        return show(1,'登录成功');
			
	}
	
	public function loginout() {
        session('homeReader', null);
        $this->redirect('/index.php?c=index');
  	}
	
	 public function registe(){
	 	$this->display();
	}
	public function add(){
	 	 if(IS_POST) {

            if(!isset($_POST['readername']) || !$_POST['readername']) {
                return show(0, '用户名不能为空');
            }
            if(!isset($_POST['readerpwd']) || !$_POST['readerpwd']) {
                return show(0, '密码不能为空');
            }
            $_POST['readerpwd'] = getMd5Password($_POST['readerpwd']);
            // 判定用户名是否存在
            $ret = D('Home')->getHomeByReadername($readername);
            if($ret && $ret['status']!=-1) {
                return show(0,'该用户存在');
            }

            // 新增
            $id = D("Home")->insert($_POST);
            if(!$id) {
                return show(0, '新增失败');
            }
            return show(1, '新增成功');
        }
        $this->display();
		
		
	}
	public function reader() {
		$readerId=$_GET['id'];
		
		
		$res=D("Home")->getHomeByReaderId($readerId);
		$this->assign('email',$res);
	
        $this->display();
    }
	public function save() {
        $reader = $this->getLoginReader();
        if(!$reader) {
            return show(0,'用户不存在');
        }

        $data['reader_email'] = $_POST['reader_email'];

        try {
            $reader_id = D("Home")->updateByReaderId($reader['reader_id'], $data);
            if($reader_id === false) {
                return show(0, '配置失败');
            }
            return show(1, '配置成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
		
		
    }
	 
	  	
}
  