<?php
include("koneksi.php");
$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

for($bulan=1;$bulan<13;$bulan++){
    $query = mysqli_query($conn, "SELECT SUM(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'");
    $row = $query ->fetch_array();
    $jumlah_produk[]=$row['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Bulan ChartJS</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>
<body>
<div style="width:800px; height:800px">
    <canvas id="mychart"></canvas>
</div>

<script>
var ctx = document.getElementById("mychart").getContext('2d');
var mychart = new Chart(ctx, {
    type:'pie',
    data:   {
        labels: <?php echo json_encode($label);?>,
        datasets:[{
            label: 'Grafik Penjualan',
            data: <?php echo json_encode($jumlah_produk);?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes:[{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>
</body>
</html>