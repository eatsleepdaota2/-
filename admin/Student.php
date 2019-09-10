<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../styles/com.css" rel="stylesheet" />
<style type="text/css">
table {
	width: 80%;
	margin: 0 auto;
}
</style>
<script src="../scripts/Com.js"></script>
<title>学生信息</title>
<div style='Display:none'>
<?php
  include "../Fun.php";
  include "../IsLogin.php";
?>
</div>
</head>
<body>

<script type="text/javascript">
//选择专业改变班级
function change()
{   
    var bms=document.form1.academy.value;
	if (bms=="") {window.alert("学院名不能为空");
	document.form1.academy.focus();}
    var bm=bms.split("|");//按"|"将bms分成若干子串，并依次存入数组中,bm的长度为"|"的个数+1；
    for(i=0;i<(bm.length-1);i++)    //major1的value值为专业名；
    { 
	with(document.form1.major) 
         {  length = (bm.length-1)+1;
	        options[i+1].value = bm[i]; 	
			 options[i+1].text =bm[i]; 
	      }   
      }
   
}  
function checkmajor()
{
	if (document.form1.major.value=="")
	{
	   alert("请选择专业！");
      document.form1.major.focus();
      return false;
    }
}
</script>
<form method="post" name="form1">
<div align="center">

<font style="font-family:'华文新魏'; font-size:20px"  >学生信息管理</font><br />

    <select name="academy" id="academy" onChange="change()" >
      <option value="" >请选择学院</option>
      <?php 
$sqlx="select distinct academyname from major";
$rs1=mysql_query($sqlx);
$row1=mysql_fetch_assoc($rs1);
//每取出一个专业,就输出其全部班级。
while($row1)
{   $xy=$row1["academyname"];
    $sqlx="select  majorname from major where academyname='$xy'";
	$rs2=mysql_query($sqlx);
	$row2=mysql_fetch_assoc($rs2); 
	$major="";
	while($row2)
	{  $major.=$row2["majorname"]."|";
	   $row2=mysql_fetch_assoc($rs2); 
	}
?>
      <option value="<?php echo $major;?>"><?php echo $row1["academyname"];?></option>
      <?php	
    $row1=mysql_fetch_assoc($rs1);
}
?>
    </select>
    <select name="major" id="major">
      <option value="" >请选择专业</option>
    </select>
    &nbsp;
    <input name="search" type="submit" value="查询" onclick="return checkmajor()"/>
    <br /> 
	<?php //只有按查询按钮或地址栏page有值，才能显示记录。
        if(isset($_REQUEST["search"])|| isset($_REQUEST["page"]))
        { 
		 	$majorname=$_REQUEST["major"];
			$academyname=$_REQUEST["academy"];
			
		
    	}
    ?>
  <table>
    <thead>
		<tr>
			<th width="5%">账号</th>
			<th width="5%">姓名</th>
			<th width="5%">性别</th>
			<th width="15%">出生日期</th>
            <th width="15%">原毕业院校</th>
            <th width="10%">原毕业专业</th>
			<th width="10%">是否应届</th>
			<th width="10%">删除<input type='checkbox' id='CBox' onClick='checkall(this.form)'/></th>
			
      </tr>
    </thead>
<?php 
if(isset($_REQUEST["del"]))//点击删除按钮,删除所选数据并重新加载数据
{
	$id=@$_REQUEST["studentid"];   //$id为数组名
	if(!$id) echo "<script>alert('请至少选择一条记录！');</script>";			
	else{
			$num=count($id);							 //使用count函数取得数组中值的个数
			for($i=0;$i<$num;$i++)						 //使用for循环删除所选数据
			{  $delsql="delete from student where studentid='$id[$i]'";
			   mysql_query($delsql);        
			   // 在删除学号为A的学生时，将同时删除[成绩表]中学号为A的记录。
			   $delsql="delete from score where studentid='$id[$i]'";
			   mysql_query($delsql);           
			}
			echo "<script>alert('删除成功！');</script>";
		} 
	$sql="select * from student where classid='".$_SESSION["classid"]."'";
    if (!isset($_REQUEST["page"])) 
	loadinfo($sql); 
}

if(isset($_REQUEST["search"])|| isset($_REQUEST["page"]))//只有按查询按钮或地址栏page有值，才能显示记录。
 {  
 	
   $sql="select * from studentinfo where major='$majorname'";
		 loadinfo($sql); 
 }

function loadinfo($sqlstr)
{
	$result=mysql_query($sqlstr);
	$total=mysql_num_rows($result);
	if (isset($_REQUEST["search"])) $page=1;     //每次按查询按钮,则从第1页开始显示.
	else $page=isset($_REQUEST['page'])?intval($_REQUEST['page']):1;	//获取地址栏中page的值，不存在则设为1
	
	$num=10;                                     //每页显示15条记录
	$url='Student.php';							 //本页URL
	//页码计算
	$pagenum=ceil($total/$num);				      //获得总页数，ceil()返回不小于 x 的最小整数。
						
	$prepg=$page-1;								  //上一页
	$nextpg=($page==$pagenum? 0: $page+1);		  //下一页
	//limit m,n：从m+1号记录开始，共检索n条
	$new_sql=$sqlstr." limit ".($page-1)*$num.",".$num;	//按每页记录数生成查询语句
	$new_result=mysql_query($new_sql);
	if($new_row=@mysql_fetch_array($new_result))  //数组$new_row的键名可为整数或字段名。
	{   
		//若有查询结果，则以表格形式输出		
		do
		{
			list($garschool,$major,$studentid,$sname,$sex,$current,$birthday)=$new_row;	//数组的键名为从0开始的连续整数。
			echo "<tr>";
			echo "<td width='10%'><a href='Countscore.php?studentid=$studentid'>$studentid</a></td>";			
			echo "<td width='5%'>$sname</td>";
			echo "<td width='5%'>$sex</td>"; 		
			echo "<td width='15%' >$birthday</td>";		
			echo "<td width='15%' >$garschool</td>";		
			echo "<td width='10%'>$major</td>";
			echo "<td width='10%'>$current</td>";				
			echo "<td width='10%'><input type='checkbox' name='studentid' value='$studentid' /></td>";
			echo "</tr>";  
		}while($new_row=mysql_fetch_array($new_result));
			//开始分页导航条代码
		 $pagenav="";
		if($prepg) //如果当前显示第一页，则不会出现 ”上一页“。
			$pagenav.="<a href='$url?page=$prepg'>上一页</a> "; 
		for($i=1;$i<=$pagenum;$i++)//$pagenum为总页数
		{
			if($page==$i)$pagenav.="<b><font color='#FF0000'>$i</font></b>&nbsp;";
			else $pagenav.=" <a href='$url?page=$i'>$i"."&nbsp;</a>"; 
		}
		if($nextpg)//如果当前显示最后一页，则不会出现 ”下一页“。
			$pagenav.=" <a href='$url?page=$nextpg'>下一页</a>"; 
		$pagenav.="&nbsp;&nbsp;共".$pagenum."页";
		//输出分页导航
		echo "<tr> <td colspan='8' align='center'>".$pagenav."</td></tr>";	 
	}
	else echo "<tr> <td colspan='8'  align='center'>暂无记录</td></tr>";		
}


?>
        
</table>
</div>
</form>
</body>
</html>