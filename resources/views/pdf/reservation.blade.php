<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation {{ $reservation->no_reservation }}</title>
    <style>
        html, body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        .table-detail tr td {
            padding: 4px 8px 4px 0;
        }
        .mb-5 {
            margin-bottom: 2rem !important;
        }
        .text-center { text-align: center; }
        .mytable thead tr th, 
        .mytable tbody tr td {
            padding: 4px 2px;
            border: 1px solid #555;
            font-size: 12px;
        }
        .mytable thead tr th {
            vertical-align: middle !important;
        }
        .mytable tbody tr td {
            vertical-align: top !important;
        }
    </style>
</head>
<body>
    <div class="mb-5">
        <p style="font-size: 16px;"><b>Detail Reservation</b></p>
        <table class="table-detail" style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 160px; white-space: nowrap;">No Reservation</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->no_reservation }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Tanggal</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->tanggal }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Section</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->section }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Reason</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->reason }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Category</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->category }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Developer</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->developer }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Model</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->model }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Article</td>
                <td style="width: 10px;">:</td>
                <td>{{ $reservation->article }}</td>
            </tr>
            <tr>
                <td style="width: 160px; white-space: nowrap;">Remarks</td>
                <td style="width: 10px;">:</td>
                <td>
                    
                </td>
            </tr>
        </table>
    </div>

    <p style="font-size: 16px;"><b>Detail Material</b></p>
    <table class="mytable" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th class="text-center text-nowrap">No</th>
                <th class="text-center text-nowrap">Code Item</th>
                <th class="text-center text-nowrap">Description</th>
                <th class="text-center text-nowrap">Colour</th>
                <th class="text-center text-nowrap">UoM</th>
                <th class="text-center text-nowrap">Size</th>
                <th class="text-center text-nowrap">Req. Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materials as $material)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $material->material_code }}</td>
                    <td>{{ $material->description }}</td>
                    <td>{{ $material->colour }}</td>
                    <td>{{ $material->uom }}</td>
                    <td>{{ $material->size }}</td>
                    <td>{{ $material->req_qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>