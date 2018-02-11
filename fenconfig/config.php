<div id="fb-root">
</div>
<script>
(
	function( d, s, id )
	{
		var js, fjs = d.getElementsByTagName(s)[0];
		if(d.getElementById(id))
			return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}
	( document, 'script', 'facebook-jssdk' )
);
</script>


<?
$datetime = "Fantasy time is currently: " . date('l, g:i A') . " (UTC-05:00, Eastern).";

$forumserver = 'localhost';
$forumuser = 'forum';
$forumpass = '!Afa0345074278B@';

$lunaserver = 'FantasyLunaSQL';
$lunauser = 'luna';
$lunapass = '!A63f794386f24B@';

function fbLike( $url, $width )
{
	$like = "<div class='fb-like' data-href='" . $url . "' data-send='true' data-width='" . $width . "'data-show-faces='true'></div>";
	return $like;
}
function fbComments( $url, $width, $posts )
{
	$comments = "<div class='fb-comments' data-href='" . $url . "' data-width='" . $width . "' data-num-posts='" . $posts . "'></div>";
	return $comments;
}
?>