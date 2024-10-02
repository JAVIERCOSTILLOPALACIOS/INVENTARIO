<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsivas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    $db = \Config\Database::connect();
    ?>

    <div class="container mt-5">
        <h1>RESPONSIVAS</h1>

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

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Aparato</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Documento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responsivas as $responsiva): ?>
                    <?php
                    // Obtener nombres
                    $empleado = $db->query("SELECT nombreCompleto FROM empleados WHERE idEmpleado = ?", [$responsiva['idEmpleado']])->getRow();
                    $nombreEmpleado = $empleado ? $empleado->nombreCompleto : 'N/A';
                    
                    $aparato = $db->query("SELECT nombreTipo, marca, modelo, serie FROM aparatos JOIN tipo_aparatos ON (tipo = idTipo) WHERE idAparato = ?", [$responsiva['idAparato']])->getRow();
                    $nombreTipo = $aparato ? $aparato->nombreTipo : 'N/A';
                    $marca = $aparato ? $aparato->marca : 'N/A';
                    $modelo = $aparato ? $aparato->modelo : 'N/A';
                    $serie = $aparato ? $aparato->serie : 'N/A';
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="seleccion[]" value="<?php echo $responsiva['idResponsiva']; ?>">
                        </td>
                        <td><?= $responsiva['idResponsiva'] ?></td>
                        <td><?= $nombreEmpleado ?></td>
                        <td><?= "$nombreTipo, $marca, $modelo, $serie" ?></td>
                        <td><?= $responsiva['fecha_inicio'] ?></td>
                        <td><?= $responsiva['fecha_fin'] ? $responsiva['fecha_fin'] : 'N/A' ?></td>
                        <td>
                            <button class="btn btn-success" onclick='descargarPDF(<?= json_encode(array_merge($responsiva, ["nombreEmpleado" => $nombreEmpleado, "aparato" => ["nombreTipo" => $nombreTipo, "marca" => $marca, "modelo" => $modelo, "serie" => $serie]])) ?>)'>Descargar PDF</button>
                        </td>
                        <td>
                            <?php if (is_null($responsiva['fecha_fin'])): ?>
                                <a href="<?= site_url('responsivas/darBaja/' . $responsiva['idResponsiva']) ?>" class="btn btn-danger">Dar de Baja</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button id="btnGenerarSeleccionados" class="btn btn-danger">Generar PDF de Seleccionados</button>
        <a href="<?= site_url('responsivas/create') ?>" class="btn btn-primary">Crear Nueva Responsiva</a>
    </div>

    <a href="<?php echo base_url('MENU'); ?>" class="btn btn-secondary"><-ATRÁS</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
    document.getElementById('btnGenerarSeleccionados').addEventListener('click', async () => {
        const checkboxes = document.querySelectorAll('input[name="seleccion[]"]:checked');
        const responsivas = {};

        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const nombreEmpleado = row.cells[2].innerText;
            const aparatoDetails = row.cells[3].innerText.split(', ');

            const aparato = {
                nombreTipo: aparatoDetails[0] || 'N/A',
                marca: aparatoDetails[1] || 'N/A',
                modelo: aparatoDetails[2] || 'N/A',
                serie: aparatoDetails[3] || 'N/A',
                fechaInicio: row.cells[4].innerText,
                fechaFin: row.cells[5].innerText ? row.cells[5].innerText : 'N/A'
            };

            if (!responsivas[nombreEmpleado]) {
                responsivas[nombreEmpleado] = {
                    aparatos: []
                };
            }

            responsivas[nombreEmpleado].aparatos.push(aparato);
        });

        for (const [nombreEmpleado, datos] of Object.entries(responsivas)) {
            await generarPDF(nombreEmpleado, datos);
        }
    });

    async function descargarPDF(data) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const content = `
RECIBO DE ENTREGA

Por medio del presente documento, se hace constar la devolución y 
entrega de equipo de trabajo a ${data.nombreEmpleado} para uso exclusivo 
de actividades laborales. El equipo es entregado en óptimas condiciones 
y deberá ser devuelto de la misma forma al término del contrato laboral.

Aparato entregado:
* ${data.aparato.nombreTipo} ${data.aparato.marca} (${data.aparato.modelo}, Serie: ${data.aparato.serie})
- Fecha de Inicio: ${data.fecha_inicio}
- Fecha de Fin: ${data.fecha_fin ? data.fecha_fin : 'N/A'}

El aparato deberá entregarse en perfectas condiciones al finalizar 
el contrato.

FIRMA:
${data.nombreEmpleado}
        `;

        const margenIzquierdo = 20;
        const margenSuperior = 20;

        doc.text(content, margenIzquierdo, margenSuperior);
        doc.save(`responsiva_${data.nombreEmpleado.replace(/\s+/g, '_')}.pdf`);
    }

    async function generarPDF(nombreEmpleado, datos) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const content = `
RECIBO DE ENTREGA

Por medio del presente documento, se hace constar la devolución y 
entrega de equipo de trabajo a ${nombreEmpleado} para uso exclusivo 
de actividades laborales. El equipo es entregado en óptimas condiciones 
y deberá ser devuelto de la misma forma al término del contrato laboral.

Aparatos entregados:
${datos.aparatos.map(ap => `* ${ap.nombreTipo} ${ap.marca} (${ap.modelo}, Serie: ${ap.serie})
  - Fecha de Inicio: ${ap.fechaInicio}
  - Fecha de Fin: ${ap.fechaFin}`).join('\n')}

El aparato deberá entregarse en perfectas condiciones al finalizar 
el contrato.

FIRMA:
${nombreEmpleado}
        `;

        const margenIzquierdo = 20;
        const margenSuperior = 20;

        doc.text(content, margenIzquierdo, margenSuperior);
        doc.save(`responsiva_${nombreEmpleado.replace(/\s+/g, '_')}.pdf`);
    }
    </script>
</body>
</html>

