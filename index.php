<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
</head>
<body onload = "JavaScript:AutoRefresh(60000);">

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    Ketinggian : <ketinggian></ketinggian><br>
    Kekeruhan : <kekeruhan></kekeruhan><br>
    pH : <pH></pH><br>
    Update : <update></update><br><br>

    Hasil : <hasil></hasil><br>
    <br>

    <script type="text/javascript">

    //Refresh
    function AutoRefresh( t ) {
        setTimeout("location.reload(true);", t);
    }
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyA5O30h-KsmkFPg0qaYw7eQAJi_Q_baKQM",
        authDomain: "monitoring-e9793.firebaseapp.com",
        databaseURL: "https://monitoring-e9793-default-rtdb.firebaseio.com",
        projectId: "monitoring-e9793",
        storageBucket: "monitoring-e9793.appspot.com",
        messagingSenderId: "131986672780",
        appId: "1:131986672780:web:7e65548439176a5be43fa9"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    // var status_pompa = 0;
    // firebase.database().ref('pompa/').set({
    //     status: status_pompa,
    //     }, (error) => {
    //         if (error) {
    //             // The write failed...
    //             console.log("Upload Gagal");
    //         } else {
    //             console.log("Upload Berhasil");
    //         }
    //     });


    var firebaseRef = firebase.database().ref("sensor");
    firebaseRef.limitToLast(1).on("value", function(snapshot){
        var data = snapshot.val();

        
        var _ketinggian = document.querySelector('ketinggian');
        var _kekeruhan = document.querySelector('kekeruhan');
        var _pH = document.querySelector('pH');
        var _update = document.querySelector('update');
        var _hasil = document.querySelector('hasil');



        for(let i in data) {
            console.log(data [i]);

            _ketinggian.innerHTML = data [i].ketinggian;
            _kekeruhan.innerHTML = data [i].kekeruhan;
            _pH.innerHTML = data [i].pH;
            _update.innerHTML = data [i].update;

             // Creating a cookie after the document is ready
             dataKetinggian = parseInt(data [i].ketinggian);
             $(document).ready(function () {
                createCookie("ket", dataKetinggian, "10");
            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                }
                else {
                    expires = "";
                }
                
                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
            }

            console.log("Ketinggian: " +dataKetinggian);
            // Creating a cookie after the document is ready
            dataKekeruhan = parseFloat(data [i].kekeruhan);
            $(document).ready(function () {
                createCookie("kek", dataKekeruhan, "10");
            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                }
                else {
                    expires = "";
                }
                
                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
            }

            console.log("Kekeruhan: " +dataKekeruhan);
            // Creating a cookie after the document is ready
            dataPH = parseFloat(data [i].pH);
            $(document).ready(function () {
                createCookie("ph", dataPH, "10");
            });

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                }
                else {
                    expires = "";
                }
                
                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
            }
            console.log("pH: " +dataPH);
        }

        //coba

        
    });

    </script>

<?php

// $ketinggian = $_COOKIE["ket"]; 
// $kekeruhan = $_COOKIE["kek"]; 
// $ph = $_COOKIE["ph"]; 

$ketinggian = 23; 
$kekeruhan = 1; 
$ph = 7.3; 
$alfa = array();
$zn = 0;
$zt = 0;
$total = 0;
$z = array();
$hasil = 0;

echo $ketinggian;
?> <br> <?php
echo $kekeruhan;
?> <br> <?php
echo $ph;
    

if($ketinggian != 0 && $kekeruhan !=0 && $ph !=0){
    $hasil = perhitungan($ketinggian, $kekeruhan, $ph);
}

function findMin($x, $y, $z){
    if($x <= $y && $x <= $z){
        return $x;
    } elseif($y <= $x && $y <= $z){
        return $y;
    } else{
        return $z;
    }
}

function ketRendah($ketinggian){
    if($ketinggian <= 15){
        return 1;
    } elseif ($ketinggian > 15 && $ketinggian < 20){
        return (20 - $ketinggian) / (20-15);
    } else{
        return 0;
    }
}

function ketNormal($ketinggian){
    if($ketinggian > 20 && $ketinggian <= 25){
        return ($ketinggian - 20) / (25-20);
    } elseif($ketinggian > 25 && $ketinggian < 30){
        return (25 - $ketinggian) / (30-25);
    } else {
        return 0;
    }
}

function ketTinggi($ketinggian){
    if($ketinggian <= 30){
        return 0;
    } elseif ($ketinggian > 30 && $ketinggian < 35){
        return ($ketinggian - 30) / (35-30);
    } else{
        return 1;
    }
}

function kekJernih($kekeruhan){
    if($kekeruhan <= 0){
        return 1;
    } elseif ($kekeruhan > 0 && $kekeruhan < 50){
        return (50 - $kekeruhan) / (50-0);
    } else{
        return 0;
    }
}

function kekKeruh($kekeruhan){
    if($kekeruhan <= 41){
        return 0;
    } elseif ($kekeruhan > 41 && $kekeruhan < 100){
        return ($kekeruhan - 41) / (100-41);
    } else{
        return 1;
    }
}

function phRendah($ph){
    if($ph <= 7){
        return 1;
    } elseif ($ph > 7 && $ph <= 7.5){
        return (7.5 - $ph) / (7.5-7);
    } else{
        return 0;
    }
}

function phNormal($ph){
    if($ph > 7.5 && $ph <= 8){
        return ($ph - 7.5) / (8-7.5);
    } elseif($ph > 8 && $kekeruhan < 8.5){
        return (8.5 - $ph) / (8.5-8);
    } else{
        return 0;
    }
}

function phTinggi($ph){
    if($ph <= 8.5){
        return 0;
    } elseif ($ph > 8.5 && $ph < 9){
        return ($ph - 8.5) / (9-8.5);
    } else{
        return 1;
    }
}

function TambahRendah($alfa){
    if($alfa <= 0){
        return 1;
    } else if($alfa > 0 && $alfa < 1){
        return (20 - ($alfa * (20 - 12)));
    } else{
        return 0;
    }
}

function TambahSedang($alfa){
    if($alfa > 0 && $alfa < 1){
        $zn = (($alfa * (24 - 20)) + 20);
        $zt = (28 - ($alfa * (28 - 24)));
        return $total = ($zn + $zt) / 2;
    } else{
        return 0;
    }
}

function TambahBanyak($alfa){
    if($alfa <= 0){
        return 0;
    } elseif($alfa > 0 && $alfa < 1){
        return (($alfa * (36 - 28)) + 28);
    } else{
        return 1;
    }
}

function perhitungan($ketinggian, $kekeruhan, $ph){
    $alfa[0] = findMin(ketRendah($ketinggian), kekJernih($kekeruhan), phRendah($ph));
    $z[0] = TambahBanyak($alfa[0]);

    $alfa[1] = findMin(ketNormal($ketinggian), kekJernih($kekeruhan), phRendah($ph));
    $z[1] = TambahSedang($alfa[1]);

    $alfa[2] = findMin(ketTinggi($ketinggian), kekJernih($kekeruhan), phRendah($ph));
    $z[2] = TambahRendah($alfa[2]);

    $alfa[3] = findMin(ketRendah($ketinggian), kekJernih($kekeruhan), phNormal($ph));
    $z[3] = TambahRendah($alfa[3]);

    $alfa[4] = findMin(ketNormal($ketinggian), kekJernih($kekeruhan), phNormal($ph));
    $z[4] = TambahRendah($alfa[4]);

    $alfa[5] = findMin(ketTinggi($ketinggian), kekJernih($kekeruhan), phNormal($ph));
    $z[5] = TambahRendah($alfa[5]);

    $alfa[6] = findMin(ketRendah($ketinggian), kekJernih($kekeruhan), phTinggi($ph));
    $z[6] = TambahBanyak($alfa[6]);

    $alfa[7] = findMin(ketNormal($ketinggian), kekJernih($kekeruhan), phTinggi($ph));
    $z[7] = TambahSedang($alfa[7]);

    $alfa[8] = findMin(ketTinggi($ketinggian), kekJernih($kekeruhan), phTinggi($ph));
    $z[8] = TambahRendah($alfa[8]);

    $alfa[9] = findMin(ketRendah($ketinggian), kekKeruh($kekeruhan), phRendah($ph));
    $z[9] = TambahBanyak($alfa[9]);

    $alfa[10] = findMin(ketNormal($ketinggian), kekKeruh($kekeruhan), phRendah($ph));
    $z[10] = TambahSedang($alfa[10]);

    $alfa[11] = findMin(ketTinggi($ketinggian), kekKeruh($kekeruhan), phRendah($ph));
    $z[11] = TambahSedang($alfa[11]);

    $alfa[12] = findMin(ketRendah($ketinggian), kekKeruh($kekeruhan), phNormal($ph));
    $z[12] = TambahBanyak($alfa[12]);

    $alfa[13] = findMin(ketNormal($ketinggian), kekKeruh($kekeruhan), phNormal($ph));
    $z[13] = TambahBanyak($alfa[13]);

    $alfa[14] = findMin(ketTinggi($ketinggian), kekKeruh($kekeruhan), phNormal($ph));
    $z[14] = TambahSedang($alfa[14]);

    $alfa[15] = findMin(ketRendah($ketinggian), kekKeruh($kekeruhan), phTinggi($ph));
    $z[15] = TambahBanyak($alfa[15]);

    $alfa[16] = findMin(ketNormal($ketinggian), kekKeruh($kekeruhan), phTinggi($ph));
    $z[16] = TambahSedang($alfa[16]);

    $alfa[17] = findMin(ketTinggi($ketinggian), kekKeruh($kekeruhan), phTinggi($ph));
    $z[17] = TambahSedang($alfa[17]);

    $temp_1 = 0;
    $temp_2 = 0;
    
    for($i = 0; $i < 18; $i++){
        $temp_1 = $temp_1 + $alfa[$i] * $z[$i];
        $temp_2 = $temp_2 + $alfa[$i];
    }
    $hasil = $temp_1 / $temp_2;
    return $hasil * 1000;
}

echo "<br>";
echo "Hasil = " .$hasil . "<br>";
echo $ketinggian ."<br>";
echo $kekeruhan ."<br>";
echo $ph ."<br>";

?>
<script>
    var status_pompa = <?php echo json_encode($hasil);?>;
    firebase.database().ref('pompa/').set({
        status: 1,
        }, (error) => {
            if (error) {
                // The write failed...
                console.log("Upload Gagal");
            } else {
                console.log("Upload Berhasil");
            }
        });
        setInterval(function() {
        firebase.database().ref('pompa/').set({
        status: 0,
        }, (error) => {
            if (error) {
                // The write failed...
                console.log("Upload Gagal");
            } else {
                console.log("Upload Berhasil");
            }
        });
            }, status_pompa);
</script>

</body>
</html>