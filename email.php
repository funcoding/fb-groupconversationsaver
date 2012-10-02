<?php
$ch=$_POST['submit'];
if(isset($ch))
{$group=stripslashes($_GET['name']);
$fname=$_POST['data'];
$concat=$group.$fname;
preg_match_all("/[a-zA-Z0-9]/",$concat,$concat1);
$concat2=implode("",$concat1[0]);
$filename2=$concat2.".doc";
$who=$_POST['name1'];
$posted=$_POST['comments'];
$linkk=$_POST['name1link'];
$captionn=$_POST['name1caption'];
$name1n=$_POST['name1name'];
$count=$_POST['count'];
$email=$_POST['useremail'];
$file2=fopen($filename2,"a+");
fwrite($file2,"\n");
fwrite($file2,$who." wrote:"."\n".htmlspecialchars(stripslashes($posted))."\n"."\n");
if($name1n!=NULL)
{fwrite($file2,$name1n."\n");}
if($captionn!=NULL)
{fwrite($file2,$captionn."\n");}
if($linkk!=NULL)
{fwrite($file2,strip_tags($linkk)."\n\n");}

fwrite($file2,"Comments:"."\n"."\n");
for($i=0;$i<=$count;$i++)
{$names=$_POST['name2'.$i];
$comments=$_POST['message2'.$i];
if(isset($_POST['name2'.$i]))
{
fwrite($file2,$names." commented: \n\t".htmlspecialchars(stripslashes($comments)));
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
