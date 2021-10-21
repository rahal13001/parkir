<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('kartu/konten.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet"> --}}
</head>
<body>

    <div>
        <img src="{{ asset('kartu/logo.png') }}" class="logo" alt="Logo KKP" srcset="">

        <p class="kementerian"> Kementerian Kelautan dan Perikanan</p>
        <p class="djprl">Direktorat Jenderal Pengelolaan Ruang Laut</p>
        <p class="lpspl">LPSPL Sorong</p>    
      

        <img src="{{ asset('kartu/ZI.png') }}" class="ZI" alt="Logo ZI" srcset="">
    </div>

        

    <div class="container">
    <h2 class="judul">Kartu Parkir LPSPL Sorong</h2>
    <h2 class="nomor_parkir">NOMOR PARKIR : {{ $nomor_parkir }}</h2>
    <h3 class="no_plat">Nomor Plat : {{ $no_plat }}</h3>
    <h4 class="jenis_kendaraan">Jenis Kendaraan : {{ $jenis_kendaraan }}, Merek : {{ $merek }}, Warna : {{ $warna }}</h4>
    <h4 class="lokasi">Lokasi Parkir : {{ $lokasi }}</h4>
    <p class="waktu">Tanggal : {{ $tanggal}}  Jam : {{ $jam}} WIT</p>
    </div>
 

    <h3 class="bersinar">#BERSINAR</h3>
    <h5 class="panjangan">Bersih, Sinergis, Integritas dan Terarah</h5>

    <h5 class="pelayanan">Kontak Pelayanan : 081341745454</h5>
    <h5 class="pengaduan">Kontak Pengaduan :  08114874148</h5>
</body>
</html>