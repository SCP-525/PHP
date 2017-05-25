var detail={
	tc: function() {
		var content= $('textarea[name="content"]').val();
//alert(content)

		var url = "/index.php?m=Home&c=Detail&a=tc";
//    serialize() 可以选择一个或多个表单元素（比如 input 及/或 文本框），或者 form 元素本身。序列化的值可在生成 AJAX 请求时用于 URL 查询字符串中。
		var data = $('#form').serialize();
		
//	console.log(data);
//         执行异步请求  $.post
        $.post(url,data,function(result){
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message, '');
				
//					var div=$(<volist name='tc' id='tc'>
//                  		<h4 style="color: cadetblue;">y：</h4>
//                      	<label class="" id=""style="width:700px;height:40px;outline-style: solid;outline-color: wheat;">nei</label>
//                      	<span class="time" style="margin-top: 25px;">sh</span>     
//                  </volist>);
//             $("#tc_block").append(div);
				
				
			}
            
        },'JSON');
        
       
        
        
        
        
        
		
	}
	
}
