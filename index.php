<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuzzy</title>
</head>

<body>
    <?php

    $jarak = 54;
    $zona_kasus = 1;

    // sangat bahaya
    if ($jarak <= 40) {
        $nilai_keanggotaan_sangat_bahaya = 1;
    } elseif ($jarak > 40 && $jarak < 50) {
        $nilai_keanggotaan_sangat_bahaya = (50 - $jarak) / (50 - 40);
    } elseif ($jarak >= 50) {
        $nilai_keanggotaan_sangat_bahaya = 0;
    }

    // bahaya
    if ($jarak > 40 && $jarak < 50) {
        $nilai_keanggotaan_bahaya = ($jarak - 40) / (50 - 40);
    } elseif ($jarak == 50) {
        $nilai_keanggotaan_bahaya = 1;
    } elseif ($jarak > 50 && $jarak < 60) {
        $nilai_keanggotaan_bahaya = (60 - $jarak) / (60 - 50);
    } elseif ($jarak <= 40 || $jarak >= 60) {
        $nilai_keanggotaan_bahaya = 0;
    }

    // awas
    if ($jarak > 50 && $jarak < 60) {
        $nilai_keanggotaan_awas = ($jarak - 50) / (60 - 50);
    } elseif ($jarak == 60) {
        $nilai_keanggotaan_awas = 1;
    } elseif ($jarak > 60 && $jarak < 70) {
        $nilai_keanggotaan_awas = (70 - $jarak) / (70 - 60);
    } elseif ($jarak <= 50 || $jarak >= 70) {
        $nilai_keanggotaan_awas = 0;
    }

    // Warning
    if ($jarak > 60 && $jarak < 70) {
        $nilai_keanggotaan_warning = ($jarak - 60) / (70 - 60);
    } elseif ($jarak == 70) {
        $nilai_keanggotaan_warning = 1;
    } elseif ($jarak > 70 && $jarak < 80) {
        $nilai_keanggotaan_warning = (80 - $jarak) / (80 - 70);
    } elseif ($jarak <= 60 || $jarak >= 80) {
        $nilai_keanggotaan_warning = 0;
    }

    // Peringatan
    if ($jarak <= 70) {
        $nilai_keanggotaan_peringatan = 0;
    } elseif ($jarak > 70 && $jarak < 80) {
        $nilai_keanggotaan_peringatan = ($jarak - 70) / (80 - 70);
    } elseif ($jarak >= 80) {
        $nilai_keanggotaan_peringatan = 1;
    }


    // Tidak berwarna
    if ($zona_kasus <= 0.5) {
        $nilai_keanggotaan_zona_tidak_berwarna = 1;
    } elseif ($zona_kasus > 0.5 && $zona_kasus < 1) {
        $nilai_keanggotaan_zona_tidak_berwarna = (1 - $zona_kasus) / (1 - 0.5);
    } elseif ($zona_kasus >= 1) {
        $nilai_keanggotaan_zona_tidak_berwarna = 0;
    }

    // Kuning
    if ($zona_kasus > 0.5 && $zona_kasus <= 1) {
        $nilai_keanggotaan_zona_kuning = ($zona_kasus - 0.5) / (1 - 0.5);
    } elseif ($zona_kasus == 1) {
        $nilai_keanggotaan_zona_kuning = 1;
    } elseif ($zona_kasus > 1 && $zona_kasus < 1.5) {
        $nilai_keanggotaan_zona_kuning = (1.5 - $zona_kasus) / (1.5 - 1);
    } elseif ($zona_kasus <= 0.5 || $zona_kasus >= 1.5) {
        $nilai_keanggotaan_zona_kuning = 0;
    }

    // Merah
    if ($zona_kasus <= 1) {
        $nilai_keanggotaan_zona_merah = 0;
    } elseif ($zona_kasus > 1 && $zona_kasus < 2) {
        $nilai_keanggotaan_zona_merah = ($zona_kasus - 1) / (2 - 1);
    } elseif ($zona_kasus >= 2) {
        $nilai_keanggotaan_zona_merah = 1;
    }

    $out_jarak = array_map(function ($out_jarak) {
        return $out_jarak;
    }, array($nilai_keanggotaan_sangat_bahaya, $nilai_keanggotaan_bahaya, $nilai_keanggotaan_awas, $nilai_keanggotaan_warning, $nilai_keanggotaan_peringatan));

    $out_zona = array_map(function ($out_zona) {
        return $out_zona;
    }, array($nilai_keanggotaan_zona_tidak_berwarna, $nilai_keanggotaan_zona_kuning, $nilai_keanggotaan_zona_merah));

    // rule
    $a1 = min($nilai_keanggotaan_sangat_bahaya, $nilai_keanggotaan_zona_tidak_berwarna);
    $a2 = min($nilai_keanggotaan_bahaya, $nilai_keanggotaan_zona_kuning);
    $a3 = min($nilai_keanggotaan_awas, $nilai_keanggotaan_zona_merah);
    $a4 = min($nilai_keanggotaan_warning, $nilai_keanggotaan_zona_tidak_berwarna);
    $a5 = min($nilai_keanggotaan_peringatan, $nilai_keanggotaan_zona_kuning);
    $a6 = min($nilai_keanggotaan_sangat_bahaya, $nilai_keanggotaan_zona_merah);
    $a7 = min($nilai_keanggotaan_bahaya, $nilai_keanggotaan_zona_tidak_berwarna);
    $a8 = min($nilai_keanggotaan_awas, $nilai_keanggotaan_zona_kuning);
    $a9 = min($nilai_keanggotaan_warning, $nilai_keanggotaan_zona_merah);
    $a10 = min($nilai_keanggotaan_peringatan, $nilai_keanggotaan_zona_tidak_berwarna);
    $a11 = min($nilai_keanggotaan_sangat_bahaya, $nilai_keanggotaan_zona_kuning);
    $a12 = min($nilai_keanggotaan_bahaya, $nilai_keanggotaan_zona_merah);
    $a13 = min($nilai_keanggotaan_awas, $nilai_keanggotaan_zona_tidak_berwarna);
    $a14 = min($nilai_keanggotaan_warning, $nilai_keanggotaan_zona_kuning);
    $a15 = min($nilai_keanggotaan_peringatan, $nilai_keanggotaan_zona_merah);

    // perhitungan rule
    $jumlah = ($a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12 + $a13 + $a14 + $a15);

    $lampu_merah = (($a1 * 0) + ($a2 * 1) + ($a3 * 0) + ($a4 * 0) + ($a5 * 0) + ($a6 * 1) + ($a7 * 0) + ($a8 * 0) + ($a9 * 0) + ($a10 * 0) + ($a11 * 1) + ($a12 * 1) + ($a13 * 0) + ($a14 * 0) + ($a15 * 0)) / $jumlah;
    $lampu_kuning = (($a1 * 0) + ($a2 * 0) + ($a3 * 1) + ($a4 * 0) + ($a5 * 1) + ($a6 * 0) + ($a7 * 0) + ($a8 * 1) + ($a9 * 1) + ($a10 * 0) + ($a11 * 0) + ($a12 * 0) + ($a13 * 0) + ($a14 * 1) + ($a15 * 1)) / $jumlah;
    $suara_1 = (($a1 * 0) + ($a2 * 0) + ($a3 * 0) + ($a4 * 0) + ($a5 * 0) + ($a6 * 0) + ($a7 * 0) + ($a8 * 0) + ($a9 * 1) + ($a10 * 0) + ($a11 * 0) + ($a12 * 0) + ($a13 * 0) + ($a14 * 1) + ($a15 * 0)) / $jumlah;
    $suara_2 = (($a1 * 0) + ($a2 * 0) + ($a3 * 1) + ($a4 * 0) + ($a5 * 0) + ($a6 * 0) + ($a7 * 0) + ($a8 * 1) + ($a9 * 0) + ($a10 * 0) + ($a11 * 0) + ($a12 * 0) + ($a13 * 0) + ($a14 * 0) + ($a15 * 0)) / $jumlah;
    $suara_3 = (($a1 * 0) + ($a2 * 0) + ($a3 * 0) + ($a4 * 0) + ($a5 * 0) + ($a6 * 1) + ($a7 * 0) + ($a8 * 0) + ($a9 * 0) + ($a10 * 0) + ($a11 * 1) + ($a12 * 0) + ($a13 * 0) + ($a14 * 0) + ($a15 * 0)) / $jumlah;

    echo "RIO SANG JUARA <br> <br>";
    echo "lampu merah = ", $lampu_merah, "<br>";
    echo "lampu kuning = ", $lampu_kuning, "<br>";
    echo "suara 1 = ", $suara_1, "<br>";
    echo "suara 2 = ", $suara_2, "<br>";
    echo "suara 3 = ", $suara_3, "<br>";
    ?>
</body>

</html>