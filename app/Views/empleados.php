<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<body>

    <?php
    $db = \Config\Database::connect();
    ?>


    <div class="container mt-5">
        <h1>EMPLEADOS</h1>
        <a href="<?= base_url('empleados/create') ?>" class="btn btn-success">Agregar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
         

                <?php foreach ($empleados as $empleado): ?>
                    <?php
                    $area = $db->query("SELECT nombreArea FROM areas WHERE idArea = ?", [$empleado['areaEmpleado']])->getRow();
                    $areaEmpleado = $area ? $area->nombreArea : 'N/A';
                    ?>

                    <tr>
                        <td><?= $empleado['idEmpleado'] ?></td>
                        <td><?= $empleado['nombreCompleto'] ?></td>
                        <td><?= $empleado['correo'] ?></td>
                        <td><?= $areaEmpleado ?></td>
                        <td>
                            <a href="<?= site_url('empleados/edit/' . $empleado['idEmpleado']) ?>" class="btn btn-warning">Editar</a>
                            <a href="<?= site_url('empleados/delete/' . $empleado['idEmpleado']) ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este empleado?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="<?php echo base_url('MENU'); ?>" class="btn btn-secondary"><-ATRÁS</a>
</body>
</html>