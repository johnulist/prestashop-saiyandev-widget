<?php
/*
Plugin Name: Prestashop Saiyandev Widget
Plugin URI: http://saiyandev.com/wordpress/plugins/prestashop-saiyandev-widget
Description: Añade un widget para enlazar contenido de Prestashop mediante la API REST presentándolo con jcarrousell.
Version: 0.1
Author: Jorge Ortega Traverso
Author URI: http://saiyandev.com
License: GPL v3.0
*/
?><?php

if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

/*
 *  Referencia en http://www.mmfilesi.com/blog/programar-widget-wordpress/
 */
class Prestashop_Saiyandev_Widget extends WP_Widget {
	var $jcarrousell_efects = array('easein','easeinout','easeout','expoin','expoout','expoinout','bouncein','bounceout','bounceinout','elasin','elasout','elasinout','backin','backout','backinout','linear');

	public function __construct () {
		parent::__construct(
				'Prestashop_Saiyandev_Widget' //id_base
				, 'Prestashop Saiyandev Widget' //name
				, array('description'=>__('Prestashop Saiyandev Widget','presta-saiyandev')) //widget_options
				// control_options
				);

	}
	public function widget ($args, $instance) {
		extract ($args);
		extract ($instance);
		_log('Testing logging '.$presta_syndv_productAPI.' with key '.$presta_syndv_clave);
		_log("spped = $presta_syndv_effect_speed \n auto = $presta_syndv_effect_auto \n easing = $presta_syndv_effect_easing");

		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_URL,$presta_syndv_productAPI);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_MUTE, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $presta_syndv_clave);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10); //times out after 10s
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		$curl_response = curl_exec($ch);
		curl_close($ch);

		$xml = new SimpleXMLElement($curl_response);
		$products = $xml->xpath('/prestashop/products/*');
		if(!empty($products)) {
			echo "$before_widget$before_title$presta_syndv_box_title$after_title"
				."<div class=\"syndvProductBox\" id=\"prestahopSaiyandevWidget".$this->id."\"><div class=\"syndvCarrousell\">";
			echo "<ul class=\"syndvProductList\" >";
			reset($products);
			foreach ($products as $clave => $prod) {
				$prod_rewrite	= $prod->link_rewrite->language[0];
				$prod_id 		= $prod->id;
				$prod_image_id 	= $prod->id_default_image;
				$prod_name 		= $prod->name->language[0];
				$prod_desc		= $prod->description_short->language[0];
				$prod_desc_nt	= strip_tags($prod_desc);
				$img_link 		= "$presta_syndv_PS_base/$prod_image_id-home_default/$prod_rewrite.jpg";
				$prod_link 		= "$presta_syndv_PS_base/$prod_id-$prod_rewrite.html";
				setlocale(LC_MONETARY, "es_ES");
				$price = money_format("%.2n &euro;", doubleval($prod->price));
				echo "<li>";
				echo "<a class=\"syndvProductNameLink\" target=\"newWindowPresta$prod_rewrite\" href=\"$prod_link\" title=\"[ $prod_name ] $prod_desc_nt\" > <strong>$prod_name</strong><br/></a>";
				echo "\n<span title=\"$prod_desc_nt\">$prod_desc</span><a class=\"syndvProductImgLink\" target=\"newWindowPresta$prod_rewrite\" href=\"$prod_link\" title=\"[ $prod_name ] $prod_desc_nt\" >$price<img width=\"124\" height=\"124\" src=\"$img_link\"></a>";
				echo "</li>";
			}
			echo "</ul></div></div>$after_widget";
		}
		?>
<script type="text/javascript">
jQuery(function() {
		jQuery("#prestahopSaiyandevWidget<?php echo $this->id; ?>").jCarouselLite({
		visible: 1,
		speed: <?php echo $presta_syndv_effect_speed ?>,
		auto: <?php echo  $presta_syndv_effect_auto ?>,
		easing: "<?php echo $presta_syndv_effect_easing ?>"
	});
});
</script>
		<?php
		//echo $after_widget;
	}
	public function update ($new_instance, $old_instance) {
		$instance = array();
		$instance['presta_syndv_box_title'] = strip_tags($new_instance['presta_syndv_box_title']);
		$instance['presta_syndv_clave'] = strip_tags($new_instance['presta_syndv_clave']);
		$instance['presta_syndv_productAPI'] = strip_tags($new_instance['presta_syndv_productAPI']);
		$instance['presta_syndv_PS_base'] = strip_tags($new_instance['presta_syndv_PS_base']);

		$instance['presta_syndv_effect_auto'] = strip_tags($new_instance['presta_syndv_effect_auto']);
		$instance['presta_syndv_effect_easing'] = strip_tags($new_instance['presta_syndv_effect_easing']);
		$instance['presta_syndv_effect_speed'] = strip_tags($new_instance['presta_syndv_effect_speed']);
		return $instance;
	}
	public function form($instance) {
		extract($instance);
		if(!isset($presta_syndv_box_title)) {
			$presta_syndv_box_title = 'Productos destacados';
		}
		if(!isset($presta_syndv_effect_auto)) {
			$presta_syndv_effect_auto = '5000';
		}
		if(!isset($presta_syndv_effect_easing)) {
			$presta_syndv_effect_easing = 'linear';
		}
		if(!isset($presta_syndv_effect_speed)) {
			$presta_syndv_effect_speed = '1000';
		}
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'presta_syndv_box_title' );  ?>"><?php _e('Box Title:', 'presta-saiyandev'); ?>
	</label><input class="widefat" type="text" size="20" value="<?php echo $presta_syndv_box_title ?>"
		id="<?php echo $this->get_field_id( 'presta_syndv_box_title' ); ?>"
		name="<?php echo $this->get_field_name ( 'presta_syndv_box_title' ); ?>" >
		<br/>
	<label for="<?php echo $this->get_field_id( 'presta_syndv_clave' );  ?>"><?php _e('Clave WS:', 'presta-saiyandev'); ?>
	</label><input class="widefat" type="text" size="20" value="<?php echo $presta_syndv_clave ?>"
		id="<?php echo $this->get_field_id( 'presta_syndv_clave' ); ?>"
		name="<?php echo $this->get_field_name ( 'presta_syndv_clave' ); ?>" >
		<br/>
	<label for="<?php echo $this->get_field_id('presta_syndv_productAPI'); ?>" ><?php echo _e('REST Product API','presta-saiyandev'); ?></label>
	<input class="widefat" type="text" size="20"
	value="<?php echo $presta_syndv_productAPI; ?>" name="<?php echo $this->get_field_name('presta_syndv_productAPI'); ?>"
	id="<?php echo $this->get_field_id('presta_syndv_productAPI'); ?>">
	<br/>
	<label for="<?php echo $this->get_field_id('presta_syndv_PS_base'); ?>" ><?php echo _e('Prestashop Location ','presta-saiyandev'); ?></label>
	<input class="widefat" type="text" size="20"
	value="<?php echo $presta_syndv_PS_base; ?>" name="<?php echo $this->get_field_name('presta_syndv_PS_base'); ?>"
	id="<?php echo $this->get_field_id('presta_syndv_PS_base'); ?>">
	<fieldset>
		<legend>Efecto de transici&oacute;n JCarrousell Lite + JQuery Easing</legend>
		<label for="<?php echo $this->get_field_id('presta_syndv_effect_easing'); ?>" ><?php echo _e('Efecto de transici&oacute;n (easing)','presta-saiyandev'); ?></label>
		<?php echo $this->generateSelect($this->get_field_name('presta_syndv_effect_easing'),
									$this->get_field_id('presta_syndv_effect_easing'),
									$this->jcarrousell_efects,
									$presta_syndv_effect_easing); ?>
	<br/>
		<label for="<?php echo $this->get_field_id('presta_syndv_effect_auto'); ?>" ><?php echo _e('Pausa (milisegundos)','presta-saiyandev'); ?></label>
		<input class="widefat" type="text" size="20"
		value="<?php echo $presta_syndv_effect_auto; ?>" name="<?php echo $this->get_field_name('presta_syndv_effect_auto'); ?>"
		id="<?php echo $this->get_field_id('presta_syndv_effect_auto'); ?>">
<br/>
		<label for="<?php echo $this->get_field_id('presta_syndv_effect_speed'); ?>" ><?php echo _e('Velocidad (milisegundos)','presta-saiyandev'); ?></label>
		<input class="widefat" type="text" size="20"
		value="<?php echo $presta_syndv_effect_speed; ?>" name="<?php echo $this->get_field_name('presta_syndv_effect_speed'); ?>"
		id="<?php echo $this->get_field_id('presta_syndv_effect_speed'); ?>">

	</fieldset>
</p>

<?php
	}

	public function generateSelect($name = '', $select_id = '', $options = array(), $selected_value) {
    $html = '<select class="widefat" name="'.$name.'" id="'.$select_id.'"">';
    foreach ($options as $option => $value) {
        $html .= '<option value="'.$value.'" '.( ($value == $selected_value) ? 'selected' : '').'>'.$value.'</option>';
    }
    $html .= '</select>';
    return $html;
	}
} // Cierra la clase



/*  CSS */
function carga_presta_syndv_estilo_widget () {
	wp_register_style( 'presta-syndv-estilo', plugins_url('style.css', __FILE__) );
	wp_enqueue_style( 'presta-syndv-estilo' );
}
add_action( 'wp_enqueue_scripts', 'carga_presta_syndv_estilo_widget' );

/* jQuery */
function carga_presta_syndv_jquery() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'presta_syndv_jcarrousell', plugins_url('js/jcarousel.js', __FILE__));
	wp_enqueue_script( 'presta_syndv_jquery_easing', plugins_url('js/jquery.easing.1.1.js', __FILE__));

}
add_action('wp_enqueue_scripts', 'carga_presta_syndv_jquery');

/* traducciones
function carga_presta_syndv_traduccion() {
	load_plugin_textdomain('saiyandev', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action('init', 'carga_presta_syndv_traduccion');
*/

function presta_saiyandev_register_widgets() {
	register_widget( 'Prestashop_Saiyandev_Widget' );
}
add_action( 'widgets_init', 'presta_saiyandev_register_widgets' );
?>