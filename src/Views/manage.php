<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Plugin Buscador de Certificados</title>
</head>

<body>
    <div class="container">
        <h1>Hello in dashboard</h1>

        <h3>Información sobre las Propiedades de Base de Datos del Plugin</h3>
        <hr>
        <form action="" class="form">
            <div class="py-2">
                <div class="input-group">
                    <span class="input-group-text">Servidor de la base de datos</span>
                    <input type="text" readonly aria-label="Database host" class="form-control" value="<?= $db->host ?>">
                </div>
            </div>
            <div class="py-2">
                <div class="input-group">
                    <span class="input-group-text">Nombre de la base de datos</span>
                    <input type="text" readonly aria-label="Database name" class="form-control" value="<?= $db->db ?>">
                </div>
            </div>
            <div class="py-2">
                <div class="input-group">
                    <span class="input-group-text">Usuario de conexión</span>
                    <input type="text" readonly aria-label="Database user" class="form-control" value="<?= $db->user ?>">
                </div>
            </div>
            <div class="py-2">
                <div class="input-group">
                    <span class="input-group-text">Clave</span>
                    <input type="text" readonly aria-label="Database name" class="form-control" value="<?= $db->password ?>">
                </div>
            </div>
        </form>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>Tabla</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>alumno</td>
                    <td>
                        <?php if ($existAlumnosTable) : ?>
                            <p> <span class="text-success" >Existe</span> </p>
                        <?php else : ?>
                            <p> <span class="text-danger" >No existe en la base de datos '<?=$db->db?>'</span> </p>

                        <?php endif; ?>

                    </td>

                </tr>
                <tr>
                    <td>certificado</td>
                    <td>
                        <?php if ($existAlumnosTable) : ?>
                            <p> <span class="text-success" >Existe</span> </p>
                        <?php else : ?>
                            <p> <span class="text-danger" >No existe en la base de datos '<?=$db->db?>'</span> </p>

                        <?php endif; ?>

                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td></td>

                </tr>
            </tbody>
        </table>

        <hr>
        <h3>Lista de shortcodes [/]</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Shortcode</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($shortcodes as $shortcode):?>
                    <tr>
                        <td>
                            <?=$shortcode->description?>
                        </td>
                        <td>
                            <input type="text" name="" readonly id="" value="<?=$shortcode->shortcode?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>