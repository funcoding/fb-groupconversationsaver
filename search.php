 <?php

$search=$_GET['q'];
$search=preg_replace("/[^a-zA-Z0-9]/","",$search);

require 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => 'App Id',
  'secret' => 'App Secret',
 ));

//Get User ID
$user = $facebook->getUser();

if($user != 0) {
  try {
    $data = $facebook->api('/me/groups');
        $data2=$facebook->api('/me');
  } catch (Exception $e) {
      $data = NULL; 
	
  
  }
}

//Add code to also request access 
//for the user's email id
if($data == NULL) {$params = array(
  'scope' => 'user_groups ,publish_stream,email,read_stream'
);

$loginUrl = $facebook->getLoginUrl($params);
  header("refresh:0;url=$loginUrl");  //Redirects to login page
  return;
}
$logoutUrl = $facebook->getLogoutUrl(array(
    'next'=>'http://xplorers.host22.com/logout.php'
));
$group=$data['data'];
$uemail=$data2['email'];
$filenam=$data2['id'];


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# conversationsaver: http://ogp.me/ns/fb/conversationsaver#">
  <meta property="fb:app_id"      content="334896846595020" /> 
  <meta property="og:type"        content="conversationsaver:group_post" /> 
  <meta property="og:url"         content="http://xplorers.host22.com" /> 
  <meta property="og:title"       content="Facebook conversation saver" /> 
  <meta property="og:image"       content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" /> 
  <meta property="og:description" content="Extract and Save those specific post from your facebook group wall which you think will be important for future reference" /> 
<title>Conversation Grabber</title>
<script type="text/javascript" src="jquery-1.8.0.js"></script>
<script type="text/javascript">
function showDiv() {
   document.getElementById('Search').style.display = "block";
}
</script>

<style type="text/css">
<!--
body {
	background-color: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: smaller;
	line-height: 1.4;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { 
        padding: 0;
        margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
        margin-top: 0;  
        padding-right: 15px;
        padding-left: 15px; 
}
a img { 
        border: none;
}

a:link {
        color:#414958;
        text-decoration: underline; 
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { 
        text-decoration: none;
}

.container {
        width: 80%;
        max-width: 1260px;
        min-width: 780px;
        background-color: #FFF;
        margin: 0 auto; 
}

.header {
        background-color: #6F7D94;
}

.sidebar1 {
        float: left;
        width: 20%;
        background-color: #93A5C4;
        padding-bottom: 10px;
}
.content {
        padding: 10px 0;
        width: 80%;
        float: left;
}

.content ul, .content ol { 
        padding: 0 15px 15px 40px; 
}

ul.nav {
        list-style: none; 
        border-top: 1px solid #666; 
        margin-bottom: 15px; 
}
ul.nav li {
        border-bottom: 1px solid #666; 
}
ul.nav a, ul.nav a:visited { 
        padding: 5px 5px 5px 15px;
        display: block; 
        text-decoration: none;
        background-color: #8090AB;
        color: #000;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { 
        background-color: #6F7D94;
        color: #FFF;
}

/* ~~ The footer ~~ */
.footer {
        padding: 10px 0;
        background-color: #6F7D94;
        position: relative;
        clear: both; 

.fltrt {  
        float: right;
        margin-left: 8px;
}
.fltlft { 
        float: left;
        margin-right: 8px;
}
.clearfloat {
        clear:both;
        height:0;
        font-size: 1px;
        line-height: 0px;
}
-->
</style><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } 
ul.nav a { zoom: 1; } 
</style>
<![endif]--></head>

<body>

<div class="container">
  <div class="header" style="font-size: 20px; font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
    <header  width="20%" height="90"  style=" background-color: #8090AB; display:block;" />
            
Select Group
  </header>
  <a title="logging out will also log you out from your facebook account" style="color:#006;font-weight:900;font-size:small;float:right; text-decoration:none;"href="<?php echo($logoutUrl); ?>"> Log Out &nbsp;&nbsp; </a>
<a title="Report for bugs,improvements etc" style="color:#006;font-weight:900;font-size:small;float:right; text-decoration:none;" target="_blank" href="https://www.facebook.com/conversationsaver"> Contact Us &nbsp;&nbsp; </a>  
  <a style="color:#006;font-weight:900;font-size:small;float:right; text-decoration:none;" href="https://fbgroupconversationsaver-fbapps.rhcloud.com/">Home&nbsp;&nbsp;&nbsp;</a>
  </div>
  <div class="sidebar1">
    <ul class="nav">
    <?php
	
        for($i=0;$i<count($group);$i++)
{$grou[$i]=array($group[$i]['id'],$group[$i]['name']);
$grsorted[$i]=array(preg_replace('/[^a-zA-Z0-9]/', '',$grou[$i][1]),$grou[$i][1],$grou[$i][0]);}
if(isset($grsorted))
{sort($grsorted);}
else
{echo("No Group Present");}
	
for($i=0;$i<count($group);$i++)
{
?>
    
      <li><a href="https://fbgroupconversationsaver-fbapps.rhcloud.com/?page=0&group=<?php echo($grsorted[$i][2]); ?>&name=<?php 
	  echo($grsorted[$i][1]); ?>"><?php echo($grsorted[$i][1]); ?></a></li>
    <?php
        }

        ?>
      
    </ul>
    
    <p> </p>
    <p></p>
  <!-- end .sidebar1 --></div>
    <?php
        
        $groupp=$_GET['group'];
        
        $groupname=htmlentities($_GET['groupname']);
                
                ?>


    <?php
      $curPage = $_REQUEST["page"];
$offset = $curPage * 800;
$nextPage = $curPage + 1;
if ($curPage > 0) {
  $prevPage = $curPage - 1;
 
} else {
  $prevPage = 0;
 
} 

$t=$offset+800;  
        

	$response = $facebook->api('/'.$groupp.'/feed?limit='.$t.'&offset='.$offset);


	
	?>
    <br>
    <form method="get" action="search.php">

<div id="Search"  style="display:none;"  >
   &nbsp;&nbsp; <input type="text" name="q"/></div>
    

  <div class="fadeOutbox">
    <p>
      <input style="background:transparent;border:none;text-decoration:underline;color:blue; cursor:pointer;" type="button" class="Search" name="search" value="Search Group" onClick="showDiv()" />
    </p>
  </div>

<input type="hidden" name="group" value="<?php echo($groupp) ?>" >
<input type="hidden" name="groupname" value="<?php echo($groupname) ?>" >

</form>  
<script type="text/javascript">
$(".fadeOutbox").click(function () {
   $(this).hide("fast");
});
</script>
<?php if($curPage!=0) {?> 
      <p> <a style="font-weight:800; color:#000;text-decoration:none;"href="
	  https://fbgroupconversationsaver-fbapps.rhcloud.com/search.php?q=<?php echo($search); ?>
	  &page=<?php echo($prevPage);?>&group=<?php echo($groupp); ?>&groupname=<?php 
	  echo($groupname); ?>"><-- Less &nbsp;&nbsp;</a>  <?php } ?>
	<?php
	  if(is_array($response['data'][1]))
	  {?>
      <a style="font-weight:800; float:right;color:#000;text-decoration:none;"href="https://fbgroupconversationsaver-fbapps.rhcloud.com/search.php?q=<?php echo($search); ?>&group=<?php echo($groupp); ?>&groupname=<?php echo($groupname); ?>&page=<?php echo($nextPage);?>">More --></a></p> <?php } ?>  
 <h1>&nbsp;&nbsp;<?php echo(stripslashes($groupname));?></h1>
<div class="content">
  
<?php


foreach($response['data'] as $response1)
{if($response1['likes']['count']>0)
   {
   $likes="[Total likes:".$response1['likes']['count']."]";
   
   }
 else
 {$likes=NULL;}
if(isset($response1['link']))
{$link='</br>'."Link:".$response1['link'].'<br>';
}
else
{$link=NULL;}
if(isset($response1['picture']))
{$picture=$response1['picture'].'<br>';}
else
{$picture=NULL;}
	
	if (preg_match("/\b$search\b/i", $response1['message']) || preg_match("/\b$search\b/i", $response1['from']['name']))
{$check[$i]=$response1['message']; ?>
<form method="post" action="">
<p name="who"><?php echo('<strong>'.$response1['from']['name'].'</strong>'); ?> posted:</p>
    <p name="message1"><?php echo(stripslashes(htmlspecialchars($response1['message']).'&nbsp;'.$likes.'<br>'.
	'<img src="'.$picture.'"/>'.$response1['name']." ".$response1['caption'].$link));  ?>
      <input style="  color:#03F;
    font-weight:bold;
text-decoration: underline;" title="Extract and mail the post" type="submit"  value="Save post" 
        name="submit"/>
    <p>Comments:</p>
<p>
  <?php

if($response1['comments']['data'][0]['from']['name'])
{$i=0;
	foreach($response1['comments']['data'] as $response2)
{$i=$i+1;

echo('<strong>'.$response2['from']['name']." commented: ".'</strong>'.htmlspecialchars($response2['message']).'<br>');
if(isset($response2['likes']))
 {echo("[Likes: ".$response2['likes']."]".'<br>');}
echo('<br>');
?>
  <input type="hidden" value="<?php echo($response2['from']['name']);  ?>" name="name2<?php echo($i); ?>"/>
      <input type="hidden" value="<?php echo(strip_tags(stripslashes(htmlspecialchars($response2['message']))));
          if(isset($response2['likes']))
 {echo(" [Likes: ".$response2['likes']."]");}  ?>" name="message2<?php echo($i); ?>"/>
 <input type="hidden" value="<?php echo($i);  ?>" name="count"/>
<?php

}
echo('<hr>');
$i=$i+1;}
else
{echo("No Comments Yet");
echo('<hr>');}
?>
<input type="hidden" value="<?php echo($response1['from']['name']);  ?>" name="name1"/>
         <input type="hidden" value="<?php echo($picture);  ?>" name="name1pic"/>
         <input type="hidden" value="<?php echo($response1['name'].$response1['caption'].$link);  ?>" name="name1link"/>


      <input type="hidden" value="<?php echo(htmlentities($response1['message'].'<br>'.$likes));  ?>" name="comments"/> 
      <input type="hidden" value="<?php echo($uemail);  ?>" name="useremail"/> 
        <input type="hidden" value="<?php echo($filenam);  ?>" name="data"/>  
 </form>
   

<?php
}
}
?>
</p>

<?php

 foreach($response['data'] as $response3)
{
	
	
	if(isset($response3['comments']['data']))
{
if($response3['likes']['count']>0)
   {
   $likes="[Total likes:".$response3['likes']['count']."]";
   
   }
 else
 {$likes=NULL;}
if(isset($response3['link']))
{$link='</br>'."Link:".$response1['link'].'<br>';
}
else
{$link=NULL;}
if(isset($response1['picture']))
{$picture2=$response1['picture'].'<br>';}
else
{$picture2=NULL;}

foreach($response3['comments']['data'] as $response4)
{if (preg_match("/\b$search\b/i", $response4['message']) || preg_match("/\b$search\b/i", $response4['from']['name']))
{if(!in_array($response3['message'],$check))
{?>
 <form method="post" action="">
	<p name="who"><?php echo('<strong>'.$response3['from']['name'].'</strong>'); ?> posted:</p>
    <p name="message1"><?php echo(stripslashes(htmlspecialchars($response3['message']).'&nbsp;'.$likes.'<br>'.
	'<img src="'.$picture2.'"/>'.$response3['name']." ".$response3['caption'].$link));  ?>
	
<input style="  color:#03F;
    font-weight:bold;
text-decoration: underline;" title="Extract and mail the post" type="submit"  value="Save post"  name="submit"/>
<p>Comments:</p>
<p>
<?php
if($response3['comments']['data'][0]['from']['name'])
{$i=0;
	foreach($response3['comments']['data'] as $response5)
{
echo('<strong>'.$response5['from']['name']." commented: ".'</strong>'.htmlspecialchars($response5['message']).'<br>');
if(isset($response5['likes']))
 {echo("[Likes: ".$response2['likes']."]".'<br>');}
 echo('<br>');
?>
 <input type="hidden" value="<?php echo($response5['from']['name']);  ?>" name="name2<?php echo($i); ?>"/>
      <input type="hidden" value="<?php echo(strip_tags(stripslashes(htmlspecialchars($response5['message']))));
          if(isset($response5['likes']))
 {echo(" [Likes: ".$response5['likes']."]");}  ?>" name="message2<?php echo($i); ?>"/>
 <input type="hidden" value="<?php echo($i);  ?>" name="count"/>

<?php
}
echo('<hr>');
$i=$i+1;
}
else
{echo("No Comments Yet");
echo('<hr>');}
?>
<input type="hidden" value="<?php echo($response3['from']['name']);  ?>" name="name1"/>
         <input type="hidden" value="<?php echo($picture2);  ?>" name="name1pic"/>
         <input type="hidden" value="<?php echo($response3['name'].$response3['caption'].$link);  ?>" name="name1link"/>
      <input type="hidden" value="<?php echo(htmlentities($response3['message'].'<br>'.$likes));  ?>" name="comments"/> 
      <input type="hidden" value="<?php echo($uemail);  ?>" name="useremail"/> 
        <input type="hidden" value="<?php echo($filenam);  ?>" name="data"/>  
       </form> 
<?php

}



break;}
}}}
?>
  
 <?php
if(empty($check))
{
	echo('<p>No matching Results Found. </p>');
}
?>
         </p>
  <!-- end .content --></div>
  <div class="footer">
    <p>&nbsp;</p>
	<p style="color:#ffffff;">&copy; 2012 Facebook Conversation Saver</p>
    <!-- end .footer --></div>
<!-- end .container --></div>
 <?php
$ch=$_POST['submit'];
if(isset($ch))
{$group=stripslashes($_GET['groupname']);
$fname=$_POST['data'];
$concat=$group.$fname;
preg_match_all("/[a-zA-Z0-9]/",$concat,$concat1);
$concat2=implode("",$concat1[0]);
$filename2=$concat2.".doc";
$who=$_POST['name1'];
$picc=$_POST['name1pic'];
$linkk=htmlentities($_POST['name1link']);
$posted=$_POST['comments'];
$count=$_POST['count'];
$email=$_POST['useremail'];
$file2=fopen($filename2,"a+");
fwrite($file2,"\n");
fwrite($file2,$who." wrote:"."\n".htmlspecialchars(stripslashes($posted))."\n"."\n");
fwrite($file2,"Link:".$linkk."\n");

fwrite($file2,"Comments:"."\n"."\n");
for($i=0;$i<=$count;$i++)
{$names=$_POST['name2'.$i];
$comments=$_POST['message2'.$i];
if($_POST['name21']!=NULL)
{
fwrite($file2,$names." commented: \n\t".stripslashes($comments));
fwrite($file2,"\n"."\n");
}

else
{fwrite($file2,"\t No Comments Yet \n \n");
break;}}
fwrite($file2,"------------------------------------------------------------------------");
fclose($file2);
$fileatt = $filename2; 
$fileatt_type = "application/doc"; 
$fileatt_name = $group.".doc"; 

$email_from = "no-reply@fbconversationsaver.com"; 
$email_subject = "fb conversation saver:".$group;  

$email_message .= "Thank you for using Facebook Conversation Saver app. Download the attachment to view the saved post.";


$email_to =  $email; 
$headers = "From: ".$email_from;

$file = fopen($fileatt,'rb'); 
$data = fread($file,filesize($fileatt)); 
fclose($file);

$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

$headers .= "\nMIME-Version: 1.0\n" . 
"Content-Type: multipart/mixed;\n" . 
" boundary=\"{$mime_boundary}\"";

$email_message .= "This is a multi-part message in MIME format.\n\n" . 
"--{$mime_boundary}\n" . 
"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . 
$email_message .= "\n\n";

$data = chunk_split(base64_encode($data));

$email_message .= "--{$mime_boundary}\n" . 
"Content-Type: {$fileatt_type};\n" . 
" name=\"{$fileatt_name}\"\n" . 
//"Content-Disposition: attachment;\n" . 
//" filename=\"{$fileatt_name}\"\n" . 
"Content-Transfer-Encoding: base64\n\n" . 
$data .= "\n\n" . 
"--{$mime_boundary}--\n";

$ok = @mail($email_to, $email_subject, $email_message, $headers);

?>
<script type="text/javascript">
alert("The saved post has been succesfully mailed to your e-mail account.If not found in inbox be sure to check junk mail. ");

</script>
<?php
}
?> 
</body>
</html>
