<?php include_once("header.php")?>
    <div class="wrapper">
        <!-- untuk home -->
        <section id="home">
            <div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <img src="<?php echo ambil_gambar('27')?>" width="600" height="192"/>
            </div>
            
            <div class="kolom">
                <p class="deskripsi"><?php echo ambil_judul('27')?></p>
                <h2><?php echo ambil_kutipan('27')?></h2>
            </div>
        </section>

        <!-- untuk alsintan -->
        <section id="alsintan">
            <div class="kolom">
                <h2><?php echo ambil_judul('26')?></h2>
                <p class="deskripsi"><?php echo ambil_kutipan('26')?></p>
            </div>
            <img src="<?php echo ambil_gambar('26')?>" width="500"/>
        </section>

        <!-- untuk tutors -->
        <section id="spesifikasiMesin">
            <div class="tengah">
                <div class="kolom">
                    <h2><?php echo ambil_judul('25')?></h2>
                    <p class="deskripsi"><?php echo ambil_kutipan('25')?></p>
                </div>

                <div class="daftar-mesin">
                    <div class="kartu-mesin">
                        <img src="<?php echo ambil_gambarMesin(25, 1)?>"/>
                        <p>Traktor Roda 2</p>
                    </div>
                    <div class="kartu-mesin">
                        <img src="<?php echo ambil_gambarMesin(25, 2)?>"/>
                        <p>Hand Traktor Rotari</p>
                    </div>
                    <div class="kartu-mesin">
                        <img src="<?php echo ambil_gambarMesin(25, 3)?>"/>
                        <p>Hand Traktor Singkal</p>
                    </div>
                    <div class="kartu-mesin">
                        <img src="<?php echo ambil_gambarMesin(25, 4)?>"/>
                        <p>dan lain-lain</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="luasLahan">
            <div class="tengah">
                <div class="kolom">
                    <h2><?php echo ambil_judul('24')?></h2>
                    <p class="deskripsi"><?php echo ambil_kutipan('24')?></p>
                </div>

                <div class="gambar-luasLahan">
                <img src="<?php echo ambil_gambar('24')?>" width="500" height="300"/>
                </div>
            </div>
        </section>
        <section id="petaLahan">
            <div class="tengah">
                <div class="kolom">
                    <h2><?php echo ambil_judul('23')?></h2>
                    <p class="deskripsi"><?php echo ambil_kutipan('23')?></p>
                </div>

                <div class="gambar-petaLahan">
                    <img src="<?php echo ambil_gambar('23')?>" width="400" height="300"/>
                </div>
            </div>
        </section>
<?php include_once("footer.php")?>
