<?php $countProjs = count($projData['homeData']['proyectos']); ?>
<?php if($countProjs !== 0): ?>
	<div class="bl-proyectos clearfix">
		<div class="bl-proy-main">
			<?php foreach ($projData['homeData']['proyectos'] as $idx => $proy): ?>
				<div class="bl-proy-elm<?php echo $idx == 0 ? ' act' : '' ?>">
					
					<div class="bl-proy-elm-bg">
						<img src="<?php echo $proy['imagen_principal']['sizes']['proyect-main']; ?>" width="<?php echo $proy['imagen_principal']['sizes']['proyect-main-width']; ?>" height="<?php echo $proy['imagen_principal']['sizes']['proyect-main-height']; ?>" alt="<?php echo $proy['imagen_principal']['alt']; ?>">
					</div>
					
					<div class="bl-proy-elm-bottom">

						<div class="bl-proy-elm-text">
							<?php if($proy['url']): ?><a href="<?php echo $proy['url']; ?>"><?php endif; ?>
								<h4><?php echo $proy['titulo']; ?></h4>
							<?php if($proy['url']): ?></a><?php endif; ?>

							<?php if($proy['descripcion']): ?><?php echo $proy['descripcion']; ?><?php endif; ?>

							<?php if($proy['url']): ?><a class="bl-proy-elm-goto" target="_blank" href="<?php echo $proy['url']; ?>">
								<i class="fa fa-external-link" aria-hidden="true"></i> <?php echo $proy['texto_enlace']; ?>
							</a><?php endif; ?>
						</div>

						<div class="bl-proy-elm-capturas">
							<img src="<?php echo $proy['capturas']['sizes']['proyect-second']; ?>" width="<?php echo $proy['capturas']['sizes']['proyect-second-width']; ?>" height="<?php echo $proy['capturas']['sizes']['proyect-second-height']; ?>" alt="<?php echo $proy['capturas']['alt']; ?>">
						</div>
					</div>

				</div>
			<?php endforeach; ?>
		</div>

		<?php if ($countProjs > 1): ?>
			<div class="bl-proy-thumbs clearfix"><div class="bl-proy-wrap">
				<?php foreach ($projData['homeData']['proyectos'] as $idx => $proy): ?>
					<?php if($idx != 0): ?>--><?php endif; ?><div class="bl-proy-thumb">
						<div class="bl-proy-thumb-inn"><div class="wk-valign"><h4 class="wk-valign-cont"><span><?php echo $proy['titulo_corto'] ? $proy['titulo_corto'] : $proy['titulo']; ?></span></h4></div></div>
						<img src="<?php echo $proy['thumb']['sizes']['proyect-thumbs']; ?>" width="<?php echo $proy['thumb']['sizes']['proyect-thumbs-width']; ?>" height="<?php echo $proy['thumb']['sizes']['proyect-thumbs-height']; ?>" alt="<?php echo $proy['thumb']['alt']; ?>">
					</div><?php if($idx < $countProjs - 1): ?><!--<?php endif; ?>
				<?php endforeach; ?>
			</div></div>

		<?php endif ?>
	</div>
<?php endif ?>