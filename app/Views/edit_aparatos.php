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
        <h1>EDITAR APARATO</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('aparatos/update/' . $aparato['idAparato']) ?>" method="post">
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="">Seleccionar tipo</option>
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?= $tipo['idTipo'] ?>" <?= $aparato['tipo'] == $tipo['idTipo'] ? 'selected' : '' ?>>
                            <?= $tipo['nombreTipo'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" name="marca" id="marca" class="form-control" value="<?= $aparato['marca'] ?>" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" id="modelo" class="form-control" value="<?= $aparato['modelo'] ?>" required>
            </div>

            <div class="form-group">
                <label for="serie">Serie:</label>
                <input type="text" name="serie" id="serie" class="form-control" value="<?= $aparato['serie'] ?>" required>
            </div>

            <div class="form-group">
                <label for="area">Área:</label>
                <select name="area" id="area" class="form-control" required>
                    <option value="">Seleccionar área</option>
                    <?php foreach ($areas as $area): ?>
                        <option value="<?= $area['idArea'] ?>" <?= $aparato['area'] == $area['idArea'] ? 'selected' : '' ?>>
                            <?= $area['nombreArea'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="disco">Disco:</label>
                <input type="text" name="disco" id="disco" class="form-control" value="<?= $aparato['disco'] ?>">
            </div>

            <div class="form-group">
                <label for="ram">RAM:</label>
                <input type="text" name="ram" id="ram" class="form-control" value="<?= $aparato['ram'] ?>">
            </div>

            <div class="form-group">
                <label for="so">Sistema Operativo:</label>
                <input type="text" name="so" id="so" class="form-control" value="<?= $aparato['so'] ?>">
            </div>

            <div class="form-group">
                <label for="propiedad">Propiedad:</label>
                <input type="text" name="propiedad" id="propiedad" class="form-control" value="<?= $aparato['propiedad'] ?>">
            </div>

            <div class="form-group">
                <label for="acciones">Acciones:</label>
                <input type="text" name="acciones" id="acciones" class="form-control" value="<?= $aparato['acciones'] ?>">
            </div>

            <div class="form-group">
                <label for="valor_compra">Valor de Compra:</label>
                <input type="text" name="valor_compra" id="valor_compra" class="form-control" value="<?= $aparato['valor_compra'] ?>">
            </div>

            <div class="form-group">
                <label for="fecha_compra">Fecha de Compra (dd/mm/aaaa):</label>
                <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" placeholder="dd/mm/aaaa" 
                       pattern="\d{2}/\d{2}/\d{4}" value="<?= date('d/m/Y', strtotime($aparato['fecha_compra'])) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="<?= site_url('aparatos') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
