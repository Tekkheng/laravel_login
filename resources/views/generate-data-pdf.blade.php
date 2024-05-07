<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>{{ $title }}</h2>
    <h2>Date: {{ $date }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe Truck</th>
                <th>Plat No</th>
                <th>Jadwal Berangkat</th>
                <th>Jadwal Sampai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->tipe_truck}}</td>
                <td>{{$data->plat_no}}</td>
                <td>{{$data->tgl_berangkat}}</td>
                <td>{{$data->tgl_sampai}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>