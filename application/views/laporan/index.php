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
                       $("#resultKan").show();
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
                        $("#kecamatan").html(html);
                        $("#resultKan").hide();
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
                                            <label for="exampleInputEmail1">Provinsi</label>
                                             <select id="propinsi" onchange="loadKabupaten()" name="prov" class="form-control">
                                                <option value="0">--Pilih Laporan--</option>
                                                <?php
                                                foreach ($provinsi as $p) :?>
                                                    <option value="<?=$p->id_prov ?>"><?=$p->nama_prov; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div id="kabupatenArea"></div>
                                        <div id="kecamatanArea"></div>
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-wrapper" id="resultKan" style="display: none;">
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
                                            <tbody>
                                                <?php 
                                                $no =1;
                                                $total =0;
                                                foreach ($show as $row ): ?>
                                                   <tr>
                                                        <td><?=$no++ ?></td>
                                                        <td><?=$row->nama_kab ?></td>
                                                        <td><?=$row->total ?> Pohon</td>
                                                   </tr>
                                                   <?php $total += $row->total;  ?>
                                               <?php endforeach ?> 
                                               </tbody>  
                                                <tr style="background-color: #949494; color: #fff">
                                                    <td colspan="2">Total</td>
                                                    <td><?=$total ?> Pohon</td>
                                                </tr>

                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="main-wrapper" style="display: none;">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                        <table id="zero-conf" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Barang</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody id="show_data">
                                                
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="main-wrapper" id="desa" style="display: none;">
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
                                                <div id="desaArea">
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
 