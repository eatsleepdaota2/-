<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人信息查询</title>
<link href="../styles/com.css" rel="stylesheet" />
<style type="text/css">
#table2 {
	width: 50%;
	margin: 0 auto;
}
</style>
<script src="../scripts/Com.js"></script>
</head>
<body>
<div style="Display:none">
<?php 
	include "../Fun.php";
	include "../IsLogin.php";
    //启动会话
	$userid=$_SESSION["userid"];
	$sql="select * from student where id='$userid'";							
	$result=mysql_query($sql);
    $row=mysql_fetch_array($result);
?>
</div>
<form id="form" name="form" method="post" action="">
<table border="1" cellpadding="4" cellspacing="0" id="table2" bordercolor="#328EBE">
   
        <tr>
          <td height="25" colspan="2" align="center" bgcolor="#328EBE" style="font-family:'华文新魏'; font-size:20px">个人信息填写</td>
        </tr>
        
          <tr>
          <td width="35%" height="25" align="center">姓 名</td>
          <td height="25"><input type="text" name="sname" id="sname" /></td>
        </tr>   
        
         <tr>
          <td width="35%" height="25" align="center">性 别</td>
		  <td height="25" align="center"><input type="text" name="sex" id="sex" "/></td>
        </tr>
        
          <tr>
          <td width="35%" height="25" align="center">民族</td>
          <td height="25" align="center"><input type="text" name="snation" id="snation"/></td>
        </tr>
        
           <tr>
          <td width="35%" height="25" align="center">证 件 号</td>
          <td height="25" align="center"><?php echo $row["studentid"];?></td>
        </tr>
           
		<tr>
          <td width="35%" height="25" align="center">出生日期</td>
          <td height="25" align="center"><input type="text" name="birthday" id="birthday" /></td>
        </tr>
        
		<tr>
          <td width="35%" height="25" align="center">是否应届</td>
          <td height="25" align="center"><input type="text" name="current" id="current" /></td>
        </tr>
		
     
          <tr>
          <td width="35%" height="25" align="center">毕业院校</td>
          <td height="25" align="center"><input type="text" name="graschool" id="graschool" /></td>
        </tr> 
                
        <tr> 
          <td width="35%" height="25" align="center">专业</td>
          <td height="25"><input type="text" name="major" id="major" /></td>
        </tr> 
        
          <tr> 
          <td width="35%" height="25" align="center">院系</td>
          <td height="25"><input type="text" name="academy" id="academy" /></td>
        </tr> 
        
        <tr> 
          <td width="35%" height="25" align="center">数学</td>
          <td height="25"><input type="text" name="math" id="math" /></td>
        </tr> 
        
        <tr> 
          <td width="35%" height="25" align="center">英语</td>
          <td height="25"><input type="text" name="english" id="english" /></td>
        </tr> 
        
        <tr> 
          <td width="35%" height="25" align="center">政治</td>
          <td height="25"><input type="text" name="political" id="political" /></td>
        </tr> 
        
        <tr> 
          <td width="35%" height="25" align="center">专业课1</td>
          <td height="25"><input type="text" name="majorcourses" id="majorcourses" /></td>
        </tr> 
        <tr>
        
        </tr>
          <td colspan="2" align="center"><input type="submit" name="tijiao" value="提交"></td>   
		<tr>
          <td height="25" colspan="2" align="center" bgcolor="#328EBE">&nbsp;</td>
        </tr>

    </table>
    </form>
</body>
</html>
<?php 
	include "../Fun.php";
	include "../IsLogin.php";
	if(isset($_POST["tijiao"]))
    {
	$userid=$_SESSION["userid"];
	$sname=$_POST["sname"]; 
	$sex=$_POST["sex"]; 
	$current=$_POST["current"]; 
	$academy=$_POST["academy"]; 
	$snation=$_POST["snation"]; 
	$birthday=$_POST["birthday"]; 
	$graschool=$_POST["graschool"]; 
	$major=$_POST["major"]; 
	$math=$_POST["math"];
	$english=$_POST["english"];
	$political=$_POST["political"];
	$majorcourses=$_POST["majorcourses"];
	
	
	$conn1=mysqli_connect('localhost','root','12345678','system');         //连接MySQL服务器
  $sql="INSERT INTO student (sname,sex,snation,birthday) values('$sname','$sex','$snation','$birthday')";
  $sql1="INSERT INTO student (graschool,major,sname,sex,current,birthday) values('$graschool','$major','$sname','$sex','$current','$birthday')";
    $sql2="INSERT INTO score (sname,sex,political,math,english,majorcourses,major,academy) values('$sname','$sex','$political','$math','$english','$majorcourses','$major','$academy')";
    if(mysqli_query($conn1,$sql)&&mysqli_query($conn1,$sql1) && mysqli_query($conn1,$sql2)){
    echo "<script language='javascript'> alert('保存成功!');</script>";
	echo "<script>location.href='Index.php';</script>";
	}
	}
?>
