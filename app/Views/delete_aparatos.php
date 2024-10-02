<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Aparato</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <div class="container mt-5">
        <h1>Eliminar Aparato</h1>

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

        <form action="<?= site_url('aparatos/delete') ?>" method="post">
            <div class="form-group">
                <label for="idAparato">Seleccione el Aparato a Eliminar:</label>
                <select name="idAparato" id="idAparato" class="form-control" required>
                    <option value="">Seleccionar aparato</option>
                    <?php foreach ($aparatos as $aparato): ?>
                        <option value="<?= $aparato['idAparato'] ?>"><?= $aparato['marca'] . ' ' . $aparato['modelo'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="button">Eliminar</button>
            <a href="<?= base_url('aparatos') ?>" class="button">Cancelar</a>
        </form>
    </div>
</body>
</html>
