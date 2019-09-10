<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>青海师范大学研究生预调剂系统</title>
<link href="css/login.css" rel="stylesheet" rev="stylesheet" type="text/css" media="all" />
<link href="css/demo.css" rel="stylesheet" rev="stylesheet" type="text/css" media="all" />
</head>

<body>
<div class="header">
  <h1 class="headerLogo"><a title="预调剂系统" target="_blank"><img alt="logo" src="images/logo1.png"></a></h1>
	<div class="headerNav">
		<a target="_blank" href="http://www.qhnu.edu.cn/">学校官网</a>
		<a target="_blank" href="#">招生简章</a>
		<a target="_blank" href="#">意见反馈</a>
		<a target="_blank" href="#">帮助</a>	
	</div>
</div>

<div class="banner">

<div class="login-aside">
  <div id="o-box-up"></div>
  <div id="o-box-down"  style="table-layout:fixed;">
   <div class="error-box"></div>
   <form class="registerform"action="" method="post">
   <div class="fm-item">
	   <label for="logonId" class="form-label">登录账号：</label>
	   <input type="text" value="" maxlength="100" id="userid" name="userid" placeholder="输入账号" class="i-text">    
       <div class="ui-form-explain"></div>
  </div>
  <div class="fm-item">
	   <label for="logonId" class="form-label">登录密码：</label>
	   <input type="password" value="" placeholder="输入密码" maxlength="100" id="password" name="password" class="i-text" >    
       <div class="ui-form-explain"></div>
  </div>
  <div class="fm-item">
	  <label for="logonId" class="form-label-1">管理员
	  <input type="radio" name="role" value="admin" checked="checked"/>
	  </label>
	  <label for="logonId" class="form-label-1">教师
	  <input type="radio" name="role" value="teacher"/>  
	  </label>
	  <label for="logonId" class="form-label-1">学生
	  <input type="radio" name="role" value="student" /> 
	  </label>
  </div>
  
  <div class="fm-item">
	   <label for="logonId" class="form-label-1">
	   <input type="submit" value="" tabindex="4" id="login-btn" name="login-btn" class="btn-login-1">
	   <input type="submit" value="" tabindex="4" id="reg-btn" name="reg-btn" class="btn-login-2"> 
		   </label>
       <div class="ui-form-explain"></div>
  </div>
  </form>
  
  </div>

</div>

	<div class="bd">
		<ul>
			<li style="background:url(themes/theme2.JPG);background-repeat: no-repeat;background-attachment: fixed"><a target="_blank" ></a></li>
		</ul>
	</div>

	<div class="hd"><ul></ul></div>
</div>
<script type="text/javascript">jQuery(".banner").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"fold",  autoPlay:true, autoPage:true, trigger:"click" });</script>


<div class="banner-shadow"></div>

</body>
</html>
<?php
	session_start();      //启动会话
	session_destroy();	//删除会话所占空间。	
		
	include"Fun.php";//调用Fun.php文件
	if(isset($_POST["login-btn"]))
    {
		 $role=$_POST["role"];          //获取用户类别
		 $userid=trim($_POST["userid"]);//获取用户名
		 $pwd=trim($_POST["password"]); //密码
		 if($role == student)
		 {
			 $sql= "select * from student where id='$userid' and pwd='$pwd'";
			 $result=mysql_query($sql);				 
			 $row=mysql_fetch_array($result);			
			 if($row)  
			 {
				//登陆成功则把用户类别及用户名写入SESSION
				$_SESSION["role"]=$role;
				$_SESSION["userid"]=$userid;
				echo "<script>location.href='Index.php';</script>"; 
			 }
			 else
			 {
				echo "<script>alert('用户名或密码错!');location.href='Login.php';</script>"; 
			 } 		 
		}
		else{
		 $sql= "select * from $role where ".$role."id='$userid' and pwd='$pwd'";
		 $result=mysql_query($sql);				 
		 $row=mysql_fetch_array($result);			
		 if($row)  
		 {
		 	//登陆成功则把用户类别及用户名写入SESSION
			$_SESSION["role"]=$role;
			$_SESSION["userid"]=$userid;
			echo "<script>location.href='Index.php';</script>"; 
		 }
		 else
		 {
			echo "<script>alert('用户名或密码错!');location.href='Login.php';</script>"; 
		 } 
	} 
}
?>