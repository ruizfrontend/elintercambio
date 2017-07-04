<?php
/**
 * The front page template file
 */

include(get_template_directory() . '/initEiio.php');

get_header(); ?>

<?php if($projData['isHome']): ?>
	<div id="main">
		<?php foreach ($projData['homeData']['bloques'] as $bloque): ?>
			<div id="<?php echo $bloque['nombre_seccion']; ?>" class="blck <?php echo 'blck-' . $bloque['nombre_seccion'] . ' blck-' . ($bloque['color'] == 'gris' || $bloque['color'] == 'negro' ? 'dark' : 'light') . ' blck-' . $bloque['color']; ?>">

				<?php if($bloque['fondo']): // imagen del bloque ?>	
					<div class="blck-img">
						<img src="<?php echo $bloque['fondo']['url']; ?>" width="<?php echo $bloque['fondo']['width']; ?>" height="<?php echo $bloque['fondo']['height']; ?>" alt="<?php echo $bloque['fondo']['alt']; ?>" title="<?php echo $bloque['fondo']['title']; ?>">
					</div>
				<?php endif; ?>

				<?php if($bloque['titular_linea1']): // bloque de texto principal ?>

					<div class="blck-main<?php echo $bloque['fondo'] ? ' blck-fondo' : ''; ?>"><div class="blck-main-wrap">
						<h2>
							<div class="hd-l1"><span><?php echo $bloque['titular_linea1']; ?></span></div>
							<?php if($bloque['titular_linea_2']): ?><div class="hd-l2"><span><?php echo $bloque['titular_linea_2']; ?></span></div><?php endif; ?>
						</h2>

						<?php if($bloque['descripcion']): ?>
							<?php echo $bloque['descripcion']; ?>
						<?php endif; ?>
					</div></div>
				<?php endif; ?>
												

					<?php // bottom page ?>
				<?php switch($bloque['nombre_seccion']): 
					case 'Intro': ?>
						
					<?php break; ?>
				

					<?php case 'que': break; ?>

					<?php case 'quienes': include(get_template_directory() . '/home-blocks/team.php'); break; ?>
				
					<?php case 'whom': include(get_template_directory() . '/home-blocks/aliados.php'); break; ?>

					<?php case 'portfolio': include(get_template_directory() . '/home-blocks/proyectos.php'); break; ?>
						
					<?php case 'contacto': include(get_template_directory() . '/home-blocks/contacto.php'); break; ?>

					<?php /* default: ?> <?php break; */ ?>
				
				<?php endswitch; ?>
			</div>

			<?php if($bloque['nombre_seccion'] == 'Intro'): ?>
				<?php include(get_template_directory() . '/menu.php'); ?>
			<?php endif; ?>

		<?php endforeach; ?>
	</div>
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/jquery.waypoints.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/waypoints-sticky.js"></script>


<?php get_footer();?>

</body>
</html>
