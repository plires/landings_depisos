<?php if($stores): ?>
  <!-- Store -->
  <div style="display:none" class="form-group content_store">
    <p class="label_showroom">Seleccioná un showroom de tu preferencia</p>
    <div class="form-check">
      
      <?php 
        $last_key = array_search(end($stores), $stores);
        // Invertimos el array de los stores, para que se renderice primero Zona Norte
        $inverted_stores = array_reverse($stores);
      ?>

      <?php foreach ($inverted_stores as $key => $store): ?>
        <div class="content_input">
          <input checked required class="form-check-input" value="<?= $store['id'] ?>" type="radio" name="store"
          id="store<?= $store['id'] ?>">
          <label title="<?= $store['description'] ?>" class="form-check-label" for="store<?= $store['id'] ?>">
            <?= $store['name'] ?>
          </label>

          <?php if($key == $last_key): ?>
            <div class="invalid-feedback">
              Por favor, seleccioná un showroom de tu preferencia.
            </div>
          <?php endif ?>
          
        </div>    
      <?php endforeach ?>
        
    </div>
  </div>
  
<?php endif ?>