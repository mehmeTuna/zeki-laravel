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

        .toplam {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h3 style="text-align: center; font-weight: 100">ZEKİ USTA KEBAP <br>Gunluk z-rapor</h3>
<p style="text-align: left; font-weight: 200">
    Tarih: {{date('Y-m-d', time())}}
<br>
    Saat: {{date('H:i', time())}}
</p>

<h4 style="text-align: center; font-weight: 300">MALI HAFIZA RAPORU</h4>
<table>
    <tr>
        <th style="text-align: left">
            <p style="font-weight: 300">
                Kredi Karti: {{round($kredi, 2)}}₺
            </p>
        </th>
    </tr>
    <tr>
        <th style="text-align: left">
            <p style="font-weight: 300">
                Nakit: {{round($nakit, 2)}}₺
            </p>
        </th>
    </tr>
    <tr>
        <th style="text-align: left">
            <p style="font-weight: 300">
                Kapida Pos: {{round($kapidaPos, 2)}}₺
            </p>
        </th>
    </tr>
    <tr class="toplam">
        <th style="text-align: left">
            <p style="font-weight: 300">
                Toplam: {{round($toplam, 2)}}₺
            </p>
        </th>
    </tr>
</table>

</body>
</html>
