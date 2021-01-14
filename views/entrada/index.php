<div class="card">
    <div class="card-header">
        <?php $categoria = new Categoria(); ?>
        <?php $categoria->get(intval($catedoria_idSeleccionada));
        ?>
        <?= $categoria->getNombre() ?>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-sm-10">

            </div>
            <div class="col-sm-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregar">
                    Agregar
                </button>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de nueva entrada</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url ?>entrada/create" method="post">
                        <div class="modal-body">

                            <div class="form-group">

                                <input type="text" class="form-control form-control-sm " style="display: none;" name="categoria_id" id="categoria_id" value="<?= $catedoria_idSeleccionada ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control form-control-sm" placeholder="ingrese el titulo" name="titulo" id="titulo" required />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">descripcion</label>
                                <textarea rows="4" cols="50" type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" placeholder="ingrese una descripción" required></textarea>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <div class="form-group">

                                <input type="submit" class="btn btn-sm btn-outline-dark" value="Guardar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row bg-info border border-dark rounded text-light">
            <div class="col-sm-4 border border-dark">
                Número de entrada
            </div>
            <div class="col-sm-4 border border-dark">
                Titulo
            </div>
            <div class="col-sm-4 border border-dark">
                Operaciones
            </div>
        </div>


        <?php foreach ($entradas as $entrada) { ?>
            <div class="row p-1 ">
                <div class="col-sm-4 border border-secondary rounded">
                    <?= $entrada->getId() ?>
                </div>
                <div class="col-sm-4 border border-secondary rounded">
                    <?= $entrada->getTitulo() ?>
                </div>
                <div class="col-sm-4 border border-secondary rounded">
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
                                    <br />
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($entrada->getUsuario_id() == Utils::GetIdentity()->id) { ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modalEditar<?= $entrada->getId() ?>">
                            Editar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalEditar<?= $entrada->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarTitulo" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="row">
                                        <div class="col-sm-10">

                                        </div>
                                        <div class="col-sm-2 ">

                                        </div>
                                    </div>

                                    <form action="<?= base_url ?>entrada/update" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar entrada</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" id="id" name="id" style="display: none;" value="<?= $entrada->getId() ?>"  required/>
                                            <div class="form-group">
                                                <label for="titulo">
                                                    Título
                                                </label>
                                                <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="<?= $entrada->getTitulo() ?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">
                                                    Descripción
                                                </label>
                                                <textarea text="text" rows="4" cols="50" class="form-control form-control-sm" id="descripcion" name="descripcion" required ><?= $entrada->getDescripcion() ?></textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-sm btn-outline-success">Guardar</button>
                                            <a name="eliminarEntrada" id="eliminarEntrada" formnovalidate="formnovalidate" class="btn btn-danger btn-sm" href="<?= base_url ?>entrada/delete/<?= $entrada->getId() ?>">Eliminar</a>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>

                </div>
            </div>
        <?php } ?>
    </div>
</div>