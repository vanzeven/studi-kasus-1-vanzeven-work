<!DOCTYPE html>
<html>
<head>
    <title>Chart</title>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js" integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <br>
    <img class="img img-responsive" src="img/logo2-40x40.png" />
    <button onclick="document.location='timeline.php'">Back to table</button>
    <h4>Trend of Reason</h4>
    <canvas id="myChart"></canvas>
    <?php
    // Koneksikan ke database
    $kon = mysqli_connect("localhost","root","","pweb");
    //Inisialisasi nilai variabel awal
    $nama_jurusan= "";
    $jumlah=null;
    //Query SQL
    $sql="select jurusan,COUNT(*) as 'total' from mahasiswa GROUP by jurusan";
    $sql2="select nama,umur as from mahasiswa";
    $hasil=mysqli_query($kon,$sql);
    $hasil2=mysqli_query($kon,$sql2);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai jurusan dari database
        $jur=$data['jurusan'];
        $nama_jurusan .= "'$jur'". ", ";
        //Mengambil nilai total dari database
        $jum=$data['total'];
        $jumlah .= "$jum". ", ";
    }

    ?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_jurusan; ?>],
            datasets: [{
                label:'Data Jurusan Mahasiswa ',
                backgroundColor: ['rgba(56, 86, 255, 0.87)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
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