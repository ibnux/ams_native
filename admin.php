<?php
ob_start();
//cek session
session_start();

if(empty($_SESSION['admin'])){
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
}
require_once 'vendor/autoload.php';
require_once 'include/config.php';
require_once 'include/functions.php';

$instansi = $db->get('tbl_instansi',['institusi', 'nama', 'status', 'alamat', 'kepsek', 'nip', 'website', 'email', 'logo'],['id_instansi'=>1]);
?>
<!--

Name        : Aplikasi Sederhana Manajemen Surat Menyurat
Version     : v1.0.1
Description : Aplikasi untuk mencatat data surat masuk dan keluar secara digital.
Date        : 2016
Developer   : M. Rudianto
Phone/WA    : 0852-3290-4156
Email       : rudi@masrud.com
Website     : https://masrud.com

-->
<!doctype html>
<html lang="en">

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body START -->
<body class="bg">

<!-- Header START -->
<header>

<!-- Include Navigation START -->
<?php include('include/menu.php'); ?>
<!-- Include Navigation END -->

</header>
<!-- Header END -->

<!-- Main START -->
<main>

    <!-- container START -->
    <div class="container">

    <?php
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            switch ($page) {
                case 'tsm':
                    include "modules/transaksi_surat_masuk.php";
                    break;
                case 'ctk':
                    include "modules/cetak_disposisi.php";
                    break;
                case 'tsk':
                    include "modules/transaksi_surat_keluar.php";
                    break;
                case 'asm':
                    include "modules/agenda_surat_masuk.php";
                    break;
                case 'ask':
                    include "modules/agenda_surat_keluar.php";
                    break;
                case 'ref':
                    include "modules/referensi.php";
                    break;
                case 'sett':
                    include "modules/pengaturan.php";
                    break;
                case 'pro':
                    include "modules/profil.php";
                    break;
                case 'gsm':
                    include "modules/galeri_sm.php";
                    break;
                case 'gsk':
                    include "modules/galeri_sk.php";
                    break;
            }
        } else {
    ?>
        <!-- Row START -->
        <div class="row">

            <!-- Include Header Instansi START -->
            <?php include('include/header_instansi.php'); ?>
            <!-- Include Header Instansi END -->

            <!-- Welcome Message START -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang <?php echo $_SESSION['nama']; ?></h4>
                        <p class="description">Anda login sebagai
                        <?php
                            if($_SESSION['admin'] == 1){
                                echo "<strong>Super Admin</strong>. Anda memiliki akses penuh terhadap sistem.";
                            } elseif($_SESSION['admin'] == 2){
                                echo "<strong>Administrator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            } else {
                                echo "<strong>Petugas Disposisi</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            }?></p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->

            <?php
                //menghitung jumlah surat masuk
                $tbl_surat_masuk = $db->count("tbl_surat_masuk");

                //menghitung jumlah surat masuk
                $tbl_surat_keluar = $db->count("tbl_surat_keluar");

                //menghitung jumlah surat masuk
                $tbl_disposisi = $db->count("tbl_disposisi");

                //menghitung jumlah klasifikasi
                $tbl_klasifikasi = $db->count("tbl_klasifikasi");

                //menghitung jumlah pengguna
                $tbl_user = $db->count("tbl_user");
            ?>

            <!-- Info Statistic START -->
            <a href="?page=tsm">
                <div class="col s12 m4">
                    <div class="card cyan">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">mail</i> Surat Masuk</span>
                            <?php echo '<h5 class="white-text link">'.$tbl_surat_masuk.' Surat</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>

            <a href="?page=tsk">
                <div class="col s12 m4">
                    <div class="card lime darken-1">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">drafts</i> Surat Keluar</span>
                            <?php echo '<h5 class="white-text link">'.$tbl_surat_keluar.' Surat</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>

            <div class="col s12 m4">
                <div class="card yellow darken-3">
                    <div class="card-content">
                        <span class="card-title white-text"><i class="material-icons md-36">description</i> Disposisi</span>
                        <?php echo '<h5 class="white-text link">'.$tbl_disposisi.' Disposisi</h5>'; ?>
                    </div>
                </div>
            </div>

            <a href="?page=ref">
                <div class="col s12 m4">
                    <div class="card deep-orange">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">class</i> Klasifikasi</span>
                            <?php echo '<h5 class="white-text link">'.$tbl_klasifikasi.' Surat</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>

        <?php
            if($_SESSION['id_user'] == 1 || $_SESSION['admin'] == 2){?>
                <a href="?page=sett&sub=usr">
                    <div class="col s12 m4">
                        <div class="card blue accent-2">
                            <div class="card-content">
                                <span class="card-title white-text"><i class="material-icons md-36">people</i> Pengguna</span>
                                <?php echo '<h5 class="white-text link">'.$tbl_user.' Pengguna</h5>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <!-- Info Statistic START -->
        <?php
            }
        ?>

        </div>
        <!-- Row END -->
    <?php
        }
    ?>
    </div>
    <!-- container END -->

</main>
<!-- Main END -->

<!-- Include Footer START -->
<?php include('include/footer.php'); ?>
<!-- Include Footer END -->

</body>
<!-- Body END -->

</html>