<style>
    .header{
        margin-left: 25mm;
        font-size:5mm;
    }
    .header-alt{
        margin-left: 29mm;
        font-size:5mm;
    }
    .siparis-title{
        font-size: 3mm;
        margin-top: 1mm;
        margin-left: 22mm;
    }
    .siparis-line{
        font-size: 1mm;
        width: 45mm;
    }
    .user-title{
        margin-top: 3mm;
        margin-left:4mm;
        font-size: 3mm;
    }
    .date-line{
        margin-top: 1mm;
        border: 1px solid #0e0e0e;
        margin-left:2mm;
        margin-bottom:1mm;
        font-size: 3mm;
        padding: 1mm;
    }
    .urun-title{
        font-size: 2mm;
        margin: 0mm;
        padding: 0mm;
    }
    .urun-title-content{
        font-size: 3mm;
        margin: 0mm;
        padding: 0mm;
    }
    .m-hr{
        margin: 0mm;
    }
    .adisyon{
        font-size: 4mm;
        margin: 0mm;
        padding: 0mm;
    }
    .table-ürün-title{
        padding-right:45mm;
    }
    .table-order-name{
        padding-right:20mm;
    }

</style>









<div class='header'>ZEKİ USTA</div>
<div class='header-alt'>KEBAP</div>
<div class='siparis-title'>PAKET SİPARİŞİDİR</div>
<div class='user-title'>Sipariş No:{$orderId} {$OrderDetay['username']}</div>
<div class='date-line'>Tarih:{$orderDataYear}  Saat:{$orderDataday}  Masa No:Paket</div>
<table class='urun-title'>
    <tr>
        <th class='table-ürün-title' >Ürünler</th>
        <th style='padding-right:2mm'>Adet</th>
        <th>Tutar</th>
    </tr>
</table>
<hr class='m-hr'>
<table class='urun-title-content'>
    <tr>
        <td class='table-order-name'>{$orderName}</td>
        <td style='padding-right:1mm'>{$value["count"]}</td>
        <td>{$value['price']}tl</td>
    </tr>
    <tr>
        <td class='table-order-name'>{$resultOrderName}</td>
        <td style='padding-right:1mm'>{$resultvalue["count"]}</td>
        <td>{$value['price']}tl</td>
    </tr>
</table>
<hr class='m-hr'>
<table class='adisyon'>
    <tr>

        <td>Adisyon Toplam:</td>

        <td>{$OrderDetay['order_amount']} TL</td>

    </tr>
</table>

<div style='font-size: 4mm;margin-top: 5mm;margin-bottom: 1mm;margin-left: 8mm'> <u>Ödenecek Toplam Tutar : {$OrderDetay['order_amount']} TL </u></div>
<div style='margin-left:25mm;font-size: 3mm'><i>Teşekkür Ederiz</i></div>

<div style='left: 3mm ; margin-top: 10mm;font-size: 4mm'> {$OrderDetay['adress']}</div>
<div style='font-size: 4mm;left: 3mm;margin-top: 1mm'>Arayan No: {$OrderDetay['phone']}</div>
