<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<?php
    $db = \Config\Database::connect();
    ?>




    <div class="container mt-5">
        <h1>APARATOS</h1>
        <a href="<?= base_url('aparatos/create') ?>" class="btn btn-success">Agregar</a>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Serie</th>
                    <th>Disco</th>
                    <th>RAM</th>
                    <th>S.O.</th>
                    <th>Propiedad</th>
                    <th>Acciones</th>
                    <th>Fecha Compra</th>
                    <th>Valor Compra</th>
                    <th>Área</th>
                  
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aparatos as $aparato): ?>

                    <?php
                    $tipo = $db->query("SELECT nombreTipo FROM tipo_aparatos WHERE idTipo = ?", [$aparato['tipo']])->getRow();
                    $tipoAparato = $tipo ? $tipo->nombreTipo : 'N/A';
                    ?>

                    <tr>
                        <td><?= $aparato['idAparato'] ?></td>
                        <td><?= $tipoAparato ?></td>
                        <td><?= $aparato['marca'] ?></td>
                        <td><?= $aparato['modelo'] ?></td>
                        <td><?= $aparato['serie'] ?></td>
                        <td><?=($aparato['disco'] != 0) ? $aparato['disco'] : null;?></td>
                        <td><?=($aparato['ram'] != 0) ? $aparato['ram'] : null;?></td>
                        <td><?= $aparato['so'] ?></td>
                        <td><?= $aparato['propiedad'] ?></td>
                        <td><?= $aparato['acciones'] ?></td>
                        <td><?= $aparato['fecha_compra']!='0000-00-00' ? $aparato['fecha_compra'] : null; ?></td>
                        <td><?=($aparato['valor_compra'] != 0) ? $aparato['valor_compra'] : null;?></td>
                        <td><?= $aparato['area'] ?></td>
                        <td>
                            <a href="<?= site_url('aparatos/edit/' . $aparato['idAparato']) ?>" class="btn btn-warning">Editar</a>
                            <a href="<?= site_url('aparatos/delete/' . $aparato['idAparato']) ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este aparato?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="<?php echo base_url('tipos_aparatos'); ?>" class="btn btn-secondary"><-ATRÁS</a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
