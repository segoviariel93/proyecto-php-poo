<div class="container-fluid">
<?php
$usuario=Utils::GetIdentity()
?>
    <form action="<?= base_url ?>categoria/save" method="POST">
        <div  class="form-group">
            <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $usuario->id ?>" />
            </div>
                <div class="form-group" style="width: 50%;">
                    <label for="id">Id</label>
                    <input type="text" name="id" value="<?= $categoria->getId() ?>" disabled/>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required value="<?php echo $categoria->getNombre() ?>" />
                </div>
                <div class="text-center">
                    <input type="submit" value="Guardar" class="btn btn-sm btn-outline-success" />
                    <a class="btn btn-sm btn-outline-danger" href="index">Cancelar</a> 
                </div>
                </form>
            </div>