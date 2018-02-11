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
                    <article class="grid_24">
<?php
$g = trim( preg_replace("/[^a-zA-Z0-9]/", "", $_GET['g']) );
?>
<script type="text/javascript">
function vote1()
{
	document.getElementById("vote1").submit();
}
function vote2()
{
	document.getElementById("vote2").submit();
}
function vote3()
{
	document.getElementById("vote3").submit();
}
</script>



<?php
//Luna Plus
if( $g == 'luna' ):
if( isset($_POST['vote']) )
{
	$vote = $_POST['vote'];
	$newsp = $sp + 1;
	
	$lunaconnect = mssql_connect( $lunaserver, $lunauser, $lunapass );
	if( !$lunaconnect )
	{
		mssql_close();
		echo "<script>";
		echo "window.location.href='/error.html'";
		echo "</script>";
	}
	
	$user = mssql_query( "SELECT * FROM [lunamember].[dbo].[chr_log_info] WHERE id_loginid = '$username'" );
	$userarray = mssql_fetch_array( $user );
	$time = $userarray['vote' . $vote];
	$curtime = time();
	$difftime = $curtime - $time;
	
	if( ($difftime) > 46800 )
	{
		$userid = $userarray['propid'];
		$charnum = mssql_query( "SELECT CHARACTER_IDX FROM [lunagame].[dbo].[TB_CHARACTER] WHERE USER_IDX = '$userid' AND CHARACTER_GRADE >= '120'" );
		$count = mssql_num_rows( $charnum );
		
		if( $count >= 1 )
		{
			mssql_query( "UPDATE [lunamember].[dbo].[chr_log_info] SET vote" . $vote . " = '$curtime' WHERE id_loginid = '$username'" );
			mssql_close();
			mysql_query( "UPDATE forum.vb_user SET sp = '$newsp' WHERE username = '$username'" );
		}
		else
		{
			echo "<span style='color:#FF0000'>";
			echo "You do not have at least one Level 120+ character.";
			echo "</span></br></br>";
			mssql_close();
		}
	}
	else
	{
		echo "<span style='color:#FF0000'>";
		echo "You can vote on that website again in " . ( 46800 - $difftime ) . " seconds.";
		echo "</span></br></br>";
		mssql_close();
	}
}
?>
The proper way to vote is to click a link below, type out the verification on the next page, click the vote button, and then repeat for the other links.<br /><strong>Please don't</strong> skip typing in the verification, otherwise we won't get your vote :(<br /><br />This is how we get our traffic, so please vote honestly and we can get even more popular and continue to provide great service; it only takes a minute, after all. If you get an error page, your vote didn't go through, so please try again. Remember, you can vote once every 13 hours, but you need to have at least one Level 120+ character to receive <strong>SP</strong>. A Reborn character is fine too.<br /><br /><br />
<center>
<table>
<tr><form id="vote1" method="post">
<!-- Begin XtremeTop100 code -->
<a href="http://www.xtremetop100.com/in.php?site=1132323427" target="_blank" onClick="vote1();">
<img src="images/votenew.jpg" border="0" alt="private server" width="88" height="53"></a>
<!-- End XtremeTop100 code -->
<input type="hidden" name="vote" value="1" /></form>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tr>

<tr><form id="vote2" method="post">
<!-- Begin Gtop100 voting code -->
<a href="http://www.gtop100.com/in.php?site=63219" title="Luna Online Top 100" target="_blank" onClick="vote2();">
<img src="images/votebutton.jpg" border="0" alt="Luna Online Top 100" width="88" height="53"/></a>
<!-- End Gtop100s voting code -->
<input type="hidden" name="vote" value="2" /></form>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tr>

<tr><form id="vote3" method="post">
<!-- topofgames.com -->
<a href="http://topofgames.com/index.php?do=votes&id=35106" target="_blank" onClick="vote3();">
<img border="0" src="images/0006xbhs.gif" alt="topofgames.com" width="88" height="53"/></a>
<!-- /topofgames.com -->
<input type="hidden" name="vote" value="3" /></form></tr>
</table>
</center>
<?php
endif;
?>



<?php
mysql_close();
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