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
        <h1>CREAR RESPONSIVA</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('responsivas/new') ?>" method="post">
            <div class="form-group">
                <label for="idEmpleado">Empleado:</label>
                <select name="idEmpleado" id="idEmpleado" class="form-control" required>
                    <option value="">Seleccionar empleado</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?= $empleado['idEmpleado'] ?>"><?= $empleado['nombreCompleto'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idAparato">Aparato:</label>
                <select name="idAparato" id="idAparato" class="form-control" required>
                    <option value="">Seleccionar aparato</option>
                    <?php foreach ($aparatos as $aparato): ?>
                        <option value="<?= $aparato['idAparato'] ?>"><?= $aparato['marca'] . ' ' . $aparato['modelo'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="<?= site_url('responsivas') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
