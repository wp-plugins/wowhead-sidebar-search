<?php
/*
Plugin Name: Wowhead Sidebar Search
Plugin URI: http://alisothegeek.com/plugins/
Description: Adds a Wowhead search panel to your sidebar, with different size options.
Author: Alison Barrett
Version: 1.0
Author URI: http://alisothegeek.com/
*/


function widget_wowheadSearch($args) {
  extract($args);
  $options = get_option('widget_wowheadSearch');
  $box_format = empty( $options['widget_wowheadSearch_format'] ) ? '' : $options['widget_wowheadSearch_format'];
  echo $before_widget;
  echo $before_title;
  echo $after_title;
?>
  <center>
  <script type="text/javascript">var mt_style = <?php echo $box_format; ?></script>
  <script src="http://www.wowhead.com/widgets/searchbox.js" type="text/javascript"></script>
  </center>
<?php
  echo $after_widget;
}

function widget_wowheadSearch_control() {
  $options = get_option("widget_wowheadSearch");

  if (!is_array( $options ))
	{
		$options = array(
      'widget_wowheadSearch_format' => '1'
      );
  }
  if ($_POST['widget_wowheadSearch_submit'])
  {
    $options['widget_wowheadSearch_format'] = htmlspecialchars($_POST['widget_wowheadSearch_format']);

    update_option("widget_wowheadSearch", $options);
  }
?>
  <p>
    <label for="widget_wowheadSearch_format">Search box format:</label>
    <select id="widget_wowheadSearch_format" name="widget_wowheadSearch_format" class="widefat">
    	<option value="1"<?php selected( $options['widget_wowheadSearch_format'], '1' ); ?>><?php _e('160x200 (all text)'); ?></option>
    	<option value="2"<?php selected( $options['widget_wowheadSearch_format'], '2' ); ?>><?php _e('160x150 (less text)'); ?></option>
    	<option value="3"<?php selected( $options['widget_wowheadSearch_format'], '3' ); ?>><?php _e('160x110 (no text)'); ?></option>
    	<option value="4"<?php selected( $options['widget_wowheadSearch_format'], '4' ); ?>><?php _e('120x200 (all text)'); ?></option>
    	<option value="5"<?php selected( $options['widget_wowheadSearch_format'], '5' ); ?>><?php _e('120x150 (less text)'); ?></option>
    	<option value="6"<?php selected( $options['widget_wowheadSearch_format'], '6' ); ?>><?php _e('120x110 (no text)'); ?></option>
    </select>	
    <input type="hidden" id="widget_wowheadSearch_submit" name="widget_wowheadSearch_submit" value="1" />
  </p>
<?php
}



function wowheadSearch_init()
{
  register_sidebar_widget(__('Wowhead Sidebar Search'), 'widget_wowheadSearch');
  register_widget_control(   'Wowhead Sidebar Search', 'widget_wowheadSearch_control', 250, 200 );
}
add_action("plugins_loaded", "wowheadSearch_init");