
 <style type="text/css">
     #map {
        z-index: 50;
        width: 100%;
        height: 500px;
    }
    .leaflet-popup-content{width: 100px;}
    canvas{
      width:1000px !important;
      height:350px !important;
    }
    .stats-card{border-right: none !important}
    #slideshow > div { 
        position: absolute; 
        top: 10px; 
        left: 10px; 
        right: 10px; 
        bottom: 10px; 
    }
 </style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

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
                                    <?php $data = $this->db->get_where('pegawai',['id'=>$this->session->userdata('id')])->row() ?>
                                    <?php if (empty($data->img_profile)): ?>
                                        <i class="fa fa-user"></i>
                                    <?php else: ?>
                                         <img src="<?=base_url('assets/images/profile/'.$data->img_profile) ?>" alt="profile image" height="42">
                                    <?php endif ?>
                                   
                                    <span style="padding-left: 10px;"><?=$this->session->userdata('nama'); ?></span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                                
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?=site_url('profile') ?>">Setting</a><hr>
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
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <div class="page-options">
                            <a href="<?=site_url('profile') ?>" class="btn btn-primary">Profile</a>
                        </div>
                    </div>
                    <div class="main-wrapper">
                        <div class="row stats-row">
                            <div class="col-lg-4 col-md-12">
                                <div class="card-penyumbang">
                                    <div class="card-body">
                                        <div class="stats-info mb-3">
                                            <h4 class="text-title"><b>Jawa Barat</b>
                                                <span class="badge badge-success float-right ml-3 font-weight-bold">
                                            + <?php $tes = $perhari_sumbangan->jumlah ?>
                                                <?=$sumbangan = $tes === NULL ? '0' : $tes   ?></span>
                                                <span class="counter-count  float-right font-weight-bold"><?=$total_sumbangan->jumlah ?></span>
                                            </h4>
                                        
                                        </div>
                                        <div class="stats-info">
                                            <h5 class="text-title"><b>Jawa Barat</b>
                                                <span class="badge badge-success float-right ml-3 font-weight-bold">
                                            + <?php $tes = $perhari_sumbangan->jumlah ?>
                                                <?=$sumbangan = $tes === NULL ? '0' : $tes   ?></span>
                                                <span class="counter-count  float-right font-weight-bold"><?=$total_sumbangan->jumlah ?></span>
                                            </h5>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card-perkabupaten">
                                    <div id="slideshow">
                                        <?php foreach ($kab_flip as $key): ?>
                                            <div class="card-body">
                                                <div class="stats-info mb-3">
                                                    <h4 class="text-title"><b><?=$key->nama_kab ?></b>
                                                        <span class="badge badge-success float-right ml-3 font-weight-bold">
                                                    + <?php $tes = $perhari_sumbangan->jumlah ?>
                                                        <?=$sumbangan = $tes === NULL ? '0' : $tes   ?></span>
                                                        <span class="float-right font-weight-bold">
                                                            <?php $data = $this->db->query("SELECT SUM(jumlah) AS total FROM sumbangan WHERE id_kab ='$key->id_kab'")->row() ?>
                                                            <?=$data->total ?>
                                                        </span>
                                                    </h4>
                                                
                                                </div>
                                                <div class="stats-info">
                                                    <h5 class="text-title"><b><?=$key->nama_kab ?></b>
                                                        <span class="badge badge-success float-right ml-3 font-weight-bold">
                                                    + <?php $tes = $perhari_sumbangan->jumlah ?>
                                                        <?=$sumbangan = $tes === NULL ? '0' : $tes   ?></span>
                                                        <span class="float-right font-weight-bold"><?=$total_sumbangan->jumlah ?></span>
                                                    </h5>
                                                
                                                </div>
                                            </div> 
                                        <?php endforeach ?>
                                          
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card-lokasi">
                                    <div class="card-body">

                                        <div class="stats-info mb-3">
                                            <h4 class="text-title"><b>Jumlah Lokasi</b>
                                                <span class="badge badge-warning float-right ml-3 font-weight-bold">
                                            + <?=$desa_perhari->desa ?></span>
                                                <span class="counter-count  float-right font-weight-bold"><?=$this->db->get('sumbangan')->num_rows() ?></span>
                                            </h4>
                                        
                                        </div>
                                        <div class="stats-info">
                                            <h5 class="text-title"><b>Jumlah Lokasi</b>
                                                <span class="badge badge-warning float-right ml-3 font-weight-bold">
                                            + <?=$desa_perhari->desa ?></span>
                                                <span class="counter-count  float-right font-weight-bold"><?=$this->db->get('sumbangan')->num_rows() ?></span>
                                            </h5>
                                        
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card savings-card">
                                    <div class="card-body">
                                    <div id="map"></div>

                                      <script>

                                      var mymap = L.map('map').setView([-6.943097, 107.633545], 8);
                                      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                        maxZoom: 18,
                                        minZoom: 7,
                                        id: 'mapbox/streets-v11',
                                        tileSize: 512,
                                        zoomOffset: -1,
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }).addTo(mymap);

                                      var icon_ = L.Icon.extend({options: {iconSize:[15, 15], iconAnchor:[12, 20], popupAnchor:[0, -25]}});
                                        
                                      <?php foreach ($lokasi as $l): ?>
                                        var icon = new icon_({iconUrl:"<?=base_url('assets/images/icon/'.$l->warna) ?>"});
                                        var icon_bibit = icon;

                                        L.marker([<?=$l->latitude?>, <?=$l->longitude?>],{icon:icon_bibit}).addTo(mymap)
                                            .bindPopup("<img src='<?=base_url('assets/images/'.$l->foto) ?>' width='50px;' style='margin:0 auto; display:flex;'></br>"+"<table><tr style='font-size:12px;color: #171717;'><td>Nama</td><td>:</td><td><?=$l->nama_penyumbang?></td></tr><tr style='font-size:12px;color: #171717;'><td>Jenis</td><td>:</td><td><?=$l->jenis_name?></td></tr><tr style='font-size:12px;color: #171717;'><td>Jumlah</td><td>:</td><td><?=$l->jumlah?></td></tr></table>" ).openPopup();
                                      <?php endforeach ?>
                                     
                                      </script>

                                      
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="alert alert-info no-m" role="alert">
                                        Data dibawah berdasarkan penyumbang dan jenis yang sudah menanam
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Chart Penyumbang</h5>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-transactions">
                                    <div class="card-body">
                                       <div class="card-body card-transactions">
                                        <?php if($this->session->flashdata('msg') == TRUE):?> 
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                        <table id="zero-conf" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kabupaten</th>
                                                    <th>Kecamatan</th>
                                                    <th>Desa</th>
                                                    <th>Kategori</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no =1;
                                                foreach ($view as $s): ?>
                                                    <tr>
                                                        <td><?=$no++ ?></td>
                                                        <td><?=$s->nama_kab ?></td>
                                                        <td><?=$s->nama_kec ?></td>
                                                        <td><?=$s->nama_desa ?></td>
                                                        <td><?=$s->name_category ?></td>
                                                        <td>
                                                            <img src="<?=base_url('assets/images/icon/'.$s->warna) ?>" width="20">
                                                        </td>
                                                        <td><?=$s->jumlah ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>  
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="page-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="footer-text"><?=date('Y') ?> © Pantau Bibit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<script>
    $("#slideshow > div:gt(0)").hide();
    setInterval(function() { 
      $('#slideshow > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slideshow');
    },  4000);

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                            <?php foreach ($chart as $c):
                                  $jenis=strtoupper($c->jenis_name);?>
                                <?php echo "'" .$jenis ."'," ?>
                            <?php endforeach?>
                        ],
                datasets: [{
                    label: 'Jumlah',
                        data: [
                                <?php foreach ($jumlah as $c):
                                    $jumlah=$c->jumlah;?>
                                <?php echo "'" .$jumlah ."'," ?>
                                <?php endforeach?>
                            ],
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

       $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 9000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
        

</script>

            