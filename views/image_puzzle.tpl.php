<?php



	if ( ! defined( 'ABSPATH' ) ) exit;



	$ROWS = 4;

	$COLS = 8;



	//récupère la taille de l'image

	$size = getimagesize($atts['src']);



	if($size == false)

		echo 'Error: cannot retrieve image size!';

	else

	{

		$piece_width = floor($size[0]/$COLS);

		$piece_height = floor($size[1]/$ROWS);



		$id = rand(0, 100000000);

	



?>

<style>



	#bg_puzzle_<?php echo (int)$id ?> {

		width: <?php echo (int)$size[0] ?>px;

		height: <?php echo (int)$size[1] ?>px;

	}



	#bg_puzzle_<?php echo (int)$id ?> .bg_puzzle {

		background-image: url(<?php echo esc_url($atts['src']) ?>);

		width: <?php echo (int)$piece_width ?>px;

		height: <?php echo (int)$piece_height ?>px;

		float: left;

		transition: all 2s linear;

	}



	<?php 



		for($i=0; $i<$ROWS; $i++)

		{

			for($j=0; $j<$COLS; $j++)

			{

				if(!isset($atts['effect']) || $atts['effect'] == 'fade')

				{

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.' { background-position: '.(int)(-$j*$piece_width).'px '.(int)(-$i*$piece_height).'px; opacity: 0.0; }';

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.'_anim { opacity: 1; }';

				}

				else if($atts['effect'] == 'rotate')

				{

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.' { background-position: '.(int)(-$j*$piece_width).'px '.(int)(-$i*$piece_height).'px; transform: rotate(180deg); opacity: 0.0; }';

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.'_anim { transform: rotate(0deg); opacity: 1; }';

				}

				else if($atts['effect'] == 'distortion')

				{

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.' { background-position: '.(int)rand(-500, 500).'px '.(int)rand(-500, 500).'px; opacity: 0.5; }';

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.'_anim { background-position: '.(int)(-$j*$piece_width).'px '.(int)(-$i*$piece_height).'px; opacity: 1; }';

				}

				else 

				{

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.' { transform: translate('.(int)rand(-500, 500).'px, '.(int)rand(-500, 500).'px); opacity: 0.5; background-position: '.(int)(-$j*$piece_width).'px '.(int)(-$i*$piece_height).'px; }';

					echo '#bg_puzzle_'.(int)$id.' .bg_puzzle_'.(int)$i.'_'.(int)$j.'_anim { transform: translate(0, 0); opacity: 1; }';

				}

			}

		}



	?>



</style>

<div id="bg_puzzle_<?php echo (int)$id ?>">

<?php



	for($i=0; $i<$ROWS; $i++)

	{

		for($j=0; $j<$COLS; $j++)

		{

			echo '<div class="bg_puzzle bg_puzzle_'.(int)$i.'_'.(int)$j.'" rel="'.(int)$i.'_'.(int)$j.'"></div>';

		}

	}



?>

</div>

<script>



	jQuery(document).ready(function(){



		<?php if(isset($atts['effect']) && $atts['effect'] == 'fade') : ?>



			var pieces = [];

			var time = 100;



			jQuery('#bg_puzzle_<?php echo (int)$id ?> .bg_puzzle').each(function(){

				pieces.push(this);



				setTimeout(function(){

					var _this = pieces.pop();

					var the_class = jQuery(_this).attr('class');

					jQuery(_this).addClass(the_class+'_anim');

				}, time);

				time += 100;

			});



		<?php elseif($atts['effect'] == 'rotate' || $atts['effect'] == 'distortion') : ?>



				setTimeout(function(){	

					jQuery('#bg_puzzle_<?php echo (int)$id ?> .bg_puzzle').each(function(){

						var the_class = jQuery(this).attr('class');

						jQuery(this).addClass(the_class+'_anim');

					});

				}, 100);



		<?php else : ?>



			setTimeout(function(){

				jQuery('#bg_puzzle_<?php echo (int)$id ?> .bg_puzzle').each(function(){

					var pos = jQuery(this).attr('rel');

					jQuery(this).addClass('bg_puzzle_'+pos+'_anim');

				});

			}, 100);



		<?php endif; ?>



	});



</script>

<?php } ?>