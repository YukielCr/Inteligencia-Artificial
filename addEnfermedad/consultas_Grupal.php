<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../img/iconnnn.jpg" />
</head>

<body>
    <h1>Consultas Grupales</h1>

    <!-- Connexion con las funciones del CRUD -->
    <?php
    require "../connection/conexion.php";
    require "crud/registrar.php";
    require "crud/editar.php";
    require "crud/eliminar.php";
    ?>

    <!-- Alerta al eliminar un registro -->
    <script>
        function eliminar() {
            let res = confirm("¿Desea eliminar este registro?");
            return res;
        }
    </script>

    <!-- Tabla para mostrar los registros de la base de datos -->
    <div class="p-3 table-responsive">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
            data-bs-target="#staticBackdropInsertar">
            Registrar
        </button>


        <!-- Registro -->
        <div class="modal fade" id="staticBackdropInsertar" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Nuevo registro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="" enctype="multipart/form-data" method="post">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" placeholder="Ej. Gripe" required>


                            <label>Descripción:</label>
                            <textarea name="descripcion" placeholder="Ej. Es una enfermedad muy contagiosa"
                                required></textarea>


                            <label>Imagen:</label>
                            <input type="file" class="form-control mb-2" name="imagen">
                            <input type="submit" value="registrar" name="btnregistrar"
                                class="form-control btn btn-success">
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Boton de Reguistro -->




        <!-- Mostrar los Datos en la Tabla -->
        <table class="table table-hover table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Ruta Img</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = $conexion->query("SELECT * FROM registro_enfermedades");
                while ($datos = $sql->fetch_object()) { 
                    
                    // Ajustamos la ruta de la imagen para que se vea correctamente en esta carpeta
                    $ruta_imagen = $datos->ruta_imagen;
                ?>
                <tr>
                    <th scope="row">
                        <?php echo $datos->id ?>
                    </th>
                    <td>
                        <?php echo $datos->nombre ?>
                    </td>
                    <td>
                        <?php echo $datos->descripcion ?>
                    </td>
                    <td>
                        <?php echo $datos->ruta_imagen ?>
                    </td>
                    <td>
                        <img width="88" src="<?= $ruta_imagen ?>" alt="enfermedad">
                    </td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#staticBackdropEditar<?= $datos->id ?>"
                            class="btn btn-warning">Editar</a>

                        <a href="consultas_Grupal.php?id=<?= $datos->id ?>" class="btn btn-danger"
                            onclick="return eliminar()">Eliminar</a>
                    </td>
                </tr>

                <div class="modal fade" id="staticBackdropEditar<?= $datos->id ?>" tabindex="-1"
                    aria-labelledby="staticBackdropLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar Enfermedad</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" enctype="multipart/form-data" method="post">
                                    <input type="hidden" value="<?= $datos->id ?>" name="id">
                                    <input type="hidden" value="<?= $datos->ruta_imagen ?>" name="ruta_actual">

                                    <label>Nombre:</label>
                                    <input type="text" class="form-control mb-2" name="nombre"
                                        value="<?= $datos->nombre ?>" required>

                                    <label>Descripción:</label>
                                    <textarea name="descripcion" class="form-control mb-2"
                                        required><?= $datos->descripcion ?></textarea>

                                    <label>Nueva Imagen (Opcional):</label>
                                    <input type="file" class="form-control mb-3" name="imagen">

                                    <input type="submit" value="Guardar Cambios" name="btneditar"
                                        class="form-control btn btn-success">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </tbody>
        </table>

    </div>

    <nav>
        <a href="addEnfermedad.php">Regresar</a>
    </nav>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>