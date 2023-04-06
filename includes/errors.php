<!-- Errores Formulario -->
<?php if ($errors): ?>
	<div id="error" class="alert alert-danger alert-dismissible fade show fadeInLeft" role="alert">
	  <strong>¡Por favor verificá los datos!</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	  <ul style="padding: 0;">
	    <?php foreach ($errors as $error) { ?>
	      <li>- <?php echo $error; ?></li>
	    <?php } ?>
	  </ul>
	</div>
<?php endif ?>
<!-- Errores Formulario end -->