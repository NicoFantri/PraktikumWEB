<?php
$n = 5; // Tinggi segitiga
for($i = 1; $i <= $n; $i++) {
    // Cetak spasi
    for($j = 1; $j <= $n - $i; $j++) {
        echo " ";
    }
    // Cetak bintang
    for($k = 1; $k <= 2 * $i - 1; $k++) {
        echo "*";
    }
    echo "\n";
}
?>