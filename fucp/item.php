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
$id = trim( preg_replace("/[^a-zA-Z0-9]/", "", $_GET['id']) );
?>



<?php
echo "<center>";
echo "All transactions are final and will only be reversed if confirmed to be a network issue. Also, you can convert every 1 GP into 10 SP.";
echo "</center></br></br>";

//Luna Plus
if( $g == 'luna' ):
$items = array
(
	array("Ancient Guild Scroll", '30000576', '0', '2', '1', '0'),
	
	array("Angel Gloves", '13004989', '12', '0', '0', '0'),
	array("Angel Halo", '13004987', '12', '0', '0', '0'),
	array("Angel Sandals", '13004990', '12', '0', '0', '0'),
	array("Angel Toga", '13004988', '12', '0', '0', '0'),
	array("Angel Wings", '13005081', '12', '0', '0', '0'),
	
	array("Black Widow Leader Boots", '13000852', '0', '25', '0'),
	array("Black Widow Leader Gloves", '13000851', '0', '25', '0'),
	array("Black Widow Leader Hair", '13000849', '0', '25', '0'),
	array("Black Widow Leader Suit", '13000850', '0', '25', '0'),
	
	array("Black Widow Mage Boots", '13000848', '0', '25', '0'),
	array("Black Widow Mage Gloves", '13000847', '0', '25', '0'),
	array("Black Widow Mage Hood", '13000845', '0', '25', '0'),
	array("Black Widow Mage Robe", '13000846', '0', '25', '0'),
	
	array("Black Widow Scout Boots", '13000856', '0', '25', '0'),
	array("Black Widow Scout Gloves", '13000855', '0', '25', '0'),
	array("Black Widow Scout Hood", '13000853', '0', '25', '0'),
	array("Black Widow Scout Suit", '13000854', '0', '25', '0'),
	
	array("Black Widow Sniper Boots", '13000860', '0', '25', '0'),
	array("Black Widow Sniper Gloves", '13000859', '0', '25', '0'),
	array("Black Widow Sniper Turban", '13000857', '0', '25', '0'),
	array("Black Widow Sniper Suit", '13000858', '0', '25', '0'),
	
	array("Blessed Pukerian Scroll", '30000548', '0', '1', '1', '0'),
	
	array("Character Name Change Scroll", '21000241', '0', '1', '1', '0'),
	
	array("Cloak of Hellenopolis", '13000873', '12', '0', '0', '0'),
	
	array("Cute Slime Wearing Star-Glasses", '13002242', '12', '0', '0', '0'),
	
	array("[M]Dark Boots", '13004973', '12', '0', '0', '0'),
	array("[M]Dark Fire", '13004974', '12', '0', '0', '0'),
	array("[M]Dark Gloves", '13004972', '12', '0', '0', '0'),
	array("[M]Dark Hair", '13004970', '12', '0', '0', '0'),
	array("[M]Dark Mail", '13004971', '12', '0', '0', '0'),
	
	array("Devil Boots", '13004994', '12', '0', '0', '0'),
	array("Devil Gloves", '13004993', '12', '0', '0', '0'),
	array("Devil Horns", '13004991', '12', '0', '0', '0'),
	array("Devil Threads", '13004992', '12', '0', '0', '0'),
	
	array("Bizzare Slime Rolling", '13002244', '12', '0', '0', '0'),
	
	array("Freedom and Drop (30 day)", '21001264', '12', '0', '0', '1'),
	
	array("Grow Up, Grow Up Capsule", '21000513', '0', '1', '1', '0'),
	
	array("[M]Honky Tonk Armor", '13004664', '12', '0', '0', '0'),
	array("[M]Honky Tonk Cape", '13004667', '12', '0', '0', '0'),
	array("[M]Honky Tonk Gloves", '13004665', '12', '0', '0', '0'),
	array("[M]Honky Tonk Helm", '13004663', '12', '0', '0', '0'),
	array("[M]Honky Tonk Shoes", '13004666', '12', '0', '0', '0'),
	array("[F]Honky Tonk Armor", '13004669', '12', '0', '0', '0'),
	array("[F]Honky Tonk Gloves", '13004670', '12', '0', '0', '0'),
	array("[F]Honky Tonk Helm", '13004668', '12', '0', '0', '0'),
	array("[F]Honky Tonk Shoes", '13004671', '12', '0', '0', '0'),
	array("[F]Honky Tonk Quiver", '13004672', '12', '0', '0', '0'),
	
	array("Human Cannon (30 day)", '21001267', '12', '0', '0', '1'),
	
	array("Little Devil Body", '13004965', '12', '0', '0', '0'),
	array("Little Devil Gloves", '13004966', '12', '0', '0', '0'),
	array("Little Devil Hair", '13004964', '12', '0', '0', '0'),
	array("Little Devil Shoes", '13004967', '12', '0', '0', '0'),
	array("Little Devil Wings", '13004096', '12', '0', '0', '0'),
	
	array("[F]Magic Card Clover", '13004977', '12', '0', '0', '0'),
	array("[F]Magic Card Dress", '13004976', '12', '0', '0', '0'),
	array("[F]Magic Card Hearts", '13004975', '12', '0', '0', '0'),
	array("[F]Magic Card Pumps", '13004978', '12', '0', '0', '0'),
	array("[F]Magic Card Ribbon", '13004979', '12', '0', '0', '0'),
	
	array("Merry-Go-Round (30 day)", '21001270', '12', '0', '0', '1'),
	array("Octopus Twister (30 day)", '21001266', '12', '0', '0', '1'),
	
	array("Phixus Cloak", '13000872', '12', '0', '0', '0'),
	
	array("Pirate Boots", '13005298', '12', '0', '0', '0'),
	array("Pirate Cloak", '13005299', '12', '0', '0', '0'),
	array("Pirate Costume", '13005296', '12', '0', '0', '0'),
	array("Pirate Gloves", '13005297', '12', '0', '0', '0'),
	array("Pirate Hat", '13005295', '12', '0', '0', '0'),
	
	array("Rain Boots", '13004556', '12', '0', '0', '0'),
	array("Rain Cap", '13004553', '12', '0', '0', '0'),
	array("Rain Cloud", '13004557', '12', '0', '0', '0'),
	array("Rain Coat", '13004554', '12', '0', '0', '0'),
	array("Rain Watch", '13004555', '12', '0', '0', '0'),
	
	array("[Rank 2] +100% EXP Scroll", '21001108', '0', '1', '1', '0'),
	array("[Rank 4] +100% EXP Scroll", '21001110', '0', '2', '1', '0'),
	
	array("Rollercoaster (30 day)", '21001268', '12', '0', '0', '1'),
	
	array("Shinigami Hakui Top", '13005286', '12', '0', '0', '0'),
	array("Shinigami Headband", '13005285', '12', '0', '0', '0'),
	array("Shinigami Hibakama Pants", '13005287', '12', '0', '0', '0'),
	array("Shinigami Zanpakuto Sword", '13005289', '12', '0', '0', '0'),
	array("Shinigami Zouri Straw Sandals", '13005288', '12', '0', '0', '0'),
	
	array("Skill Reset Scroll", '21000175', '0', '1', '1', '0'),
	
	array("Smaller, Smaller Capsule", '21000514', '0', '1', '1', '0'),
	
	array("Skill Point Scroll (+5) x 10", '21000328', '0', '1', '10', '0'),
	
	array("Spirit Gem", '60000001', '12', '0', '1', '0'),
	array("Spirit Tear", '60000002', '12', '0', '1', '0'),
	
	array("Stat Reset Scroll", '21000176', '0', '1', '1', '0'),
	
	array("Stylish Nosy Slime", '13002243', '12', '0', '0', '0'),
	
	array("Taurus Tank (30 day)", '21001269', '12', '0', '0', '1'),
	
	array("Twinkling Bright Smile", '13005363', '12', '0', '0', '0'),
	array("Twinkling Candy Pillow", '13005364', '12', '0', '0', '0'),
	array("Twinkling Chicka Chicka", '13005362', '12', '0', '0', '0'),
	array("Twinkling Pajamas Cap", '13005360', '12', '0', '0', '0'),
	array("Twinkling Pajamas Top", '13005361', '12', '0', '0', '0'),
	
	array("Viking Ship (30 day)", '21001265', '12', '0', '0', '1')
);

//Display the items.
if( !isset($_GET['id']) ):
echo "<center>";
echo "<table width='900' border='3' cellspacing='3' cellpadding='3'>";
echo "<tr>";
$n = 1;
foreach( $items as $i )
{
	$name = $i[0];
	$id = $i[1];
	$silver = $i[2];
	$gold = $i[3];
	
	echo "<td>";
	echo "<center>";
	echo "</br>";
	echo "</br>";
	echo "<a href='item.php?g=" . $g . "&id=" . $id . "'><strong>" . $name . "</strong></a>";
	echo "</br>";
	echo "<a href='item.php?g=" . $g . "&id=" . $id . "'><img src='./images/" . $g . "/" . $id . ".png'/></a>";
	echo " ";
	echo "</br>";
	if( $silver > 0 )
	{
		echo "<strong>SP: </strong>" . $silver;
	}
	if( $gold > 0 )
	{
		echo "<strong><span style='color:#D4A017'>GP: </span></strong>" . $gold;
	}
	echo "</center>";
	echo "</td>";
	if( $n % 4 == 0 )
	{
		echo "</tr>";
		echo "<tr>";
	}
	$n++;
}
echo "</tr>";
echo "</table>";
echo "</center>";
echo "</br></br></br></br></br>";
endif;

//Display the selected item.
if( isset($_GET['id']) ):
foreach( $items as $i )
{
	if( $i[1] == $id )
	{
		$name = $i[0];
		$id = $i[1];
		$silver = $i[2];
		$gold = $i[3];
		$num = $i[4];
		$seal = $i[5];
		
		echo "<center>";
		echo "<strong>" . $name . "</strong>";
		echo "</br>";
		echo "</br>";
		echo "<table width='300' border='3' cellspacing='3' cellpadding='3'>";
		echo "<tr>";
		echo "<td>";
		echo "<img src='./images/" . $g . "/" . $id . ".png'/>";
		echo " ";
		echo "</br>";
		echo "</br>";
		if( $silver > 0 )
		{
			echo "<strong>SP: </strong>" . $silver;
		}
		if( $gold > 0 )
		{
			echo "<strong><span style='color:#D4A017'>GP: </span></strong>" . $gold;
		}
		echo "</br>";
		echo "</br>";
		echo "<form name='get' method='post'>";
		echo "<input name='submit' type='submit' value='Get Item'/>";
		echo "</form>";
		echo "</br>";
		echo "</br>";
		if( isset($_POST['submit']) )
		{
			if( $sp < $silver || $gp < $gold )
			{
				echo "<span style='color:#FF0000'>Sorry, you don't have enough points!</span>";
			}
			else
			{
				$lunaconnect = mssql_connect( $lunaserver, $lunauser, $lunapass );
				if( !$lunaconnect )
				{
					mssql_close();
					echo "<script>";
					echo "window.location.href='/error.html'";
					echo "</script>";
				}
				$lunaitem = mssql_init( '[lunagame].[dbo].[MP_ITEM_INSERT_BY_WEB]', $lunaconnect );
				if( !$lunaitem )
				{
					mssql_close();
					echo "<script>";
					echo "window.location.href='/error.html'";
					echo "</script>";
				}
				$user = mssql_query( "SELECT * FROM [lunamember].[dbo].[chr_log_info] WHERE id_loginid = '$username'" );
				$userarray = mssql_fetch_array( $user );
				$userid = $userarray['propid'];
				$userParam = '@USER_IDX';
				$itemParam = '@ITEM_IDX';
				$numParam = '@ITEM_QUANTITY';
				$sealParam = '@ITEM_SEAL';
				mssql_bind( $lunaitem, $userParam, $userid, SQLFLT8, false );
				mssql_bind( $lunaitem, $itemParam, $id, SQLFLT8, false );
				mssql_bind( $lunaitem, $numParam, $num, SQLFLT8, false );
				mssql_bind( $lunaitem, $sealParam, $seal, SQLFLT8, false );
				mssql_execute( $lunaitem );
				mssql_close();
				mysql_query( "UPDATE forum.vb_user SET sp = sp - $silver, gp = gp - $gold WHERE username = '$username'" );
				echo "<span style='color:#006600'>Item successfully received!</span>";
			}
		}
		echo "</td>";
		echo "</tr>";
		echo "</center>";
		echo "</table>";
	}
}
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