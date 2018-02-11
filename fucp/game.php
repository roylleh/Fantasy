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
$file = "online.ini";
$online = parse_ini_file( $file );
?>



<?php
//Luna Plus
if( $g == 'luna' ):
$lunaconnect = mssql_connect( $lunaserver, $lunauser, $lunapass );
if( !$lunaconnect ):
mssql_close();
echo "<center>";
echo "<span style='color:#FF0000'>";
echo "The Fantasy Luna Plus server has crashed and must be restarted manually by our host. We have no control over this so please be patient.";
echo "</span>";
echo "<center>";
else:
//Display the number of players currently online.
$result = mssql_query( "SELECT * FROM [lunamember].[dbo].[LoginTable]" );
$players = mssql_num_rows( $result );
$result = mssql_query( "SELECT CHARACTER_IDX FROM [lunagame].[dbo].[TB_CHARACTER]" );
$characters = mssql_num_rows( $result );
$result = mysql_query( "SELECT * FROM forum.vb_user" );
$accounts = mysql_num_rows( $result );
if( $players > $online['luna'] )
{
	file_put_contents( $file, str_replace("luna = $online[luna]", "luna = $players", file_get_contents($file)) );
	$online['luna'] = $players;
}
echo "<strong><span style='color:#000000'>Players Online: </span></strong>";
echo "<span style='color:#FF0000'>";
if( $players < 2 )
{
	echo "(Maintenance)";
}
else
{
	echo $players;
}
echo "</span>";
echo "</br>";
echo "<strong><span style='color:#000000'>Most Players Online: </span></strong>";
echo "<span style='color:#FF0000'>";
echo $online['luna'];
echo "</span>";
echo "</br>";
echo "<strong><span style='color:#000000'>Total Characters: </span></strong>";
echo "<span style='color:#FF0000'>";
echo $characters;
echo "</span>";
echo "</br>";
echo "<strong><span style='color:#000000'>Total Accounts: </span></strong>";
echo "<span style='color:#FF0000'>";
echo $accounts;
echo "</span>";
echo "</br>";
echo "</br>";
echo "</br>";

//Explain the Rebirth system.
$ritem1 = '60000001';
$ritem2 = '60000002';
echo "<strong><span style='color:#000000'>Character Functions: </span></strong>";
echo "</br>";
echo "If you have a Level 200 character, you can Rebirth back to a Level 1 of the same class, while keeping all of your skills and stats. (Except Job Passives)";
echo "</br>";
echo "Also, you can continue to level, gain skill points and stat points, and even choose different jobs (of the same class).";
echo "</br>";
echo "Finally, you'll need Spirit Gems and Spirit Tears to Rebirth. Spirit Gems are dropped by Tarintus, and Spirit Tears are dropped by Kierra,";
echo "</br>";
echo "</br>";
echo "<strong>Note #1:</strong> Your character will lose all of the Spirit Gems and Spirit Tears in his or her inventory upon Rebirth.";
echo "</br>";
echo "<strong>Note #2:</strong> The number of Spirit Gems and Spirit Tears you need to use increases everytime you Rebirth.";
echo "</br>";
echo "<strong>Note #3:</strong> You can use a Reskill or Restat after a Rebirth and still restore all skill points and stat points from before a Rebirth.";
echo "</br>";
echo "<strong>Note #4:</strong> A character can be reborn a maximum of once every 24 hours.";
echo "</br>";
echo "<strong>Note #5:</strong> A character can be reborn up to 50 times.";
echo "</br>";
echo "<strong>Note #6:</strong> You must exit out of Fantasy Luna Plus completely before using any of these functions.";
echo "</br>";
echo "</br>";

//List characters for various functions.
echo "<form method='post'>";
echo "<select name='charmenu'>";
echo "<option value=''>Select a character...</option>";
$result = mssql_query( "SELECT * FROM [lunamember].[dbo].[chr_log_info] WHERE id_loginid = '$username'" );
$array = mssql_fetch_array( $result );
$userid = $array['propid'];
$result = mssql_query( "SELECT * FROM [lunamember].[dbo].[LoginTable] WHERE user_id = '$username'" );
$online = mssql_num_rows( $result );
$result = mssql_query( "SELECT CHARACTER_NAME, CHARACTER_GRADEUPPOINT, CHARACTER_STR, CHARACTER_DEX, CHARACTER_VIT, CHARACTER_INT, CHARACTER_WIS FROM [lunagame].[dbo].[TB_CHARACTER] WHERE LEFT(CHARACTER_NAME, 1) <> '@' AND USER_IDX = '$userid'" );
$chars = array();
while( $row = mssql_fetch_assoc($result) )
{
	$chars[] = $row;
}
foreach( $chars as $char )
{
	$charname = $char['CHARACTER_NAME'];
	echo "<option value='$charname'>$charname</option>";
}
echo "</select>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<input type='submit' name='alker' value='Return: Alker'>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<input type='submit' name='nera' value='Return: Nera'>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<input type='submit' name='rebirth' value='Rebirth'>";
echo "</form>";

//Execute the chosen function.
if( isset($_POST['alker']) )
{
	$charname = $_POST['charmenu'];
	if( empty($charname) )
	{
		echo "<span style='color:#FF0000'>Please select a character first.</span>";
	}
	else if( $online > 0 )
	{
		echo "<span style='color:#FF0000'>Please exit out of Fantasy Luna Plus first.</span>";
		echo "</br>";
		echo "<span style='color:#FF0000'>If you keep getting this message, login to Luna, don't select a character, logout from Luna, and try again.</span>";
	}
	else
	{
		mssql_query( "UPDATE [lunagame].[dbo].[TB_CHARACTER] SET CHARACTER_MAP = 20, CHARACTER_POS_X = 44625, CHARACTER_POS_Y = 43775 WHERE CHARACTER_NAME = '$charname'" );
		echo "<span style='color:#006600'>" . $charname . " has been successfully teleported to Alker Harbor!</span>";
	}
}
if( isset($_POST['nera']) )
{
	$charname = $_POST['charmenu'];
	if( empty($charname) )
	{
		echo "<span style='color:#FF0000'>Please select a character first.</span>";
	}
	else if( $online > 0 )
	{
		echo "<span style='color:#FF0000'>Please exit out of Fantasy Luna Plus first.</span>";
		echo "</br>";
		echo "<span style='color:#FF0000'>If you keep getting this message, login to Luna, don't select a character, logout from Luna, and try again.</span>";
	}
	else
	{
		mssql_query( "UPDATE [lunagame].[dbo].[TB_CHARACTER] SET CHARACTER_MAP = 52, CHARACTER_POS_X = 27525, CHARACTER_POS_Y = 22425 WHERE CHARACTER_NAME = '$charname'" );
		echo "<span style='color:#006600'>" . $charname . " has been successfully teleported to Nera Castletown!</span>";
	}
}
if( isset($_POST['rebirth']) )
{
	$charname = $_POST['charmenu'];
	if( empty($charname) )
	{
		echo "<span style='color:#FF0000'>Please select a character first.</span>";
	}
	else if( $online > 0 )
	{
		echo "<span style='color:#FF0000'>Please exit out of Fantasy Luna Plus first.</span>";
		echo "</br>";
		echo "<span style='color:#FF0000'>If you keep getting this message, login to Luna, don't select a character, logout from Luna, and try again.</span>";
	}
	else
	{
		$result = mssql_query( "SELECT CHARACTER_IDX, CHARACTER_NAME, CHARACTER_REBIRTH, CHARACTER_REBIRTHTIME FROM [lunagame].[dbo].[TB_CHARACTER] WHERE CHARACTER_NAME = '$charname' AND CHARACTER_GRADE >= '200'" );
		$count = mssql_num_rows( $result );
		if( $count == 0 )
		{
			echo "<span style='color:#FF0000'>" . $charname . " isn't Level 200 yet!</span>";
		}
		else
		{
			$array = mssql_fetch_array($result);
			$charid = $array['CHARACTER_IDX'];
			$rebirths = $array['CHARACTER_REBIRTH'];
			
			$result = mssql_query( "SELECT TOP 1 * FROM [lunagame].[dbo].[TB_ITEM] WHERE CHARACTER_IDX = '$charid' AND ITEM_IDX = '$ritem1' ORDER BY ITEM_DURABILITY DESC" );
			$array = mssql_fetch_array( $result );
			$icount1 = $array['ITEM_DURABILITY'];
			
			$result = mssql_query( "SELECT TOP 1 * FROM [lunagame].[dbo].[TB_ITEM] WHERE CHARACTER_IDX = '$charid' AND ITEM_IDX = '$ritem2' ORDER BY ITEM_DURABILITY DESC" );
			$array = mssql_fetch_array( $result );
			$icount2 = $array['ITEM_DURABILITY'];
			
			$icount3 = floor( $rebirths / 10 ) + 1;
			$time = $array['CHARACTER_REBIRTHTIME'];
			$curtime = time();
			$difftime = $curtime - $time;
			
			if
			(
				( $icount1 < $icount3 || $icount2 < $icount3 )
			)
			{
				echo "<span style='color:#FF0000'>" . $charname . " needs " . $icount3 . " Spirit Gems and Spirit Tears to be reborn!</span>";
			}
			else if ( $difftime <= 86400 )
			{
				echo "<span style='color:#FF0000'>" . $charname . " can be reborn again in " . ( 86400 - $difftime ) . " seconds.</span>";
			}
			else if( $rebirths >= 50 )
			{
				echo "<span style='color:#FF0000'>" . $charname . " can not be reborn again...</span>";
			}
			else
			{
				mssql_query( "UPDATE [lunagame].[dbo].[TB_CHARACTER] SET CHARACTER_GRADE = '1', CHARACTER_MAXGRADE = '1', CHARACTER_EXPOINT = '0',
				CHARACTER_JOB = '1', CHARACTER_JOB2 = '0', CHARACTER_JOB3 = '0', CHARACTER_JOB4 = '0', CHARACTER_JOB5 = '0', CHARACTER_JOB6 = '0', 
				CHARACTER_REBIRTH = CHARACTER_REBIRTH + 1, CHARACTER_REBIRTHTIME = '$curtime' WHERE CHARACTER_IDX = '$charid'" );
				mssql_query( "DELETE FROM [lunagame].[dbo].[TB_QUEST] WHERE CHARACTER_IDX = '$charid'" );
				mssql_query( "DELETE FROM [lunagame].[dbo].[TB_MAINQUEST] WHERE CHARACTER_IDX = '$charid'" );
				mssql_query( "DELETE FROM [lunagame].[dbo].[TB_SUBQUEST] WHERE CHARACTER_IDX = '$charid'" );
				mssql_query( "DELETE FROM [lunagame].[dbo].[TB_ITEM] WHERE ITEM_IDX = '$ritem1' AND CHARACTER_IDX = '$charid'" );
				mssql_query( "DELETE FROM [lunagame].[dbo].[TB_ITEM] WHERE ITEM_IDX = '$ritem2' AND CHARACTER_IDX = '$charid'" );
				echo "<span style='color:#006600'>" . $charname . " has been successfully reborn!</span>";
			}
		}
	}
}

// Stat Control Center
echo "</br>";
echo "</br>";
echo "</br>";
echo "<strong><span style='color:#000000'>Stat Control Center: </span></strong>";
echo "</br>";
echo "</br>";

$n = 1;
foreach( $chars as $char )
{
	echo "<table width='500' border='3' cellspacing='3' cellpadding='3'>";
	
	$charname = $char['CHARACTER_NAME'];
	$stats = $char['CHARACTER_GRADEUPPOINT'];
	$str = $char['CHARACTER_STR'];
	$dex = $char['CHARACTER_DEX'];
	$vit = $char['CHARACTER_VIT'];
	$int = $char['CHARACTER_INT'];
	$wis = $char['CHARACTER_WIS'];
	
	if( $char['CHARACTER_GRADEUPPOINT'] >= 0 )
	{
		echo "<tr>";
			echo "<td>";
				echo $charname . ":";
			echo "</td>";
			echo "<td>";
				echo "STR:";
			echo "</td>";
			echo "<td>";
				echo "DEX:";
			echo "</td>";
			echo "<td>";
				echo "VIT:";
			echo "</td>";
			echo "<td>";
				echo "INT:";
			echo "</td>";
			echo "<td>";
				echo "WIS:";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>";
				echo "Current Stat Points:";
			echo "</td>";
			echo "<td>";
				echo $str;
			echo "</td>";
			echo "<td>";
				echo $dex;
			echo "</td>";
			echo "<td>";
				echo $vit;
			echo "</td>";
			echo "<td>";
				echo $int;
			echo "</td>";
			echo "<td>";
				echo $wis;
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>";
				echo "Points to Add:";
			echo "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>";
				echo "</br>";
				echo "</br>";
			echo "</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	$n++;
}
echo "</br>";
echo "</br>";
echo "</br>";


//Close the connection and end the branch.
mssql_close();
endif;
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