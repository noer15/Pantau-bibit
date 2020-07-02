<script type="text/javascript">
    function loadKabupaten()
    {
        var propinsi = $("#propinsi").val();
        $.ajax({
            type:'GET',
            url:"<?php echo site_url('laporan'); ?>/kabupaten",
            data:"id=" + propinsi,
            success: function(html)
            { 
                $("#kabupatenArea").html(html);
                getDataKabupaten();
            }
        }); 
    }
    function loadKecamatan()
    {
        var kabupaten = $("#kabupaten").val();
        $.ajax({
            type:'GET',
            url:"<?php echo site_url('laporan/kecamatan'); ?>",
            data:"id=" + kabupaten,
            success: function(html)
            { 
                $("#kecamatanArea").html(html);
                getDataKabupaten();
            }
        }); 
    }
    function loadDesa()
    {
        var kecamatan = $("#kecamatan").val();
        $.ajax({
            type:'GET',
            url:"<?php echo site_url('laporan'); ?>/desa",
            data:"id=" + kecamatan,
            success: function(html)
            { 
                $("#desaArea").html(html);
                $("#desa").show();
            }
        }); 
    }

    function getDataKabupaten()
    {
        $id = $('#kabupaten option:selected').val();
        $.get('<?=site_url('laporan/getKabupaten')?>/'+$id, function(response){
            let res = JSON.parse(response);
            let html= ''; let no = 1; let jumlah = 0;
            for($i=0; $i < res.length; $i++){
                jumlah = jumlah + Number(res[$i]['jumlah']);
                html += '<tr><td>'+no+'</td><td>'+res[$i]['nama_kab']+'</td><td>'+res[$i]['jumlah']+'</td></tr>';
                no++;
            }

            $("#kabupatenTable").show();
            $("#kabupatenData").html(html);
            $("#totalKabupaten").text(jumlah);

        })
    }

    function getDataKecamatan($id)
    {

    }

    function getDataDesa($id)
    {

    }

    
    
</script>
       
<div class="connect-container align-content-stretch d-flex flex-wrap">        
    <div class="page-container">
       <div class="page-header">
            <nav class="navbar navbar-expand">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item small-screens-sidebar-link">
                        <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            <span style="padding-left: 10px;"><?=$this->session->userdata('nama'); ?></span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?=site_url('logout') ?>">Log out</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="dark-theme-toggle"><i class="material-icons-outlined">brightness_2</i><i class="material-icons">brightness_2</i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="page-content">
            <div class="page-info">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Apps</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                    </ol>
                </nav>
                
                </div>
                <div class="main-wrapper">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kabupaten</label>
                                             <select id="kabupaten" onchange="loadKecamatan()" name="prov" class="form-control">
                                                <option value="0">--Pilih Laporan--</option>
                                                <?php
                                                foreach ($kabupaten as $p) :?>
                                                    <option value="<?=$p->id_kabupaten ?>"><?=$p->nama_kab; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div id="kecamatanArea"></div>
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-wrapper" id="kabupatenTable" style="display: none;">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                        <table id="zero-conf" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kabupaten</th>
                                                    <th>Total Penyumbang</th>
                                                </tr>
                                            </thead>
                                            <tbody id="kabupatenData"></tbody>  
                                                <tr style="background-color: #949494; color: #fff">
                                                    <td colspan="2">Total</td>
                                                    <td id="totalKabupaten"></td>
                                                </tr>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="main-wrapper" id="kecamatanTable" style="display: none;">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                        <table id="zero-conf" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kecamatan</th>
                                                    <th>Total Penyumbang</th>
                                                </tr>
                                            </thead>
                                            <tbody id="kecamatanData">
                                                
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="main-wrapper" id="desaTable" style="display: none;">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <table id="zero-conf" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Desa</th>
                                                <th>Jenis</th>
                                                <th>Total Penyumbang</th>
                                            </tr>
                                        </thead>
                                            <div id="desaData">
                                                <tbody>
                                                    
                                                </tbody>
                                            </div> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
        </div>
    </div>
</div>
