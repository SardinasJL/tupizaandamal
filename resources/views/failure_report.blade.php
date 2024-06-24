<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        @page {
            margin: 2cm 2cm 2cm 2cm;
        }
        table{
            border-collapse: collapse;
            width: 100%;
        }
        th{
            background-color: cyan;
        }
        td, th{
            border: 1px solid;
        }
        h1{
            text-align: center;
            margin-top: 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
<header>
<p>Práctica Profesional IV</p>
</header>
<main>
    <h1>Failures</h1>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Location</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($failures as $failure)
            <tr>
                <td>{{$failure->id}}</td>
                <td style="text-align: center">{{$failure->location}}</td>
                <td>{{$failure->latitude}}</td>
                <td>{{$failure->longitude}}</td>
                <td style="text-align: center">{{$failure->description}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
<footer>
    <p>{{now()}}</p>
</footer>
</body>
</html>
