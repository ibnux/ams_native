<?php
//cek session
if(empty($_SESSION['admin'])){
    header("Location: ../");
    die();
}
?>
<div class="col s12" id="header-instansi">
    <div class="card blue-grey white-text">
        <div class="card-content">
            <div class="circle left"><img class="logo" src="./upload/<?=$instansi['logo']?>"/></div>
            <h5 class="ins"><?=$instansi['nama']?></h5>
            <p class="almt"><?=$instansi['alamat']?></p>
        </div>
    </div>
</div>