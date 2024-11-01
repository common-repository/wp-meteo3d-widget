<?php
/*
	Plugin Name: WP_Meteo3D Widget
	Plugin URI: http://www.meteolive3d.com/index.php/service/plugin
	Description: With WP_Meteo3D Widget you can display weather near real time conditions for over 200 cities in a 3D earth environment.
	Version: 1.0
	Author: Stefano Boeri
	Author URI: http://www.meteolive3d.com
	
	Copyright 2009, meteolive3d.com

	This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function WP_Meteo3D_install () {
	$widgetoptions = get_option('WP_Meteo3D_widget');
	$newoptions['width'] = '300';
	$newoptions['height'] = '300';
	$newoptions['map'] = '1';
	$newoptions['lang'] = 'en';
	$newoptions['unit'] = 'C';
	$newoptions['rot'] = 'y';
	add_option('WP_Meteo3D_widget', $newoptions);
}

function WP_Meteo3D_init($content){
	if( strpos($content, '[WP_Meteo3D]') === false ){
		return $content;
	} else {
		$code = WP_Meteo3D_createflashcode(false);
		$content = str_replace( '[WP_Meteo3D]', $code, $content );
		return $content;
	}
}

function WP_Meteo3D_insert(){
	echo WP_Meteo3D_createflashcode(false);
}

function WP_Meteo3D_createflashcode($widget){
	if( $widget != true ){
	} else {
		$options = get_option('WP_Meteo3D_widget');
		$soname = "widget_so";
		$divname = "wpWP_Meteo3Dwidgetcontent";
	}
	if( function_exists('plugins_url') ){ 
		$map = $options['map'];
		$lang = $options['lang'];
		$unit = $options['unit'];
		$rot = $options['rot'];
		$path = plugins_url('wp-meteo3d-widget/');
		$movie = plugins_url('wp-meteo3d-widget/flash/meteo3d.swf')."?lang=".$lang."&map=".$map."&path=".$path."&unit=".$unit."&rot=".$rot;
	} else {
		$map = $options['map'];
		$lang = $options['lang'];
		$unit = $options['unit'];
		$rot = $options['rot'];
		$path = get_bloginfo('wpurl')."/wp-content/plugins/wp-meteo3d-widget/";
		$movie = get_bloginfo('wpurl') . "/wp-content/plugins/wp-meteo3d-widget/flash/meteo3d.swf"."?lang=".$lang."&map=".$map."&path=".$path."&unit=".$unit."&rot=".$rot;
	}

        $flashtag ='<div id="meteo3d"><div style="background-color: #000000;">';
	$flashtag .= '<script type="text/javascript" src="'.$path.'swfobject.js"></script>';	
	$flashtag .= '<script type="text/javascript">swfobject.registerObject("Meteo3D", "9.0.0", "'.$path.'flash/expressInstall.swf");</script>';
	$flashtag .= '<center><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.$options['width'].'" height="'.$options['height'].'" id="Meteo3D" align="middle" bgcolor="#000000">';
	$flashtag .= '<param name="movie" value="'.$movie.'" /><param name="menu" value="false" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#000000" /><param name="allowscriptaccess" value="always" />';
	$flashtag .= '<!--[if !IE]>--><object type="application/x-shockwave-flash" data="'.$movie.'" width="'.$options['width'].'" height="'.$options['height'].'" align="middle"><param name="menu" value="false" /><param name="wmode" value="transparent" /><param name="bgcolor" value="#000000" /><param name="allowscriptaccess" value="always" /><!--<![endif]-->';
	$flashtag .= '<p>Plugin WP Meteo3D by <a href="http://www.meteolive3d.com">MeteoLive3D.com</a> requires Flash Player 9 or better.</p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a><!--[if !IE]>--></object><!--<![endif]--></object></center>';
        $flashtag .='</div></div>';
        if($lang == "en"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Weather Forecast" target="_blank">Weather Forecast</a> by MeteoLive3D.com</span></center>';
        }
        if($lang == "it"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com/it" title ="Previsioni Meteo" target="_blank">Previsioni Meteo</a> di MeteoLive3D.com</span></center>';
        }
        if($lang == "dk"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Vejrudsigten" target="_blank">Vejrudsigten</a> ved MeteoLive3D.com</span></center>';
        }
        if($lang == "nl"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Weersvoorspelling" target="_blank">Weersvoorspelling</a>  door MeteoLive3D.com</span></center>';
        }
        if($lang == "fi"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Sääennuste" target="_blank">Sääennuste</a>  on Meteolive3D.com</span></center>';
        }
        if($lang == "fr"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Prévisions Météo" target="_blank">Prévisions Météo</a>  par MeteoLive3D.com</span></center>';
        }
        if($lang == "de"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Wettervorhersage" target="_blank">Wettervorhersage</a>  von MeteoLive3D.com</span></center>';
        }
        if($lang == "hu"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Időjárásjelentés" target="_blank">Időjárásjelentés</a>  által MeteoLive3D.com</span></center>';
        }
        if($lang == "pl"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Prognoza Pogody" target="_blank">Prognoza Pogody</a>  przez MeteoLive3D.com</span></center>';
        }
        if($lang == "pt"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Previsão do Tempo" target="_blank">Previsão do Tempo</a>  por MeteoLive3D.com</span></center>';
        }
        if($lang == "ro"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Prognoza Meteo" target="_blank">Prognoza Meteo</a>  de MeteoLive3D.com</span></center>';
        }
        if($lang == "ru"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Прогноз погоды" target="_blank">Прогноз погоды</a>  на MeteoLive3D.com</span></center>';
        }
        if($lang == "sk"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Predpoveď Počasia" target="_blank">Predpoveď Počasia</a>  podľa MeteoLive3D.com</span></center>';
        }
        if($lang == "es"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Pronóstico del Tiempo" target="_blank">Pronóstico del Tiempo</a>  por MeteoLive3D.com</span></center>';
        }
        if($lang == "sv"){
         $flashtag .= '<center><span style="font-size:7pt;"><a href="http://www.meteolive3d.com" title ="Väderprognos" target="_blank">Väderprognos</a>  av MeteoLive3D.com</span></center>';
        }
	return $flashtag;
}


function WP_Meteo3D_uninstall () {
	delete_option('WP_Meteo3D_widget');
}


function widget_init_WP_Meteo3D_widget() {
	if (!function_exists('register_sidebar_widget'))
		return;

	function WP_Meteo3D_widget($args){
	    extract($args);
		$options = get_option('WP_Meteo3D_widget');
		$title = empty($options['title']) ? __('WP_Meteo3D Widget') : $options['title'];
		?>
	        <?php echo $before_widget; ?>
				<?php echo $before_title . $title . $after_title; ?>
				<?php 
					if( !stristr( $_SERVER['PHP_SELF'], 'widgets.php' ) ){
						echo WP_Meteo3D_createflashcode(true);
					}
				?>
	        <?php echo $after_widget; ?>
		<?php
	}
	
	function WP_Meteo3D_widget_control() {
		$options = $newoptions = get_option('WP_Meteo3D_widget');
		if ( $_POST["WP_Meteo3D_widget_submit"] ) {
			$newoptions['title'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_title"]));
			$newoptions['width'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_width"]));
			$newoptions['height'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_height"]));
			$newoptions['map'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_map"]));
			$newoptions['lang'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_lang"]));
			$newoptions['unit'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_unit"]));
			$newoptions['rot'] = strip_tags(stripslashes($_POST["WP_Meteo3D_widget_rot"]));
		}
		if ( $options != $newoptions ) {
			$options = $newoptions;
			update_option('WP_Meteo3D_widget', $options);
		}
	        if( function_exists('plugins_url') ){ 
		 $path = plugins_url('wp-meteo3d-widget/');
	        } else {
		 $path = get_bloginfo('wpurl')."/wp-content/plugins/wp-meteo3d-widget/";
                }
		$title = attribute_escape($options['title']);
		$width = attribute_escape($options['width']);
		$height = attribute_escape($options['height']);
		$map = attribute_escape($options['map']);
		$lang = attribute_escape($options['lang']);
		$unit = attribute_escape($options['unit']);
		$rot = attribute_escape($options['rot']);
		?>
			<p><label for="WP_Meteo3D_widget_title"><?php _e('Title:'); ?> <input class="widefat" id="WP_Meteo3D_widget_title" name="WP_Meteo3D_widget_title" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="WP_Meteo3D_widget_width"><?php _e('Width:'); ?> <input class="widefat" id="WP_Meteo3D_widget_width" name="WP_Meteo3D_widget_width" type="text" value="<?php echo $width; ?>" /></label></p>
			<p><label for="WP_Meteo3D_widget_height"><?php _e('Height:'); ?> <input class="widefat" id="WP_Meteo3D_widget_height" name="WP_Meteo3D_widget_height" type="text" value="<?php echo $height; ?>" /></label></p>

                        <p><label for="LWP_Meteo3D_widget_map"><?php _e('Map: '); ?><select name="WP_Meteo3D_widget_map" size="1">
	                <option value="1" <?php if ($map=="1") echo "selected=\"selected\""?>><?php _e('(1) Nasa Bathymetry'); ?></option>
	                <option value="2" <?php if ($map=="2") echo "selected=\"selected\""?>><?php _e('(2) Topographic 1'); ?></option>
	                <option value="3" <?php if ($map=="3") echo "selected=\"selected\""?>><?php _e('(3) Topographic 2'); ?></option>
	                <option value="4" <?php if ($map=="4") echo "selected=\"selected\""?>><?php _e('(4) Natural Color'); ?></option>
	                <option value="5" <?php if ($map=="5") echo "selected=\"selected\""?>><?php _e('(5) Relief'); ?></option>
	                <option value="6" <?php if ($map=="6") echo "selected=\"selected\""?>><?php _e('(6) Vivid Color'); ?></option>
	                <option value="7" <?php if ($map=="7") echo "selected=\"selected\""?>><?php _e('(7) Bump'); ?></option>
	                <option value="8" <?php if ($map=="8") echo "selected=\"selected\""?>><?php _e('(8) Realistic'); ?></option>
	                <option value="9" <?php if ($map=="9") echo "selected=\"selected\""?>><?php _e('(9) Nasa True Marble'); ?></option>
	                </select></label></p>

                        <img style="margin: 0px 0px 10px 0px"" src="<?php _e($path); ?>maps.jpg"/>

                        <p><label for="LWP_Meteo3D_widget_unit"><?php _e('Language: '); ?><select name="WP_Meteo3D_widget_lang" size="1">
	                <option value="en" <?php if ($lang=="en") echo "selected=\"selected\""?>><?php _e('English'); ?></option>
	                <option value="dk" <?php if ($lang=="dk") echo "selected=\"selected\""?>><?php _e('Danish'); ?></option>
	                <option value="nl" <?php if ($lang=="nl") echo "selected=\"selected\""?>><?php _e('Dutch'); ?></option>
	                <option value="fi" <?php if ($lang=="fi") echo "selected=\"selected\""?>><?php _e('Finnish'); ?></option>
	                <option value="fr" <?php if ($lang=="fr") echo "selected=\"selected\""?>><?php _e('French'); ?></option>
	                <option value="de" <?php if ($lang=="de") echo "selected=\"selected\""?>><?php _e('German'); ?></option>
	                <option value="hu" <?php if ($lang=="hu") echo "selected=\"selected\""?>><?php _e('Hungarian'); ?></option>
	                <option value="it" <?php if ($lang=="it") echo "selected=\"selected\""?>><?php _e('Italian'); ?></option>
	                <option value="pl" <?php if ($lang=="pl") echo "selected=\"selected\""?>><?php _e('Polish'); ?></option>
	                <option value="pt" <?php if ($lang=="pt") echo "selected=\"selected\""?>><?php _e('Portuguese'); ?></option>
	                <option value="ro" <?php if ($lang=="ro") echo "selected=\"selected\""?>><?php _e('Romanian'); ?></option>
	                <option value="ru" <?php if ($lang=="ru") echo "selected=\"selected\""?>><?php _e('Russian'); ?></option>
	                <option value="sk" <?php if ($lang=="sk") echo "selected=\"selected\""?>><?php _e('Slovak'); ?></option>
	                <option value="es" <?php if ($lang=="es") echo "selected=\"selected\""?>><?php _e('Spanish'); ?></option>
	                <option value="sv" <?php if ($lang=="sv") echo "selected=\"selected\""?>><?php _e('Swedish'); ?></option>
	                </select></label></p>

                        <p><label for="LWP_Meteo3D_widget_unit"><?php _e('Temperature: '); ?><select name="WP_Meteo3D_widget_unit" size="1">
	                <option value="C" <?php if ($unit=="C") echo "selected=\"selected\""?>><?php _e('Celsius'); ?></option>
                        <option value="F" <?php if ($unit=="F") echo "selected=\"selected\""?>><?php _e('Fahrenheit'); ?></option>
	                </select></label></p>

                        <p><label for="LWP_Meteo3D_widget_rot"><?php _e('Earth Rotation: '); ?><select name="WP_Meteo3D_widget_rot" size="1">
	                <option value="Y" <?php if ($rot=="Y") echo "selected=\"selected\""?>><?php _e('Yes'); ?></option>
                        <option value="N" <?php if ($rot=="N") echo "selected=\"selected\""?>><?php _e('No'); ?></option>
	                </select></p></label>

			<input type="hidden" id="WP_Meteo3D_widget_submit" name="WP_Meteo3D_widget_submit" value="1" />
		<?php
	}
	
	register_sidebar_widget( "WP_Meteo3D Widget", WP_Meteo3D_widget );
	register_widget_control( "WP_Meteo3D Widget", "WP_Meteo3D_widget_control" );
}

function meteo3d_add_options_page() 
{
	add_options_page('Meteo3D Optons', 'Meteo3D', 8, 'wp-meteo3d.php','Meteo3DDisplay');
}

if ( function_exists("is_plugin_page") && is_plugin_page() ) {
	Meteo3DDisplay(); 
	return;
}
function Meteo3DDisplay() {

echo <<<END
<h2>Meteo3D Widget</h2>
<p>Go to Appearance->Widgets page to add the Meteo3D widget.</p>
END;
}

add_action('admin_menu', 'meteo3d_add_options_page');
add_action('widgets_init', 'widget_init_WP_Meteo3D_widget');
add_filter('the_content','WP_Meteo3D_init');
register_activation_hook( __FILE__, 'WP_Meteo3D_install' );
register_deactivation_hook( __FILE__, 'WP_Meteo3D_uninstall' );
?>
