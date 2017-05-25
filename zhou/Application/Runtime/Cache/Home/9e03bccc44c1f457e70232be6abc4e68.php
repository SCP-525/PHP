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
	<section>
		<div class="container" style="text-align:center;">
			<h1 style="color:red"><?php echo ($message); ?></h1>
			<h3 id="location" >系统将在<span style="color:red">3</span>秒后自动跳转到首页</h3>
		</div>
	</section>
</body>
<script src="/Public/js/jquery.js"></script>
<script>
  //首页
  var url = "/";
  var time = 3;
  setInterval("refer()",1000);
  function refer() {
	if(time==0) {
	  location.href=url;
	}
	$("#location span").html(time);
	time--;
  }
</script>
</html>