@extends('adminlte::page')

@section('title', 'IPOS - Home')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Selamat Datang di IPOS - Informatics Point Of Sale.</p>

    @if ($user->user_role == 0)
    <h3>Tutorial</h3>
    <ol>
        <li><h4>Memesan makanan.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Pemesanan</b> > <b>Pesan Baru</b>.</li>
                <li>Pilih makanan dengan menekan tombol <b>(+)</b> untuk menambah dan <b>(-)</b> untuk mengurangi jumlah pesanan.</li>
                <li>Tekan tombol <b>Pesan</b>.</li>
                <li>Tekan tombol <b>Pesan</b> untuk mengkonfirmasi pemesanan.</li>
                <li>Pemesanan berhasil. Anda akan diarahkan ke halaman status pemesanan.</li>
            </ol>
        </li>
        <li><h4>Membatalkan pemesanan.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Pemesanan</b> > <b>Status Pesanan</b>.</li>
                <li>Tekan tombol <b>Batalkan</b> pada pesanan yang ingin dibatalkan.</li>
            </ol>
        </li>
        <li><h4>Memberi ulasan.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Menu</b> > <b>Ulasan</b>.</li>
                <li>Tekan tombol <b>Ulas</b> pada makanan yang ingin diulas.</li>
                <li>Masukkan nilai 1-5 pada kolom <b>Nilai</b>.</li>
                <li>Tulis ulasan pada kolom <b>Ulasan</b>.</li>
                <li>Tekan tombol <b>Ulas</b>.</li>
            </ol>
        </li>
    </ol>  
    @elseif ($user->user_role == 1)  
    <h3>Tutorial Penjual</h3> 
    <ol>
        <li><h4>Membuat toko baru.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Toko</b>.</li>
                <li>Tekan tombol <b>Buat Toko Baru</b>.</li>
                <li>Masukkan nama toko dan lokasi.</li>
                <li>Tekan tombol <b>Submit</b>.</li>
            </ol>
        </li>
        <li><h4>Mendaftar ke toko.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Toko</b>.</li>
                <li>Tekan tombol <b>Daftar ke Toko</b>.</li>
                <li>Pilih salah satu toko.</li>
                <li>Tekan tombol <b>Pilih</b>.</li>
            </ol>
        </li>
        <li><h4>Menambah menu.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Menu</b> > <b>Lihat Menu</b>.</li>
                <li>Pilih tombol <b>Buat Makanan</b>.</li>
                <li>Masukan informasi menu pada form.</li>
                <li>Klik tombol <b>Submit</b></li>
            </ol>
        </li>
        <li><h4>Mengganti status menu.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Menu</b> > <b>Lihat Menu</b>.</li>
                <li>Pilih tombol <b>Ganti</b> pada menu yang statusnya ingin diganti.</li>
            </ol>
        </li>
        <li><h4>Memproses pesanan.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Pesanan Toko</b>.</li>
                <li>Pilih tombol <b>Terima</b> untuk menerima pesanan.</li>
                <li>Pilih tombol <b>Tolak</b> untuk menolak pesanan.</li>
            </ol>
        </li>
    </ol>  
    @elseif ($user->user_role == 2) 
    <h3>Tutorial Kasir</h3>  
    <ol>
        <li><h4>Melunasi pemesanan.</h4>
            <ol type="a">
                <li>Masuk ke menu <b>Kasir</b>.</li>
                <li>Tekan tombol <b>Lunasi</b> pada pesanan yang ingin dilunasi.</li>
            </ol>
        </li>
    </ol>       
    @endif
@stop