<?php
/*
Plugin Name: Zen-Carousel
Plugin URI: http://freelancedreams.com/
Description: Dojo-powered carousel for Wordpress.
Version: 0.1.1
Author: freelanceDreams
Author URI: http://freelancedreams.com/
*/

add_action('admin_menu', array('zencarousel', 'renderSettings'));
add_action('wp_head', array('zencarousel', 'renderHeader'));

class zencarousel{
	public static function renderHTML(){
		$images = zencarousel::getImages();
		?>
<
<script type="text/javascript" language="javascript">
//<![CDATA[
dojo.addOnLoad(
	function(){
		var opts = {
			root: "zencarousel",
			width: <?php echo get_option('zc-width'); ?>,
			height: <?php echo get_option('zc-height'); ?>
		}
		var zc = new zencarousel(opts);
	}
);
//]]>
</script>
<div id="zencarousel">
		<div class="zc_overlay"></div>
		<div class="fall_back">
<?php echo "\t\t\t"; zencarousel::renderImage($images[0], True); ?>
		</div>
<?php
/*
		<span class="prev">Previous</span>
		<span class="next">Next</span>
		<ul id="zencarousel_numbers">
<?php
				$j = count($images);
				for($i=1; $i<=$j; $i++){
					echo "\t\t\t", '<li class="link', $i, '"><span>', $i, '</span></li>', PHP_EOL;
				}
			?>
		</ul>
*/
?>
		<div class="zc_links" style="display: none;">
<?php
			foreach($images as $image){
				echo "\t\t\t";
				zencarousel::renderImage($image);
			}
?>
		</div>
	</div>
<?php
	}
	public static function renderHeader(){
		if(get_option('zc-useCDN')){
			echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.4.1/dojo/dojo.xd.js"></script>';
		}
		echo '<script type="text/javascript" src="', get_bloginfo('wpurl'), '/wp-content/plugins/zen-carousel/js/zencarousel.js"></script>';
		echo '<link type="text/css" rel="stylesheet" href="' , get_bloginfo('wpurl') , '/wp-content/plugins/zen-carousel/css/zencarousel.css" />' . PHP_EOL;
	}
	public static function renderSettings(){
		add_menu_page(
			'Carousel Options',
			'Carousel',
			'administrator',
			__FILE__,
			array('zencarousel', 'renderOptions'),
			plugins_url('/images/icon.png',
			__FILE__)
		);
		add_action('admin_init', array('zencarousel', 'registerSettings'));
	}
	
	public static function registerSettings(){
		register_setting('zc-settings-group', 'zc-matrix');
		register_setting('zc-settings-group', 'zc-useCDN');
		register_setting('zc-settings-group', 'zc-width');
		register_setting('zc-settings-group', 'zc-height');
	}
	public static function renderOptions(){
		?>
		<div class="wrap zencarousel_form">
			<h2>Zen Carousel</h2>
			<form method="post" action="options.php">
			<p>
Use Dojo CDN: <?php
			if (get_option('zc-useCDN')){
				echo '<input type="checkbox" name="zc-useCDN" checked="checked" />';
			}else{
				echo '<input type="checkbox" name="zc-useCDN" />';
			}
?><br />
				Carousel width: <input type="text" name="zc-width" value="<?php echo get_option('zc-width'); ?>" /><br />
				Carousel height: <input type="text" name="zc-height" value="<?php echo get_option('zc-height'); ?>" />
				<?php settings_fields( 'zc-settings-group' ); ?>
			</p>
			<p>
				Line format:<br>
				<i>&lt;Image url&gt;</i> <i>&lt;Link to&gt;</i> <i>&lt;Title&gt;</i><br>
				Separate the variables with a space. Either full/relative links work.
			</p>
				<textarea type="text" name="zc-matrix"><?php echo get_option('zc-matrix'); ?></textarea>
				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		</div>
		<style>
			.zencarousel_form textarea{
				width: 80%;
				height: 400px;
			}
		</style>
		<?php
	}
	
	public static function getImages(){
		$images = array();
		$str = get_option('zc-matrix');
		$lines = explode("\n", $str);
		foreach ($lines as $line){
			$arr = explode(" ", $line, 3);
			$images[] = array('src'=>$arr[0], 'link'=>$arr[1], 'title'=>trim($arr[2]), 'width'=>800, 'height'=>300);
		}
		return $images;
	}
	public static function renderImg($arr){
		echo '<img src="', $arr['src'], '" alt="', $image['title'], '" width="', $image['width'], '" height="', $image['height'], '" />', PHP_EOL;
	}
	public static function renderImage($arr, $render = False){
		echo '<a href="', $arr['link'], '" title="', $arr['title'], '">';
		if ($render){
			zencarousel::renderImg($arr);
		}else{
			echo $arr['src'];
		}
		echo '</a>', PHP_EOL;
	}
}
