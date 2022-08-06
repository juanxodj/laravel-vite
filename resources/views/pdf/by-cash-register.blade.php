<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #table {

            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <p style="text-align: center;"><b>Reporte de Caja</b></p>
    <table id="table">
        <tbody>
            <tr>
                <td style="width: 25%;"><b>Fecha/Hora de Apertura:</b></td>
                <td style="width: 25%;">{{ $opening }}</td>
                <td style="width: 25%;"><b>Balance Inicial:</b></td>
                <td style="width: 25%;">{{ number_format($initial_balance, 2) }}</td>
            </tr>
            <tr>
                <td style="width: 25%;"><b>Fecha/Hora de Cierre:</b></td>
                <td style="width: 25%;">{{ $closing }}</td>
                <td style="width: 25%;"><b>Balance Final:</b></td>
                <td style="width: 25%;">{{ number_format($ending_balance, 2) }}</td>
            </tr>
            <tr>
                <td style="width: 25%;"><b>Usuario de Caja:</b></td>
                <td style="width: 25%;">{{ $cash_register['user_name'] }}</td>
                <td style="width: 25%;"><b>Diferencia:</b></td>
                <td style="width: 25%;">{{ number_format($match, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <p><b>Movimientos</b></p>
    <table id="table">
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;"><b>#</b></th>
                <th style="width: 22.5%; text-align: center;"><b>Tipo</b></th>
                <th style="width: 22.5%; text-align: center;"><b>Producto</b></th>
                <th style="width: 22.5%; text-align: center;"><b>Monto Ingreso</b></th>
                <th style="width: 22.5%; text-align: center;"><b>Monto Egreso</b></th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalIncome = 0;
                $totalExpense = 0;
            @endphp
            @foreach ($movements as $key => $movement)
                <tr>
                    <td style="width: 10%; text-align: center;">{{ $key + 1 }}</td>
                    <td style="width: 22.5%; text-align: center;">{{ $movement['type'] }}</td>
                    <td style="width: 22.5%;">{{ $movement['product']['description'] }}</td>
                    @if ($movement['type'] === 'Ingreso')
                        <td style="width: 22.5%; text-align: center;">{{ $movement['total'] }}</td>
                        <td style="width: 22.5%; text-align: center;">-</td>
                        @php
                            $totalIncome += $movement['total'];
                        @endphp
                    @else
                        <td style="width: 22.5%; text-align: center;">-</td>
                        <td style="width: 22.5%; text-align: center;">{{ $movement['total'] }}</td>
                        @php
                            $totalExpense += $movement['total'];
                        @endphp
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: center;" colspan="3">-</td>
                <td style="text-align: center;">{{ number_format($totalIncome, 2) }}</td>
                <td style="text-align: center;">{{ number_format($totalExpense, 2) }}</td>
            </tr>
        </tfoot>
    </table>
    <p><b>Arqueo de Caja</b></p>
    <table id="table">
        <tbody>
            <tr>
                <th style="width: 25%; text-align: center;"><b>200</b></th>
                <th style="width: 25%; text-align: center;"><b>100</b></th>
                <th style="width: 25%; text-align: center;"><b>50</b></th>
                <th style="width: 25%; text-align: center;"><b>20</b></th>
            </tr>
            <tr>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_200'] }}</td>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_100'] }}</td>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_50'] }}</td>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_20'] }}</td>
            </tr>
            <tr>
                <th style="width: 25%; text-align: center;"><b>10</b></th>
                <th style="width: 25%; text-align: center;"><b>5</b></th>
                <th style="width: 25%; text-align: center;"><b>1</b></th>
                <th style="width: 25%; text-align: center;"><b>Total</b></th>
            </tr>
            <tr>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_10'] }}</td>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_5'] }}</td>
                <td style="width: 25%; text-align: center;">{{ $settlement['bill_1'] }}</td>
                <td style="width: 25%; text-align: center;">{{ $settlement['total'] }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
