<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <h1>EDITAR EMPLEADO</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('empleados/update/' . $empleado['idEmpleado']) ?>" method="post">
            <div class="form-group">
                <label for="nombreCompleto">Nombre Completo:</label>
                <input type="text" name="nombreCompleto" id="nombreCompleto" class="form-control" 
                       value="<?= $empleado['nombreCompleto'] ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control" 
                       value="<?= $empleado['correo'] ?>">
            </div>

            <div class="form-group">
                <label for="areaEmpleado">Área:</label>
                <select name="areaEmpleado" id="areaEmpleado" class="form-control" required>
                    <option value="">Seleccionar área</option>
                    <?php foreach ($areas as $area): ?>
                        <option value="<?= $area['idArea'] ?>" <?= $empleado['areaEmpleado'] == $area['idArea'] ? 'selected' : '' ?>>
                            <?= $area['nombreArea'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="<?= site_url('empleados') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
