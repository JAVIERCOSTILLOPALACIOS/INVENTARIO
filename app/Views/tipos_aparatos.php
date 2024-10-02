

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body >
    <h1>TIPO APARATOS</h1>
    <table border="1" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tipos_aparatos as $aparato): ?>
                <tr>
                    <td><?php echo $aparato['idTipo']; ?></td>
                    <td><?php echo $aparato['nombreTipo']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

 
    <a href="<?php echo base_url('aparatos'); ?>" class="btn btn-primary">LISTA DE APARATOS</a>
    <a href="<?php echo base_url('MENU'); ?>" class="btn btn-secondary"><-ATRÁS</a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>


