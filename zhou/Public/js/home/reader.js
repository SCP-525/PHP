var reader={
	save : function() {
		var reader_email= $('input[name="reader_email"]').val();
//		alert(reader_email);

		var url = "/index.php?c=reader&a=save";
        var data = {'reader_email':reader_email};
        // 执行异步请求  $.post
        $.post(url,data,function(result){
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message, '/index.php?c=reader');
            }

        },'JSON');


	}
}
