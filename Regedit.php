<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>账号申请</title>
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
<script type="text/javascript">jQuery(".banner").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"fold",  autoPlay:true, autoPage:true, trigger:"click" });</script>


<div class="banner-shadow">\
  <div class="banner">
    <div class="login-aside">
      <div id="o-box-up"></div>
      <div id="o-box-down"  style="table-layout:fixed;">
        <div class="error-box"></div>
        <form class="registerform"action="" method="post">
          <div class="fm-item">
            <label for="logonId" class="form-label">请输入您的身份证号：</label>
            <input type="text" value="" maxlength="100" id="studentid" name="studentid" class="i-text" />
            <div class="ui-form-explain"></div>
          </div>
          <div class="fm-item" align="justify">
            <label for="logonId" class="form-label-1"></label>
            <input type="submit" value="" tabindex="4" id="send-btn" name="send-btn" class="btn-login-3" />
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
    <div class="hd">
      <ul>
      </ul>
    </div>
  </div>
</div>

</body>
</html>
<?PHP
	include "Fun.php";
	if(isset($_POST["send-btn"]))
    {
		$studentid=trim($_POST["studentid"]);
		$pwd=$studentid;
		$sql="select studentid from student where studentid='$studentid'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		if($row)
			echo"<script>alert('该账号已存在，请直接登陆');</script>";
		else
		{
			$conn1=mysqli_connect('localhost','root','12345678','system');  
			$isql="insert into student(studentid,pwd) values($studentid,$pwd)";
			if(mysqli_query($conn1,$isql))
			{
			$sql1="select id from student where studentid='$studentid'";
				$result1=mysql_query($sql1);
				$id=mysql_fetch_assoc($result1);
				echo"<script>alert('注册成功，用户名为$id[id]');</script>";
				echo "<script>location.href='Login.php';</script>";
			}
		}
	}

?>
