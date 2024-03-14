<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{$recibos}}

    <p>Ingresos: {{$totalSum}}</p>

    <p>Cantidad de Folios Utilizados: {{$totalFolios}}</p>

    <p>Folio Inicial: {{$folioInicial}}</p>

    <p>Folio Final: {{$folioFinal}}</p>

    <p>Del: {{$fechaInicialFormateada}}</p>

    <p>Al: {{$fechaFinalFormateada}}</p>

    <p>Fecha de Elaboración del Informe: {{$fechaFinalFormateada}}</p>

    <p>{{$grupos}}</p>

</body>
</html>
