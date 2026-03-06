<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Grupales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../img/iconnnn.jpg" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-light">

    <?php
    require "../connection/conexion.php";
    require "crud/registrar.php";
    require "crud/editar.php";
    require "crud/eliminar.php";
    ?>

    <script>
        function eliminar() {
            let res = confirm("¿Desea eliminar este registro permanentemente?");
            return res;
        }
    </script>

    <div class="container py-5">
        
        <h1 class="text-center mb-4 fw-bold text-light ">Consultas Grupales</h1>

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <button type="button" class="btn btn-success fw-bold px-4" data-bs-toggle="modal" data-bs-target="#staticBackdropInsertar">
                        + Registrar Nueva
                    </button>
                    <a href="addEnfermedad.php" class="btn btn-outline-secondary fw-bold px-4">Regresar al Panel</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Ruta Img</th>
                                <th scope="col" class="text-center">Imagen</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = $conexion->query("SELECT * FROM registro_enfermedades");
                            while ($datos = $sql->fetch_object()) { 
                                // Ajustamos la ruta de la imagen
                                $ruta_imagen = $datos->ruta_imagen;
                            ?>
                            <tr>
                                <th scope="row" class="text-center"><?php echo $datos->id ?></th>
                                <td class="fw-semibold text-primary"><?php echo $datos->nombre ?></td>
                                <td><?php echo $datos->descripcion ?></td>
                                <td class="text-muted small"><?php echo $datos->ruta_imagen ?></td>
                                <td class="text-center">
                                    <img width="80" height="80" src="<?= $ruta_imagen ?>" alt="enfermedad" class="img-thumbnail rounded" style="object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a data-bs-toggle="modal" data-bs-target="#staticBackdropEditar<?= $datos->id ?>" class="btn btn-warning btn-sm fw-bold">Editar</a>
                                        <a href="consultas_Grupal.php?id=<?= $datos->id ?>" class="btn btn-danger btn-sm fw-bold" onclick="return eliminar()">Eliminar</a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="staticBackdropEditar<?= $datos->id ?>" tabindex="-1" aria-labelledby="staticBackdropLabel">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title fw-bold" id="staticBackdropLabel">Modificar Enfermedad</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" enctype="multipart/form-data" method="post">
                                                <input type="hidden" value="<?= $datos->id ?>" name="id">
                                                <input type="hidden" value="<?= $datos->ruta_imagen ?>" name="ruta_actual">

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nombre:</label>
                                                    <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Descripción:</label>
                                                    <textarea name="descripcion" class="form-control" rows="3" required><?= $datos->descripcion ?></textarea>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label fw-bold">Nueva Imagen (Opcional):</label>
                                                    <input type="file" class="form-control" name="imagen">
                                                </div>

                                                <div class="d-grid">
                                                    <input type="submit" value="Guardar Cambios" name="btneditar" class="btn btn-success fw-bold">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropInsertar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Registrar Nueva Enfermedad</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="" enctype="multipart/form-data" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej. Gripe" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Descripción:</label>
                            <textarea name="descripcion" class="form-control" rows="3" placeholder="Ej. Es una enfermedad muy contagiosa" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Imagen:</label>
                            <input type="file" class="form-control" name="imagen">
                        </div>

                        <div class="d-grid">
                            <input type="submit" value="Registrar" name="btnregistrar" class="btn btn-success fw-bold">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>