<?php
/**
 * The front page template file
 */

	// inicialización de datos de acf
include(get_template_directory() . '/initEiio.php');

get_header(); ?>


<?php if($projData['isHome']): ?>
	<div id="main">
		<?php foreach ($projData['homeData']['bloques'] as $bloque): ?>
			
			<?php $blockClass = 'blck-' . $bloque['nombre_seccion']; // sección como nombre de clase ?>
			<?php $blockClass .= ' blck-' . ($bloque['color'] == 'gris' || $bloque['color'] == 'negro' ? 'dark' : 'light') . ' blck-' . $bloque['color']; ?>

			<div id="<?php echo $bloque['nombre_seccion']; ?>" class="blck <?php echo $blockClass; ?>" 
					<?php if($bloque['fondo']): // imagen de fondo de sección ?>style="background: url(<?php echo $bloque['fondo']['url']; ?>) center center; background-size: cover;"<?php endif;?>>
				<div class="blck-inn">

				<?php if($bloque['titular_linea1'] || $bloque['descripcion']): // bloque de texto (siempre necesitamos linea 1) ?>

					<div class="blck-main<?php echo $bloque['fondo'] ? ' blck-fondo' : ''; ?>"><div class="blck-main-wrap">
						<h2>
							<?php if($bloque['titular_linea1']): ?><div class="hd-l1"><span><?php echo $bloque['titular_linea1']; ?></span></div><?php endif; ?>
							<?php if($bloque['titular_linea_2']): ?><div class="hd-l2"><span><?php echo $bloque['titular_linea_2']; ?></span></div><?php endif; ?>
						</h2>

						<?php if($bloque['descripcion']): ?>
							<?php echo $bloque['descripcion']; ?>
						<?php endif; ?>
					</div></div>
				<?php endif; ?>
												

				<?php switch($bloque['nombre_seccion']): // inclue módulos específicos para las secciones de la home
					case 'Intro': break; ?>

					<?php case 'que': break; ?>

					<?php case 'quienes': include(get_template_directory() . '/home-blocks/team.php'); break; ?>
				
					<?php case 'whom': include(get_template_directory() . '/home-blocks/aliados.php'); break; ?>

					<?php case 'portfolio': include(get_template_directory() . '/home-blocks/proyectos.php'); break; ?>
						
					<?php case 'contacto': include(get_template_directory() . '/home-blocks/contacto.php'); break; ?>

					<?php /* default: ?> <?php break; */ ?>
				
				<?php endswitch; ?>
			</div></div>

			<?php if($bloque['nombre_seccion'] == 'Intro'): // el menú se incluye tras la Intro y tiene que ir fuera de todo el wrap para el sticky ?>
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
