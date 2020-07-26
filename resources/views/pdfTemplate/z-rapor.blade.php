<style>
    div{
        font-size: 13px;
    }
    .app-title {
        text-align: center;
        font-size: 13px;
        font-weight: bold;
    }

    .second-app-title{
        text-align: center;
        font-size: 10px;
    }
    .rapor-detail{
        margin-left: 10px;
    }
    .detail-text{
        font-size: 10px;
    }
</style>


<p class="app-title">
    ZEKI USTA
</p>

<p class="second-app-title">
    {{$storeName}}
</p>

<div class="rapor-detail">
   <div>
       <span class="detail-text">
           Tarih:  {{date('Y-m-d', time())}}
       </span>
   </div>
    <div>
       <span class="detail-text">
           Saat:  {{date('H:i', time())}}
       </span>
    </div>
    <div>
       <span class="detail-text">
           Fis No: {{$fisNo}}
       </span>
    </div>
</div>
<div style="margin: 7px 0">
    .......................... Z RAPORU .........................
</div>

<div>
    Z RAPOR NO:  {{$raporNo}}
</div>
<div style="margin: 7px 0">
    ............... GUNLUK FIS DOKUMU ...................
</div>
<div>
    Toplam: {{$totalCount}}
</div>
<div style="margin: 7px 0">
    .................. ODEME BILGILERI ......................
</div>
<div>
    <div>
        Nakit: {{$cashPay}} tl
    </div>
    <div>
        Kredi: {{$creditCard}} tl
    </div>
    <div>
        Toplam: {{$total}} tl
    </div>
</div>
<div style="margin: 7px 0">
    ...................... FIS SAYILARI ..........................
</div>
<div>
    <div>
        Mali Fis Sayisi: {{$totalCount}}
    </div>
    <div>
        Toplam: {{$totalCount}}
    </div>
</div>
