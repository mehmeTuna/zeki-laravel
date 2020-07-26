<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2 style="text-align: center">ZEKİ USTA KEBAP Urun İstatistikleri</h2>
<h3 style="text-align: right">{{date('Y-m-d', time())}}</h3>
<table>
    <tr>
        <th>Urun</th>
        <th>Gunluk Siparis</th>
        <th>Haftalik Siparis</th>
        <th>Aylik Siparis</th>
        <th>Yillik Siparis</th>
    </tr>

<?php $sum = ['day' => 0, 'week' => 0, 'month' => 0, 'year' => 0];?>
    @foreach($order as $key => $value)
        <?php  $sum['day']+=$value['day']; $sum['week']+=$value['week']; $sum['month']+=$value['month']; $sum['year']+=$value['year']?>
        <tr>
                <th>{{$value['name']}}</th>
                <th>{{$value['day']}}</th>
                <th>{{$value['week']}}</th>
                <th>{{$value['month']}}</th>
                <th>{{$value['year']}}</th>
            </tr>
    @endforeach
    <tr>
        <th>Toplam Satis Adetleri</th>
        <th>{{$sum['day']}}</th>
        <th>{{$sum['week']}}</th>
        <th>{{$sum['month']}}</th>
        <th>{{$sum['year']}}</th>
    </tr>
</table>

</body>
</html>
