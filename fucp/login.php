<?php
error_reporting(0);
session_start();
if( isset($_SESSION['username']) )
{
	echo "<script>";
	echo "window.location.href='index.php'";
	echo "</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy User Control Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="" />
<meta name="keywords" content="" />

    <meta charset="utf-8">
    <link rel="stylesheet" href="css/ui.totop.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/easyTooltip.js"></script>
    <script type="text/javascript" src="js/FF-cash.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script>
    	$(
			function()
			{
				$(".social a").easyTooltip();
			}
		)
		$(window).load
		(
			function()
			{
				$().UItoTop( {easingType: 'easeOutQuart'} );
			}
		)
    </script>
</head>
<body>

<!--==============================header=================================-->
<div class="block1">
	<div class="main">
    	<header>
            <h1><a class="logo" href="index.html">Fantasy</a>
            	<span>User Control Panel</span>
            </h1>
            <nav>
<div class="clear"></div>
            </nav>
        </header>	
    </div>
</div>	
<div class="block2 bg_fff">
    <!--==============================content================================-->
    <div class="main">
        <section id="content">
            <div class="container_24">
                <div class="wrapper indent1">
                    <article class="grid_24">
<?php
//This data is loaded as soon as the page loads.
$fenconfig = include( '../fenconfig/config.php' );
if( $fenconfig == NULL )
{
	echo "<script>";
	echo "window.location.href='/error.html'";
	echo "</script>";
}
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

//Once the form is submitted, the new data is loaded so the login can be verified.
if( $_POST['validate'] === 'yes' )
{
	$resp = recaptcha_check_answer( $privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"] );
	
	if( !$resp->is_valid )
	{
		echo "<span style='color:#FF0000'>The reCAPTCHA wasn't entered correctly. Please try again.</span>";
	}
	else
	{
		$forumconnect = mysql_connect( $forumserver, $forumuser, $forumpass );
		if( !$forumconnect )
		{
			mysql_close();
			echo "<script>";
			echo "window.location.href='/error.html'";
			echo "</script>";
		}
		
		$username = trim( preg_replace("/[^a-zA-Z0-9]/", "", $_POST['username']) );
		$password = trim( preg_replace("/[^a-zA-Z0-9]/", "", $_POST['password']) );
		
		$resalt = mysql_query( "SELECT salt FROM forum.vb_user WHERE username = '$username'" );
		$array = mysql_fetch_array( $resalt );
		$salt = $array['salt'];
		
		$password = md5( md5($password) . $salt );
		$result = mysql_query( "SELECT * FROM forum.vb_user WHERE username = '$username' AND password = '$password'" );
		$count = mysql_num_rows( $result );
		
		if( $count == 1 )
		{
			$validated = true;
			session_start();
			$_SESSION['username'] = $username;
			mysql_close();
			echo "<script>";
			echo "window.location.href='index.php'";
			echo "</script>"; 
		}
		else
		{
			echo "<span style='color:#FF0000'>Invalid Username or Password. Please try again.</span>";
			mysql_close();
		}
	}
}
?>

<?php
//By default, the form will always be available.
if( !$validated )
{
?>
<br />
Please login using your Fantasy account.<br /><br />
<form name="login" method="post">
  <table>
    	<tr>
        	<td align="right" valign="baseline"><strong>Username:&nbsp;&nbsp;</strong></td>
            <td align="left" valign="baseline"><input name="username" id="username" type="text"/></td>
        </tr>
        
        <tr>
        	<td align="right" valign="baseline"><strong>Password:&nbsp;&nbsp;</strong></td>
            <td align="left" valign="baseline"><input name="password" id="password" type="password"/></td>
        </tr>
        
        <tr>
        	<td align="right" valign="baseline">&nbsp;</td>
            <td align="left" valign="baseline"><?php echo recaptcha_get_html( $publickey, NULL, true ); ?></td>
        </tr>
        
        <tr>
        	<td align="right" valign="baseline"><input type="hidden" name="validate" value="yes" /></td>
            <td align="left" valign="baseline"><input name="submit" type="submit" value="Login" /></td>
        </tr>
	</table>
</form>
<?php
}
?>
                  </article>
                </div>
            </div>
        </section>
    </div>
</div>
<!--==============================footer=================================-->
<div class="block3">
	<div class="main">
        <footer>
        	<div class="container_24">
            	<div class="wrapper"></div>
<?php
echo "<center>";
echo $datetime;
echo "</center>";
?>
            </div>
        </footer>
    </div>
</div>
</body>
</html>