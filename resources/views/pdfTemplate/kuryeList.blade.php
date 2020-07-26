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

<h2 style="text-align: center">ZEKİ USTA KEBAP Kurye İstatistikleri</h2>
<h3 style="text-align: right">{{date('Y-m-d', time())}}</h3>
<h4 style="text-align: center">Calisan Kuryeler</h4>
<table>
    <tr>
        <th>Kurye</th>
        <th>Gunluk Siparis</th>
        <th>Aylik Siparis</th>
        <th>Yillik Siparis</th>
    </tr>
    @foreach($kurye as $key => $value)
        @if($value['active'])
            <tr>
                <th>{{$value['name']}}</th>
                <th>{{$value['dayOrderCount']}}</th>
                <th>{{$value['monthOrderCount']}}</th>
                <th>{{$value['yearOrderCount']}}</th>
            </tr>
        @endif
    @endforeach
</table>

<h4 style="text-align: center">Silinen Kuryeler</h4>
<table>
    <tr>
        <th>Kurye</th>
        <th>Gunluk Siparis</th>
        <th>Aylik Siparis</th>
        <th>Yillik Siparis</th>
    </tr>
    @foreach($kurye as $key => $value)
        @if(!$value['active'])
            <tr>
                <th>{{$value['name']}}</th>
                <th>{{$value['dayOrderCount']}}</th>
                <th>{{$value['monthOrderCount']}}</th>
                <th>{{$value['yearOrderCount']}}</th>
            </tr>
        @endif
    @endforeach
</table>
</body>
</html>
