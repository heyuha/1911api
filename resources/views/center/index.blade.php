<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<table>
			<tr>
				<td>id</td>
				<td>账号</td>
				<td>操作</td>
			</tr>
			@foreach($reg as $k=>$v)
			<tr>
				<td>{{$v->reg_id}}</td>
				<td>{{$v->reg_name}}</td>
				<td></td>
			</tr>
			@endforeach
		</table>
	</center>
</body>
</html>