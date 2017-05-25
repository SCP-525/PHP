<?php
namespace Common\Model;
use Think\Model;

class HomeModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('reader');
	}
	public function getHomeByReadername($readername) {
        $res = $this->_db->where('readername="'.$readername.'"')->find();
        return $res;
    }
	public function getLoginByReaderId($readername){
		 $res = $this->_db->field('reader_id')->where('readername="'.$readername.'"')->find();
		return $res;
	}
	public function getHomeBytc_id($news_id){
		 $res = $this->_db->where('news_id="'.$news_id.'"')->find();
		return $res;
	}
	
    public function getHomeByReaderId($reader_id=0) {
        $res = $this->_db->where('reader_id='.$reader_id)->find();
        return $res;
    }
	 public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['status'] = $status;
        return  $this->_db->where('reader_id='.$id)->save($data); // 根据条件更新记录

    }
	  public function updateByReaderId($id, $data) {

        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return  $this->_db->where('reader_id='.$id)->save($data); // 根据条件更新记录
    }
	 
	 
	public function getReaders() {
        $data = array(
            'status' => array('neq',-1),
        );
        return $this->_db->where($data)->order('reader_id desc')->select();
    }
    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }
	
	
	public function getLastReader() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $data = array(
            'status' => 1,
            'lasttime' => array("gt",$time),
        );

        $res = $this->_db->where($data)->count();
        return $res['tp_count'];
    }


}