<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 实例 - 基本表单</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<form role="form" action="{{url('/user/regadd')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="name">账号</label>
    <input type="text" class="form-control" name="reg_name" id="name" 
         >
  </div>
  <div class="form-group">
    <label for="name">密码</label>
    <input type="password" class="form-control" name="reg_pwd" id="name" >
  </div>
  
  
  <button type="submit" class="btn btn-default">注册</button>
</form>
  
</body>
</html>