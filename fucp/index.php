<?php
error_reporting(0);
session_start();
if( !isset($_SESSION['username']) )
{
	echo "<script>";
	echo "window.location.href='login.php'";
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

<?php
$username = $_SESSION['username'];

$fenconfig = include( '../fenconfig/config.php' );
if( $fenconfig == NULL )
{
	echo "<script>";
	echo "window.location.href='/error.html'";
	echo "</script>"; 
}
$forumconnect = mysql_connect( $forumserver, $forumuser, $forumpass );
if( !$forumconnect )
{
	mysql_close();
	echo "<script>";
	echo "window.location.href='/error.html'";
	echo "</script>"; 
}

$result = mysql_query( "SELECT sp, gp FROM forum.vb_user WHERE username = '$username'" );
$array = mysql_fetch_array( $result );
$sp = $array['sp'];
$gp = $array['gp'];
mysql_close();
?>
<body>
<!--==============================header=================================-->
<div class="block1">
	<div class="main">
    	<header>
            <h1><a class="logo" href="index.php">Fantasy</a>
            	<span>User Control Panel</span>
            </h1>
            <p><br />
            Welcome, <?php echo $username; ?>.<br />
            <strong>SP: </strong>
            <?php
			echo $sp;
			?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong><span style="color:#D4A017">GP: </span></strong>
            <?php
			echo $gp;
			?>
            </p>
            <nav>
                <ul class="sf-menu">
                    <li class="current"><a href="index.php">home</a></li>
                    <li class="indice"><a href="/games" target="_blank">games</a>
                    	<ul>
                            <li><a href="game.php?g=luna">luna plus</a>
                            	<ul>
                                	<li><a href="vote.php?g=luna">vote</a></li>
                                    <li><a href="item.php?g=luna">item</a></li>
                                    <li><a href="database.php?g=luna">database</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/payments.php" target="_blank">donate</a></li>
                    <li><a href="/" target="_blank">forum</a></li>
                    <li><a href="logout.php">logout</a></li>
              </ul>
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
                    <article class="grid_24">This is the Fantasy User Control Panel. Here you can vote, change non-forum settings, and more! Click one of the buttons to get started.</article>
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