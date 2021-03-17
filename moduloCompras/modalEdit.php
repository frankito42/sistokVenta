<!-- Modal -->
<div class="modal fade right" id="editar<?php echo $key['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div style="color: white;background: #4285f4;" class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel"><?php echo $key['nombre']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="editar.php" method="GET">
      <input type="text" name="idEntrada" value="<?php echo $key['idEntrada']?>" style="display:none;">
      
      <input type="text" name="cantidadAnterior" value="<?php echo $key['cantidad']?>" style="display:none;">
      <input type="text" name="id" value="<?php echo $key['id']?>" style="display:none;">
      <!-- EL SIGUIENTE INPUT CAMBIA DE VALOR SEGUN UN SELECT DE ARTICULOS -->
      <input type="text" name="articuloOriginal" value="<?php echo $key['idArticulo']?>" style="display:none;">
      <input type="text" id="formularioId<?php echo $key['id']?>" name="articulo" value="<?php echo $key['idArticulo']?>" style="display:none;">
        
          <select required onchange="tomarId(this.value,<?php echo $key['id']?>,<?php echo $key['cantidad']?>)" class="mdb-select md-form" searchable="Buscar">
            <?php foreach ($articulos as $articulo):?>
            <?php if($articulo['nombre']==$key['nombre']){?>
            <option selected value="<?php echo $articulo['articulo']?>"><?php echo $articulo['nombre']?> (<?php echo "en stock: ".$articulo['cantidad']?>)</option>
            <?php }else{?>
            <option value="<?php echo $articulo['articulo']?>"><?php echo $articulo['nombre']?> (<?php echo "en stock: ".$articulo['cantidad']?>)</option>
            <?php } ?>
            <?php endforeach?>
          </select>
        
        <div id="cantidadNo<?php echo $key['id']?>" class="md-form">
            <input type="number" name="cantidad" value="<?php echo $key['cantidad']?>" class="form-control">
            <label for="cantidadNo<?php echo $key['id']?>" class="active">Cantidad</label>
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
