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

<h2 style="text-align: center">ZEKİ USTA KEBAP Gunluk z-rapor</h2>
<h4 style="text-align: right">Tarih: {{date('Y-m-d', time())}}</h4>
<h3 style="text-align: right;">Toplam Satis Tutari: {{$totalPrice}} ₺</h3>
<table>
    <tr>
        <th style="text-align: center">Iptal Olan Sipris Sayisi</th>
        <th style="text-align: center">Onaylanan(Kuryeye Verilen) Siparis Sayisi</th>
    </tr>
    <tr>
        <th style="text-align: center">{{$totalIptal}}</th>
        <th style="text-align: center">{{$totalCount}}</th>
    </tr>
</table>
<h3 style="text-align: center; margin-top: 30px">Magazalar ve Onaylanan Siparis Adetleri</h3>
<table>
    <tr>
        <th style="text-align: center">Magaza</th>
        <th style="text-align: center">Adet</th>
    </tr>
    @if(count($store) >0)
        @foreach($store as $key => $item)
            <tr>
                <th style="text-align: center">{{$item['name']}}</th>
                <th style="text-align: center">{{$item['count']}}</th>
            </tr>
        @endforeach
    @endif
</table>
<h3 style="text-align: center; margin-top: 30px">Gunluk Kuryeye Verilen Siparisler ve Adetleri</h3>
<table>
    <tr>
        <th style="text-align: center">Kurye</th>
        <th style="text-align: center">Adet</th>
    </tr>
    @if(count($kurye) >0)
        @foreach($kurye as $key => $item)
            <tr>
                <th style="text-align: center">{{$item['name']}}</th>
                <th style="text-align: center">{{$item['count']}}</th>
            </tr>
        @endforeach
    @endif
</table>
<h3 style="text-align: center; margin-top: 30px">Gunluk Satilan Urunler ve Adetleri</h3>
<table>
    <tr>
        <th style="text-align: center">Urun</th>
        <th style="text-align: center">Adet</th>
    </tr>
    @if(count($order) >0)
        @foreach($order as $key => $item)
            <tr>
                <th style="text-align: center">{{$item['name']}}</th>
                <th style="text-align: center">{{$item['day']}}</th>
            </tr>
        @endforeach
    @endif
</table>



</body>
</html>
