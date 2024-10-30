<?php



	if ( ! defined( 'ABSPATH' ) ) exit;



?>

<script>



var preview_url = '<?php echo esc_url(plugins_url( 'views/preview.php', dirname(__FILE__))); ?>';



jQuery(document).ready(function(){



	//choix d'une image

	jQuery('#ip_choose_file').click(function(e) {

		var _this = this;

		e.preventDefault();

		var image = wp.media({ 

		    title: 'Upload Image',

		    // mutiple: true if you want to upload multiple files at once

		    multiple: false

		}).open()

		.on('select', function(e){

		    // This will return the selected image from the Media Uploader, the result is an object

		    var uploaded_image = image.state().get('selection').first();

		    // We convert uploaded_image to a JSON object to make accessing it easier

		    // Output to the console uploaded_image

		    var image_url = uploaded_image.toJSON().url;

		    // Let's assign the url value to the input field

		    jQuery(_this).parent().find('#ip_file').val(image_url);



		    jQuery.post(ajaxurl, {action: 'ip_preview', src: image_url, effect: jQuery('#ip_effect').val() }, function(data){

		    	jQuery('#ip_preview').html(data);

		    });



		    //on génère le shortcode

		    jQuery('#ip_shortcode').html('[image-puzzle src="'+image_url+'" effect="'+jQuery('#ip_effect').val()+'"]');

		});

	});



	jQuery('#ip_effect').change(function(){



		jQuery.post(ajaxurl, {action: 'ip_preview', src: jQuery('#ip_file').val(), effect: jQuery('#ip_effect').val() }, function(data){

		    	jQuery('#ip_preview').html(data);

		});



		//on génère le shortcode

		jQuery('#ip_shortcode').html('[image-puzzle src="'+jQuery('#ip_file').val()+'" effect="'+jQuery('#ip_effect').val()+'"]');



	});



	//selection du shortcode automatique

	jQuery('#ip_shortcode').click(function(){

		jQuery(this).select();

	});



});



</script>

<div id="ip_form">

	<h2>Choose an image</h2>

	<input type="text" id="ip_file" /> <button id="ip_choose_file">Choose a media</button>



	<h2>Choose an effect</h2>

	<select id="ip_effect">

		<option value="puzzle">Puzzle</option>

		<option value="rotate">Rotation</option>

		<option value="distortion">Distortion</option>

		<option value="fade">Fade</option>

	</select>



	<h2>Shortcode (copy/paste it)</h2>



	<textarea id="ip_shortcode" readonly=""></textarea>

</div>

<div id="ip_preview">

</div>

<h2><a href="https://www.info-d-74.com/en/produit/image-puzzle-pro-plugin-wordpress-2/" target="_blank">Needs more options? Get Image Puzzle Pro!<br /><img src="<?php echo esc_url(plugins_url( 'pro.png', dirname(__FILE__))); ?>" /></a><br/>

and like InfoD74 to discover my new plugins: <a href="https://www.facebook.com/infod74/" target="_blank"><img src="<?php echo esc_url(plugins_url( 'images/fb.png', dirname(__FILE__))) ?>" alt="" /></a></h2>