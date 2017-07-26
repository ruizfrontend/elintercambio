<?php foreach ($projData['homeData']['bloques'] as $bloque): ?>

	<?php if($bloque['nombre_seccion'] !== 'que') continue; ?>
	
	<?php $blockClass = 'blck-' . $bloque['nombre_seccion']; // sección como nombre de clase ?>
	<?php $blockClass .= ' blck-' . ($bloque['color'] == 'gris' || $bloque['color'] == 'negro' ? 'dark' : 'light') . ' blck-' . $bloque['color']; ?>

	<div id="<?php echo $bloque['nombre_seccion']; ?>" class="blck <?php echo $blockClass; ?>">
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
					
	</div></div>

<?php endforeach; ?>