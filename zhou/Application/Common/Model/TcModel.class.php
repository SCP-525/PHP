<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作

 */
class TcModel extends Model {
	private $_db='';
	public function __construct() {
		$this->_db = M('tc');
	
	}
	
	 public function getTc() {
        $data = array(
            'status' => array('neq',-1),
        );
        return $this->_db->where($data)->order('tc_id desc')->select();
    }
	
	public function addContent($data){

		if( !$data || !is_array($data) ){
			return 0;
		}
		
		return $this->_db->add($data);
	}
	
	public function select($id){
		if( !$id || !is_numeric($id) ){
			E('id 不合法');
		}
		$table=['cms_tc'=>'a','cms_reader' =>'b'];
		return M()
					->table($table)
					->where('a.reader_id = b.reader_id and a.news_id='.$id)				
//					->where('news_id='.$id)
					->order('a.tc_id desc')
					->select();
	}
	 public function find($id) {
        return $this->_db->where('tc_id='.$id)->find();
    }
    public function updateTcById($id, $data) {
        if(!$id || !is_numeric($id) ) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        if(isset($data['tc_content']) && $data['tc_content']) {
            $data['tc_content'] = htmlspecialchars($data['tc_content']);
        }

        return $this->_db->where('tc_id='.$id)->save($data);
    }
	
}