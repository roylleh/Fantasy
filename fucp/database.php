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



<?php
//Luna Plus
if( $g == 'luna' ):
$lunaconnect = mssql_connect( $lunaserver, $lunauser, $lunapass );
if( !$lunaconnect )
{
	mssql_close();
	echo "<script>";
	echo "window.location.href='/error.html'";
	echo "</script>"; 
}

//Display the Character Name Search function.
echo "<center>";
echo "<strong>Character Name Search:</strong>";
echo "</br>";
echo "<form name='search' method='post'>";
echo "<input name='charname' id='charname' type='text'/>";
echo "<input name='search' type='submit' value='Search'/>";
echo "</form>";
echo "</center>";
echo "</br>";
echo "</br>";

//Search for the character and display information, is possible.
if( isset($_POST['search']) ):
$charname = trim( preg_replace("/[^a-zA-Z0-9]/", "", $_POST['charname']) );
$result = mssql_query( "SELECT 
USER_IDX, 
CHARACTER_NAME, 
CHARACTER_STAGE, 
CHARACTER_GENDER, 
CHARACTER_STR, 
CHARACTER_DEX, 
CHARACTER_VIT, 
CHARACTER_INT, 
CHARACTER_WIS, 
CHARACTER_LIFE, 
CHARACTER_MANA, 
CHARACTER_GRADE, 
CHARACTER_MONEY, 
CHARACTER_JOB1, 
CHARACTER_REBIRTH 
FROM [lunagame].[dbo].[TB_CHARACTER] WHERE CHARACTER_NAME = '$charname'" );
$count = mssql_num_rows( $result );

if( $count == 0 ):
echo "Sorry, we couldn't find \"" . $charname . "\".";
else:
$array = mssql_fetch_array( $result );
echo "<strong>Character: </strong><a href='../member.php?u=" . $array['USER_IDX'] . "'>" . $array['CHARACTER_NAME'] . "</a>";
echo "</br>";
echo "<strong>Race: </strong>";
if( $array['CHARACTER_STAGE'] == '0' )
{
	echo "Human";
}
else if( $array['CHARACTER_STAGE'] == '1' )
{
	echo "Elf";
}
else
{
	echo "Majin";
}
echo "</br>";
echo "<strong>Gender: </strong>";
if( $array['CHARACTER_GENDER'] == '0' )
{
	echo "Male";
}
else if( $array['CHARACTER_GENDER'] == '1' )
{
	echo "Female";
}
echo "</br>";
echo "<strong>Class: </strong>";
if( $array['CHARACTER_JOB1'] == '1' )
{
	echo "Fighter";
}
else if( $array['CHARACTER_JOB1'] == '2' )
{
	echo "Rogue";
}
else if( $array['CHARACTER_JOB1'] == '3' )
{
	echo "Mage";
}
else
{
	echo "Majin";
}
echo "</br>";
echo "<strong>STR: </strong>" . $array['CHARACTER_STR'];
echo "</br>";
echo "<strong>DEX: </strong>" . $array['CHARACTER_DEX'];
echo "</br>";
echo "<strong>VIT: </strong>" . $array['CHARACTER_VIT'];
echo "</br>";
echo "<strong>INT: </strong>" . $array['CHARACTER_INT'];
echo "</br>";
echo "<strong>WIS: </strong>" . $array['CHARACTER_WIS'];
echo "</br>";
echo "<strong>HP: </strong>" . $array['CHARACTER_LIFE'];
echo "</br>";
echo "<strong>MP: </strong>" . $array['CHARACTER_MANA'];
echo "</br>";
echo "<strong>Level: </strong>" . $array['CHARACTER_GRADE'];
echo "</br>";
echo "<strong>Gold: </strong>" . $array['CHARACTER_MONEY'];
echo "</br>";
echo "<strong>Rebirths: </strong>" . $array['CHARACTER_REBIRTH'];
echo "</br>";
echo "</br>";
echo "</br>";
endif;
endif;

//Display the Top 100 players.
$array = array();
$result = mssql_query( "SELECT TOP 100 
USER_IDX, 
CHARACTER_NAME, 
CHARACTER_STAGE, 
CHARACTER_GENDER, 
CHARACTER_GRADE, 
CHARACTER_JOB1, 
CHARACTER_REBIRTH 
FROM [lunagame].[dbo].[TB_CHARACTER] WHERE LEFT(CHARACTER_NAME, 1) <> '@' AND USER_IDX <> 1 ORDER BY 
CHARACTER_REBIRTH DESC, CHARACTER_GRADE DESC, CHARACTER_MAXGRADE DESC, CHARACTER_EXPOINT DESC, CHARACTER_MONEY DESC, CHARACTER_LASTMODIFIED DESC" );
while( $char = mssql_fetch_assoc($result) )
{
	$array[] = $char;
}
echo "<center>";
echo "<h2><strong><span style='color:#000000'>Top 100</span></strong></h2>";
echo "</br>";
echo "<table width='600' border='3' cellspacing='3' cellpadding='3'>";
echo "<tr>";
	echo "<td>";
		echo "<strong>Rank:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Character:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Race:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Gender:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Class:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Level:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Rebirths:</strong>";
	echo "</td>";
echo "</tr>";
$n = 1;
foreach( $array as $top )
{
	echo "<tr>";
		echo "<td>";
			echo $n;
		echo "</td>";
		echo "<td>";
			echo "<a href='../member.php?u=" . $top['USER_IDX'] . "'>" . $top['CHARACTER_NAME'] . "</a>";
		echo "</td>";
		echo "<td>";
			if( $top['CHARACTER_STAGE'] == '0' )
			{
				echo "Human";
			}
			else if( $top['CHARACTER_STAGE'] == '1' )
			{
				echo "Elf";
			}
			else
			{
				echo "Majin";
			}
		echo "</td>";
		echo "<td>";
		if( $top['CHARACTER_GENDER'] == '0' )
		{
			echo "Male";
		}
		else
		{
			echo "Female";
		}
		echo "</td>";
		echo "<td>";
		if( $top['CHARACTER_JOB1'] == '1' )
		{
			echo "Fighter";
		}
		else if( $top['CHARACTER_JOB1'] == '2' )
		{
			echo "Rogue";
		}
		else if( $top['CHARACTER_JOB1'] == '3' )
		{
			echo "Mage";
		}
		else
		{
			echo "Majin";
		}
		echo "</td>";
		echo "<td>";
			echo $top['CHARACTER_GRADE'];
		echo "</td>";
		echo "<td>";
			echo $top['CHARACTER_REBIRTH'];
		echo "</td>";
	echo "</tr>";
	$n++;
}
echo "</table>";
echo "</center>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

//Display the ban list.
echo "<center>";
echo "<h2><strong><span style='color:#000000'>Ban List</span></strong></h2>";
echo "</br>";
echo "<table width='255' border='3' cellspacing='3' cellpadding='3'>";
echo "<tr>";
	echo "<td>";
		echo "<strong>Member:</strong>";
	echo "</td>";
	echo "<td>";
		echo "<strong>Ban Reason:</strong>";
	echo "</td>";
echo "</tr>";
$array = array();
$result = mssql_query( "SELECT propid, id_loginid, BAN_REASON FROM [lunamember].[dbo].[chr_log_info] WHERE sta_num = 6 ORDER BY propid ASC" );
while( $member = mssql_fetch_assoc($result) )
{
	$array[] = $member;
}
foreach( $array as $ban )
{
	echo "<tr>";
		echo "<td>";
			echo "<a href='../member.php?u=" . $ban['propid'] . "'>" . $ban['id_loginid'] . "</a>";
		echo "</td>";
		echo "<td>";
			echo $ban['BAN_REASON'];
		echo "</td>";
	echo "</tr>";
}
echo "</table>";
echo "</center>";

mssql_close();
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