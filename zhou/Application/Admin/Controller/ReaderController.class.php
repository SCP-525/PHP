<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class ReaderController extends CommonController {


    public function index() {
        $readers = D('Home')->getReaders();
        $this->assign('readers', $readers);
        $this->display();
    }

	public function setStatus() {
        $data = array(
            'reader_id'=>intval($_POST['id']),
            'status' => intval($_POST['status']),
        );
        return parent::setStatus($_POST,'Home');
    }


	public function save() {
        $reader = $this->getLoginReader();
        if(!$reader) {
            return show(0,'用户不存在');
        }

       
        $data['reader_email'] = $_POST['email'];

        try {
            $id = D("Home")->updateByReaderId($reader['reader_id'], $data);
            if($id === false) {
                return show(0, '配置失败');
            }
            return show(1, '配置成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }

}