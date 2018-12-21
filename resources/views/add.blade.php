<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>

	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<h1>使用form表单 进行post提交</h1>
	<form action="/user/insert" method="post">	
		{{ csrf_field() }}
		用户：　<input type="text" name="uname" value=""><br><br>
		邮箱：　<input type="text" name="email" value=""><br><br>
		<input type="submit" value="提交">
	</form>

	<h1> 使用ajax 进行post提交 </h1>
	<button>点击发送ajax -- post</button>
	<script type="text/javascript">
		$('button').eq(0).click(function(){
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$.post('/user/insert',{},function(data){
				console.log(data);

			},'html');

		})
		

	</script>
</body>
</html>