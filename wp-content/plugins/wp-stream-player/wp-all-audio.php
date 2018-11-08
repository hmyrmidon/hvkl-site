<?php
/*
  Plugin Name: WP Stream Player
  Plugin URI: http://www.geniolabs.com/wp-stream-player-plugin/
  Version: 1.0
  Author: Geniolabs
  Description: WP Stream Player can play a variety of audio streams and audio types such as .mp3, .asx. Use the shortcode [wp-stream-player url="your audio url" type="mp3|asx" autoplay="yes|no" ]
 */

// Add Shortcode
function wp_stream_player($atts) {
    ob_start();
    wp_stream_player_fn($atts);
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

//html-javascript output of the player
function wp_stream_player_fn($atts) {
    wp_enqueue_script('jplayer', plugins_url( 'js/jquery.jplayer.min.js', __FILE__ ), array('jquery'), '1.3.6');
    wp_enqueue_script('jplayerpl', plugins_url( 'js/jplayer.playlist.min.js', __FILE__ ), array('jquery'), '1.3.6');
    wp_enqueue_style('audio_player_css', plugins_url( 'css/gl_radios.css', __FILE__ ));
	wp_enqueue_style('ui_css', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_script('ui', '//code.jquery.com/ui/1.10.4/jquery-ui.js', array('jquery'), '1.3.6');
	
    // Attributes
    extract(shortcode_atts(
                    array(
        'url' => 'shems',
        'autoplay' => 'no',
        'type' => 'mp3'
                    ), $atts)
    );
    $play_auto = ($autoplay == "yes") ? "true" : "false";
    if ($type == "asx") {
        echo '<div class="wpallaudio" style="width:315px;padding-top:10px;margin-top:20px;padding-left:10px;margin-bottom:20px;height:60px"><div style="height:70px;margin-bottom:20px;">' .
                '<OBJECT ID="MediaPlayer1" CLASSID="clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6" CODEBASE="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab# Version=5,1,52,701" STANDBY="Loading Microsoft Windows® Media Player components..." TYPE="application/x-oleobject" width="280" height="46">' .
                '<param name="fileName" value="' . $url . '">' .
                '<param name="wmode" value="opaque" />' .
                '<param name="animationatStart" value="true">' .
                '<param name="transparentatStart" value="true">' .
                '<param name="autoStart" value="' . $play_auto . '">' .
                '<param name="showControls" value="true">' .
                '<param name="ShowStatusBar" value="True">' .
                '<param name="Volume" value="-300">' .
                '<embed autostart="' . $play_auto . '" height="45" type="application/x-mplayer2" name="mediaplayer" pluginspage="http://www.microsoft.com/Windows/MediaPlayer" src="' . $url . '"></embed>' .
                '</OBJECT>' .
                '</div></div>';
    } else {
        ?>
	<style>
	#slider-range-min .ui-slider-range { background: #729fcf; }
	#slider-range-min .ui-slider-handle { border-color: #729fcf;height: 13px; }
	</style>
        <div id="jquery_jplayer_2" class="jp-jplayer"></div>
        <div id="jp_container_2" class="jp-audio wpallaudio"  style="margin-bottom:20px;margin-top:20px;width:345px;">
            <div id="player" class="jp-type-playlist" >
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls">
                        <li style="margin-left:0px; padding-top:0px;"><a href="javascript:;" class="jp-play"  tabindex="1">play</a></li>
                        <li style="margin-left:0px; padding-top:0px;"><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                        <li style="margin-left:0px; padding-top:0px;"><a href="javascript:;" class="jp-mute"  tabindex="1" title="mute">mute</a></li>
                        <li style="margin-left:0px; padding-top:0px;"><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                        <li style="margin-left:0px; padding-top:0px;"><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                    </ul>
                    <div class="jp-volume-bar" style="overflow:visible;">
								<div id="slider-range-min" style="width:115px;height:0.3em"></div>
					</div>
                </div>
                <div class="jp-playlist" style="display:none">
                    <ul>
                        <li></li>
                    </ul>
                </div>
                <div class="jp-no-solution">
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function getCookie(cname)
            {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++)
				{
					var c = ca[i].trim();
					if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
				}
				return "";
            }
            var gl_radio;
			jQuery(document).ready(function($){
            gl_radio = new jPlayerPlaylist({
            jPlayer: "#jquery_jplayer_2",
                    cssSelectorAncestor: "#jp_container_2"
            }, [
            {
            title:"",
                    mp3:"<?php echo $url; ?>"
            }
            ], {<?php
			if ($autoplay == "no")
				$home = "true";
			if ($home != true) {
            $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
            if (stripos($ua, 'android') == false) {
                ?>ready: function () {
                    $(this).jPlayer("play"); },
                            volumechange:function(event){document.cookie = "jpvolume=" + event.jPlayer.options.volume + ";"; },
            <?php }
        } else {
            ?>
                play: function(){
                },
        <?php } ?>
					swfPath: "js",
                    supplied: "mp3",
                    preload: "none",
                    wmode: "window",
                    smoothPlayBar: true,
                    solution:"html,flash",
                    volume: (getCookie("jpvolume") == "")?"0.8":getCookie("jpvolume")
            });
			
			jQuery('.jp-volume-max').click(function(){
			jQuery( "#slider-range-min" ).slider( "value", 1 );
			});
	
			jQuery('.jp-mute').click(function(){
				jQuery( "#slider-range-min" ).slider( "value", 0 );
			});
	
			jQuery('.jp-unmute').click(function(){
			  var curvol = (getCookie("jpvolume")=="")?"0.8":getCookie("jpvolume");
				jQuery( "#slider-range-min" ).slider( "value", curvol );
			});
			
			jQuery( "#slider-range-min" ).slider({
				  range: "min",
				  value: (getCookie("jpvolume")=="")?"0.8":getCookie("jpvolume"),
				  max: 1,
				  step: 0.01,
				  slide: function( event, ui ) {
					$( "#jquery_jplayer_2" ).jPlayer( "volume", ui.value );
				  }
			});
			 jQuery( "#jquery_jplayer_2" ).jPlayer( "volume",jQuery( "#slider-range-min" ).slider( "value" ));
            });        
	</script>
            <?php
        }
        return;
    }
    add_shortcode('wp-stream-player', 'wp_stream_player');
	
    /*     ************Admin Section*****************        */
    add_action('admin_menu', 'wpsp_plugin_settings');

    function wpsp_plugin_settings() {
        add_options_page('WP Stream Player', 'WP Stream Player', 'administrator', 'wpsp_settings', 'wpsp_display_settings');
    }

    function wpsp_display_settings() {
        ?>
    <div class="wrap">
        <script>
                    function generate_clicked()
                            {
                            var wpsp_url = document.getElementsByName("tb_url")[0].value;
                                    var wpsp_type = document.getElementsByName("sl_type")[0].value;
                                    var wpsp_autoplay = document.getElementsByName("sl_autoplay")[0].value;
                                    document.getElementById("p_shrtcode").innerHTML = '[wp-stream-player  url="' + wpsp_url + '" type="' + wpsp_type + '" autoplay="' + wpsp_autoplay + '" ]';
                                    }
        </script>
        <h2>WP Stream Player Shortcode Generator</h2>
        <table>
            <tr>
                <td>Stream Url:</td>
                <td><input type="text" name="tb_url" /></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                    <select name="sl_type">
                        <option value="mp3">MP3</option>
                        <option value="asx">ASX</option></td>
                </select>
            </tr>
            <tr>
                <td>Autoplay:</td>
                <td>
                    <select name="sl_autoplay">
                        <option value="yes">Yes</option>
                        <option value="no">No</option></td>
                </select>
                </td>
            </tr>
            <tr>
                <td>Generate Shortcode:</td>
                <td><button onclick="generate_clicked();">Generate</button></td>
            </tr>
        </table>
        <fieldset style="border: solid 1px #dfdfdf;padding-left:10px">
            <legend>Shortcode</legend>
            <p id="p_shrtcode"></p>
        </fieldset>
        <p style="color: purple;margin-top: 30px;">For more information please visite the plugin <a href="http://www.geniolabs.com/wp-stream-player-plugin/" />website</a>.</p> 
    </div>

    <?php
}
?>