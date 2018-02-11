<?php
error_reporting(0);
session_start();
if( isset($_SESSION['validated']) )
{
	echo "<script>";
	echo "window.location.href='./'";
	echo "</script>"; 
}
include( '../fenconfig/config.php' );
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Dynamic Player</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> 
<script src="js/jquery-1.6.min.js" type="text/javascript"></script>  
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>  
<script src="js/tms-0.3.js" type="text/javascript"></script>   
<script src="js/tms_presets.js" type="text/javascript"></script>  
<script src="js/jquery.hoverIntent.js" type="text/javascript"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/menu.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/cufon-refresh.js" type="text/javascript"></script>
<script src="js/Kozuka_Gothic_Pro_OpenType_400.font.js" type="text/javascript"></script>    
<script src="js/Kozuka_Gothic_Pro_OpenType_500.font.js" type="text/javascript"></script>    
<script src="js/Kozuka_Gothic_Pro_OpenType_900.font.js" type="text/javascript"></script>       
<script src="js/Kozuka_Gothic_Pro_OpenType_700.font.js" type="text/javascript"></script>     
</head>


<body id="page3">
<header>
	<div class="inner">
    	<div class="container_24">
        	<div class="wrapper">
            	<div class="grid_7 suffix_3">
                	<h1><a href="./">logo</a></h1>
                </div>
                <div class="grid_14"><figure></figure></div>
            </div>
        	<div>
        		<div class="grid_24 z-index">
        			<nav>
            			<ul class="sf-menu">
                			<li class="active sf-first"><a href="./">home</a></li>
                        	<li><a href="../payments.php" target="_blank">donate</a></li>
                        	<li><a href="../" target="_blank">forum</a></li>
                		</ul>
            		</nav>
        		</div>
        		<div class="clear"></div>
   		 	</div>
		</div>
    </div>
</header>


<section id="content">
<div id="leftbar" style="width:160px;float:left;margin-left:25px;">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-3670766974168944";
/* Multi &gt; Leftbar */
google_ad_slot = "2432610960";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<div id="rightbar" style="width:160px;float:right;margin-right:25px;">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-3670766974168944";
/* Multi &gt; Rightbar */
google_ad_slot = "7987879362";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>    

<div class="container_24">
<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-3670766974168944";
/* Multi &gt; Header */
google_ad_slot = "7357321410";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</br>
</br>
</center>

<div class="wrapper">
<div class="grid_24">
<div class="box_5">


<?php
//This data is loaded as soon as the page loads.
$recaptcha = include( '../fenconfig/recaptchalib.php' );
if( $recaptcha == NULL )
{
	echo "<script>";
	echo "window.location.href='/error.html'";
	echo "</script>"; 
}
$validated = false;
$publickey = "6LeHC8YSAAAAAPVAMNOTr3CATiFVJrz0J9oTUR7Z";
$privatekey = "6LeHC8YSAAAAAPSsIj5fTrYQNNRI2jsPJCbK8tdO";

//Once the form is submitted, the new data is loaded so the reCAPTCHA can be verified.
if( $_POST['validate'] === 'yes' )
{
	$resp = recaptcha_check_answer( $privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"] );
	
	if( !$resp->is_valid )
	{
		echo "<span style='color:#FF0000'>The reCAPTCHA wasn't entered correctly. Please try again.</span>";
	}
	else
	{
		$validated = true;
		session_start();
		$_SESSION['validated'] = $validated;
		echo "<script>";
		echo "window.location.href='" . $_SESSION['redirect'] . "'";
		echo "</script>";    
	}
}
?>

<?php
//By default, the form will always be available.
if( !$validated )
{
?>
<br />
Hey there! To continue, all you have to do is pass the reCAPTCHA check below.<br /><br />
<form name="login" method="post">
<?php echo recaptcha_get_html( $publickey, NULL, false ); ?>
</br>
<input type="hidden" name="validate" value="yes" />
<input name="submit" type="submit" value="Submit" />
</form>
<?php
}
?>

<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
</div>
</div>
</div>
</div>
<center>
<br />
<br />
<?php
echo $datetime;
?>
</center>
</section>
<footer>
<div class="container_24">
</div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>