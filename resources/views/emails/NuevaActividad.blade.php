<html lang="es">
	<head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    	<title>Reporte</title>
    	<link href="/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="/css/app.css" rel="stylesheet">      
        <!---->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!---->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
	</head>
	<body>
    	<div class="container-fluid">
			<div class="row"> 
                <div class="col-12">
                	Hola, {{$data['Nombre']}}<br/>
                    Se ha creado una nueva actividad,
                </div>
            </div>
            <div class="row"> 
                <div class="col-3">
                    Descripcion:
                </div>
                <div class="col-3">
                    {{$data['Descripcion']}}
                </div>
            </div>
            <div class="row"> 
                <div class="col-3">
                    Proxima Actividad:
                </div>
                <div class="col-3">
                    {{$data['ProximaActividad']}}
                </div>
            </div>
            <div class="row"> 
                <div class="col-3">
                    Fecha de proxima revision:
                </div>
                <div class="col-3">
                    {{$data['FechaProximaRevision']}}
                </div>
            </div>
    	</div>
	</body>
</html>