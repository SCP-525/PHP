<?php
namespace Home\Controller;
use Think\Controller;
class DetailController extends CommonController {

    public function index() {
//  		$cont = '大家好，下面我说一句带有敏感字的话';
//			echo $cont = preg_replace("/(.*)敏感字(.*)/iU","\\1***\\2",$cont);
			
        $id = intval($_GET['id']);
        if(!$id || $id<0) {
            return $this->error("ID不合法");
        }

        $news =  D("News")->find($id);

        if(!$news || $news['status'] != 1) {
            return $this->error("ID不存在或者资讯被关闭");
        }

        $count = intval($news['count']) + 1;
        D('News')->updateCount($id, $count);

        $content = D("NewsContent")->find($id);
        $news['content'] = htmlspecialchars_decode($content['content']);

        $advNews = D("PositionContent")->select(array('status'=>1,'position_id'=>5),2);
        $rankNews = $this->getRank();
		
		
		$tc = D('Tc')->select($id);
//		dump($tc);

        $this->assign('result', array(
            'rankNews' => $rankNews,
            'advNews' => $advNews,
            'catId' => $news['catid'],
			'news' => $news
        ));
		$this->assign('id',$id);
		$this->assign('tc',$tc);
        $this->display("Detail/index");
    }

    public function  view() {	
        if(!getLoginUsername()) {
            $this->error("您没有权限访问该页面");
        }
        $this->index();

    }
	public function tc(){
//		dump($_POST);
	
		if($_POST){
			if( !isset($_POST['content']) || !$_POST['content'] ){
				show(0,'评论内容不能为空');
			}
			
			$username = getLoginReadername();
			$newsId = $_POST['news_id'];
			$userId = D('Home')->getLoginByReaderId($username);
			$data=[
				'reader_id'=>intval($userId['reader_id']),
				'news_id'=>intval($newsId),
				'create_time'=>time(),
				'tc_content'=>$_POST['content']
			];

//			$id = D('Tc')->addContent($data);	

		$tc_key=file_get_contents('tc_key.txt');
    	$arr=explode(' ', $tc_key);
			
			if(!$_SESSION['homeReader']){
				show(0,'请先登录');
			}		
			if(strpos($tc_key, $_POST['content']) !== false ){
				show(0,'有敏感词，请检查');
			}
			$id = D('Tc')->addContent($data);
			if($id){
				show(1,'评论成功');
			}

			show(0,'评论失败');

		}
		else{
			show(0,'没有提交的数据');
		}
	
	}
}