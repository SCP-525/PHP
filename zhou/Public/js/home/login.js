var login={
	check : function() {
		// 获取登录页面中的用户名 和 密码
        var readername = $('input[name="readername"]').val();
        var readerpwd = $('input[name="readerpwd"]').val();

        if(!readername) {
            dialog.error('用户名不能为空');
        }
        if(!readerpwd) {
            dialog.error('密码不能为空');
        }
        var url = "/index.php?c=reader&a=check";
        var data = {'readername':readername,'readerpwd':readerpwd};
        // 执行异步请求  $.post
        $.post(url,data,function(result){
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message, '/index.php?c=index');
            }

        },'JSON');

	}
		
	
}
