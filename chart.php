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
    <canvas id="myChart"></canvas>
    <?php
    // Koneksikan ke database
    $kon = mysqli_connect("localhost","root","","pweb");
    //Inisialisasi nilai variabel awal
    $nama=null;
    $umur=null;
    //Query SQL
    $sql="select no,umur from mahasiswa";
    $hasil=mysqli_query($kon,$sql);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai jurusan dari database
        $nam=$data['no'];
        $nama .= "'$nam'". ", ";
        //Mengambil nilai total dari database
        $um=$data['umur'];
        $umur .= "$um". ", ";
    }

    ?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama; ?>],
            datasets: [{
                label:'Trend of Reason',
                backgroundColor: ['rgba(56, 86, 255, 0.87)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $umur; ?>]
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