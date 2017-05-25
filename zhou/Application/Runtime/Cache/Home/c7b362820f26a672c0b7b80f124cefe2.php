<?php if (!defined('THINK_PATH')) exit(); $config = D("Basic")->select(); $navs = D("Menu")->getBarMenus(); $name=getLoginReadername(); $res=D("Home")->getLoginByReaderId($name); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" content="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" content="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/Public/css/home/main.css" type="text/css" />
  <script src="/Public/js/jquery.js"></script>
</head>
<body>
<header id="header" >
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="/">
          <img src="/Public/images/logo.png" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="/" <?php if($result['catId'] == 0): ?>class="curr"<?php endif; ?>>首页</a></li>
        <?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><li><a href="/index.php?c=cat&id=<?php echo ($vo["menu_id"]); ?>" <?php if($vo['menu_id'] == $result['catId']): ?>class="curr"<?php endif; ?>><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>	
		<li>
			<form method="get" style="margin-top:43px;" >	
      			<input style="font: '微软雅黑';color: chocolate;" type="text" class="search_text " name="search" value="<?php echo ($news); ?>" placeholder="搜索"><button class="search_btn" onclick="">站内搜索</button>	
      		</form>	
		</li>
      </ul>
      	
       	    
			<ul class="nav navbar-right top-nav" style="margin-top:32px;">
				<li style="float: left;">
					<a href="/index.php?c=reader&a=login">
						<button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#myModal1"  >
   				 		登录
						</button>
					</a>
				</li>
    			<li style="float: left;">
    				<a href="/index.php?c=reader&a=registe">
						<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"  >
    	 				注册
						</button>
					</a>
    			</li>
			    <li style="float: left;">
			      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?php echo getLoginReadername()?></b><b class="caret"></b></a>
			      <input type="hidden" id='readername' value="<?php echo getLoginReadername()?>" />
			      <ul class="dropdown-menu">
			        <li>
			          <a href="/index.php?c=reader&a=reader&id=<?php echo ($res['reader_id']); ?>"> 个人中心</a>
			        </li>
			       
			        <li class="divider"></li>
			        <li>
			          <a href="/index.php?c=reader&a=loginout"> 退出</a>
			        </li>
			      </ul>
			    </li>
		    </ul>
      	
			     
			     
    </div>
  </div>
</header>
<script src="/Public/js/jquery.js"></script>
<script>
	
	//show()

// if (<?php echo ($homeReader); ?>){
// 	console.log('name',<?php echo ($homeReader); ?>);
// 	$('.btn').hide();
// }
   
   
   	//show()
   	var $readername=$('#readername').val();

   if ($readername){
// 	console.log('name',<?php echo ($homeReader); ?>);
   	$('.btn').hide();
   	
   }
   else{$('.caret').hide();}
</script>
<h2>用户登录</h2>
<div class="container-fluid" style="margin-bottom: 180px;">
	<form method="post"  enctype="multipart/form-data">
  		<div class="form-group">
    		<label>用户名</label>
    		<input type="text" class="form-control" name="readername" id="readername" placeholder="输入用户名">
  		</div>
  		<div class="form-group">
    		<label>密码</label>
    		<input type="password" class="form-control" name="readerpwd" id="readerpwd" placeholder="输入密码">
  		</div>
  		
  		<button type="button" class="btn btn-default" onclick="login.check()">登录</button>
	</form>
</div>


<footer style="margin-top: 200px;">
    <p><a href="#" data-toggle="modal" data-target="#about-modal1">简介</a><i>|</i><a href="#" data-toggle="modal" data-target="#about-modal">公告</a><i>|</i> <a href="#" data-toggle="modal" data-target="#about-modal2">联系我们</a><i>|</i></p>
    <p>Copyright &copy; 2006 - 2017 资讯版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;X市公安局XX分局备案编号：123456789123</p>
    <p class="web"><a href="#"><img src="/Public/images/webLogo.jpg" alt="logo"></a><a href="#"><img src="/Public/images/webLogo.jpg" alt="logo"></a><a href="#"><img src="/Public/images/webLogo.jpg" alt="logo"></a><a href="#"><img src="/Public/images/webLogo.jpg" alt="logo"></a></p>
</footer>
	<!--简介-->
 	<div class="modal fade" id="about-modal1" tabindex="-1" role="dialog" aria-labelledby="modal-label"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                    <h4 class="modal-title" id="modal-label">简介</h4>
                </div>
                <div class="modal-body">
                    <p>资讯网隶属于xxxx科技中心(有限合伙)，是一家从事互联网新闻公司。秉承“开拓、创新、公平、分享”的精神，
                        将致力于为新闻界打造一站式互动品牌。</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">了解了</button>
                </div>
            </div>
        </div>
    </div>
    <!--公告-->
    <div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                    <h4 class="modal-title" id="modal-label">公告</h4>
                </div>
                <div class="modal-body">
                    <p>本站将于2017年5月9日服务器升级</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">了解了</button>
                </div>
            </div>
        </div>
    </div>
    <!--联系我们-->
     <div class="modal fade" id="about-modal2" tabindex="-1" role="dialog" aria-labelledby="modal-label"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                    <h4 class="modal-title" id="modal-label">联系我们</h4>
                </div>
                <div class="modal-body">
                    <p>电话：0889-4578902</p>
                    <p>QQ：4345902</p>
										<p>邮箱：zixun@126.com</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">了解了</button>
                </div>
            </div>
        </div>
    
</body>

<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/bootstrap.min.js"></script>
<script src="/Public/js/dialog/layer.js"></script>
<script src="/Public/js/dialog.js"></script>
<script src="/Public/js/count.js"></script>
<script src="/Public/js/home/common.js"></script>
<script src="/Public/js/home/login.js"></script>
<script src="/Public/js/home/registe.js"></script>
<script src="/Public/js/home/reader.js"></script>
<script src="/Public/js/home/tc.js"></script>
</html>