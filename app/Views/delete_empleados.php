<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Empleado</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <div class="container mt-5">
        <h1>Eliminar Empleado</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('empleados/delete') ?>" method="post">
            <div class="form-group">
                <label for="idEmpleado">Seleccione el Empleado a Eliminar:</label>
                <select name="idEmpleado" id="idEmpleado" class="form-control" required>
                    <option value="">Seleccionar empleado</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?= $empleado['idEmpleado'] ?>"><?= $empleado['nombreCompleto'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="button">Eliminar</button>
            <a href="<?= site_url('empleados') ?>" class="button">Cancelar</a>
        </form>
    </div>
</body>
</html>
