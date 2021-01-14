<?php $ent=new  Entrada();
$entradas=$ent->getAll();
?>
<div class="card">
    <div class="card-header">
       
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
                id
            </div>
            <div class="col-sm-4">
                Titulo
            </div>
            <div class="col-sm-3">
                Categoria
            </div>
            <div class="col-sm-3">
                Operaciones
            </div>
        </div>


        <?php foreach ($entradas as $entrada) { 
            $categoria=new Categoria();
            $categoria->get($entrada->getCategoria_id())
            ?>
            <div class="row p-1">
                <div class="col-sm-2">
                    <?= $entrada->getId() ?>
                </div>
                <div class="col-sm-4">
                    <?= $entrada->getTitulo() ?>
                </div>
                <div class="col-sm-3">
                    <?=  $categoria->getNombre() ?>
                </div>
                <div class="col-sm-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#entrada<?= $entrada->getId() ?>">
                        Ver
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="entrada<?= $entrada->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"> <?= $entrada->getTitulo() ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= $entrada->getDescripcion() ?>
                                </div>
                                <div class="modal-footer">
                                    <p class="text-right">
                                        Fecha Creación:
                                        <?= $entrada->getFecha() ?>
                                    </p>
                                    <br/>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>