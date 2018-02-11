<?php
error_reporting(0);
session_start();
$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
if( !isset($_SESSION['validated']) )
{
	echo "<script>";
	$_SESSION['redirect'] = $url;
	echo "window.location.href='validate.php'";
	echo "</script>"; 
}
include( '../fenconfig/config.php' );
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
//Get the information for what the user wants to watch.
$show = $_GET['show'];
$episode = $_GET['episode'];
if( $episode != NULL && $episode < 1 )
{
	$episode = 1;
	echo "<script>";
	echo "window.location.href='?show=" . $show . "&episode=" . $episode . "'";
	echo "</script>";
}
$name = str_replace( "-", " ", $show );

//Dynamic HTML data:
if( $show == NULL && $episode == NULL ):
echo "<title>Watch any show on the Fantasy Dynamic Player!</title>";
endif;

if( $show != NULL && $episode == NULL ):
echo "<title>Watch " . $name . " on the Fantasy Dynamic Player!</title>";
endif;

if( $show != NULL && $episode != NULL ):
echo "<title>Watch " . $name . " - Episode " . $episode . " on the Fantasy Dynamic Player!</title>";
endif;
?>


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
//If no show or episode is specified, display a list of all shows.
if( $show == NULL && $episode == NULL ):
$folders = glob( "/var/www/watch/shows/*" );
foreach( $folders as $folder )
{
	if( is_dir($folder) )
	{
		$folder = basename( $folder, substr("*", 1) );
		$name = str_replace( "-", " ", $folder );
		echo "<a href='./?show=" . $folder . "'>" . $name . "</a>";
		echo "</br>";
	}
}
endif;


//If a show is specified, but not an episode, list all the episodes of that show.
if( $show != NULL && $episode == NULL ):
$files = glob( "/var/www/watch/shows/" . $show . "/*.mp4" );
$n = 1;
foreach( $files as $file )
{
	$file = substr( $file, 0, -4 );
	echo "<a href='./?show=" . $show . "&episode=" . $n . "'>Episode " . $n . "</a>";
	echo "</br>";
	$n++;
}
if( $n < 2 )
{
	echo "<script>";
	echo "window.location.href='./'";
	echo "</script>";
}
endif;


//If both the show and episode is specified, display the episode for all to see!
if( $show != NULL && $episode != NULL ):
$files = glob( "/var/www/watch/shows/" . $show . "/*.mp4" );
$n = 1;
foreach( $files as $file )
{
	$n++;
}
if( $n < 2 )
{
	echo "<script>";
	echo "window.location.href='./'";
	echo "</script>";
}
if( $episode > $n )
{
	$episode = $n;
	echo "<script>";
	echo "window.location.href='?show=" . $show . "&episode=" . $episode . "'";
	echo "</script>";
}

echo "<center>";
echo "You're watching ";
echo "<strong>" . $name . " - Episode " . $episode . ".</strong>";
echo "</br></br>";

$secret = "014ac84236ceeac0f3608b3ecee50ef7bd67b59622701d041d1217e0e6e1128b86e579f8cdb3d597e067eb6ae2de23fc42dcc94e38f8b48890d925467cd019cc";
$expire = time() + 60;

//Secure PNG link.
$path = "/watch/shows/" . $show . "/" . $episode . ".png";
$md5 = base64_encode( md5($secret . $path . $expire, true) );
$md5 = strtr($md5, '+/', '-_');
$md5 = str_replace('=', '', $md5);
$png = $path . "?st=" . $md5 . "&e=" . $expire;

//Secure MP4 link.
$path = "/watch/shows/" . $show . "/" . $episode . ".mp4";
$md5 = base64_encode( md5($secret . $path . $expire, true) );
$md5 = strtr($md5, '+/', '-_');
$md5 = str_replace('=', '', $md5);
$mp4 = $path . "?st=" . $md5 . "&e=" . $expire;

//Secure SRT link.
$path = "/watch/shows/" . $show . "/" . $episode . ".srt";
$md5 = base64_encode( md5($secret . $path . $expire, true) );
$md5 = strtr($md5, '+/', '-_');
$md5 = str_replace('=', '', $md5);
$srt = $path . "?st=" . $md5 . "&e=" . $expire;

echo "
<script type='text/javascript' src='/fenconfig/jwplayer.js'></script>
<script type='text/javascript'>jwplayer.key='Ku94ky2YhJIu+IL26oYifq608kMjsILow9GHGg==';</script>
<div id='watch'>Loading video...Please wait...</div>
<script type='text/javascript'>
jwplayer('watch').setup
(
	{
		width: '640',
		height: '360',
		primary: 'flash',
		playlist:
		[
			{
				title: '" . $name . " - Episode " . $episode . "',
				image: '" . $png . "',
				sources:
				[
					{
						file: '" . $mp4 . "', label: 'HD'
					},
					{
						file: '" . $mp4 . "', label: 'SD'
					}
				],
				captions:
				[
					{
						file: '" . $srt . "', label: 'English'
					}
				]
			}
		]
	}
);
</script>
</br>";

$prevepisode = $episode - 1;
$nextepisode = $episode + 1;
if( $n > 2 ) //This means that there is more than one episode available.
{
	if( $episode > 1 && $episode < ($n-1) ) //Display both the Previous and Next links.
	{
		echo "<a href='./?show=" . $show . "&episode=" . $prevepisode . "'>Prev Episode</a>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href='./?show=" . $show . "&episode=" . $nextepisode . "'>Next Episode</a>";
	}
	else if( $episode > 1 && $episode = ($n-1) ) //If the episode is the newest one, display only the Previous link.
	{
		echo "<a href='./?show=" . $show . "&episode=" . $prevepisode . "'>Prev Episode</a>";
	}
	else //If the episode is the first one, display only the Next link.
	{
		echo "<a href='./?show=" . $show . "&episode=" . $nextepisode . "'>Next Episode</a>";
	}
}
echo "<br />";
echo "<br />";
echo fbLike( $url, 640 );
echo "<br />";
echo "<br />";
echo fbComments( $url, 640, 10 );
echo "</center>";
endif;
?>


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