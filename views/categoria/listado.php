<div class="container-fluid">
    <h3 class="card-title">Administrar Categorías</h3>
    <hr><br>
    <div class="text-right">
       <a class="btn btn-sm btn-outline-primary" href="crear">Agregar</a> 
       <br>
       <br>
    </div>
    <form action="<?=base_url?>categoria/crear" method="POST">
        <table class='table  table-striped table-sm'>
            <thead class="thead-dark">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
            </thead>
            <tbody>
                <?php while($cat = $categorias->fetch_object()): ?>
                    <tr>
                        <td><?=$cat->id?></td>
                        <td><?=$cat->nombre?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>
</div>

