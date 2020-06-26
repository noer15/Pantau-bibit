
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
 </style>
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
                                <div class="card card-transparent stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title" id="count1"></h5>
                                            <p class="stats-text">Total Jumlah Sumbangan</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            + 
                                                <?php $tes = $perhari_sumbangan->jumlah ?>
                                                <?=$sumbangan = $tes === NULL ? '0' : $tes   ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card card-transparent stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title" id="count2"></h5>
                                            <p class="stats-text">Total Jumlah Kabupaten</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            + <?=$kab_perhari->kab ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card card-transparent stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title" id="count3"></h5>
                                            <p class="stats-text">Total Jumlah Desa</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            + <?=$desa_perhari->desa ?>
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

                                      var icon_ = L.Icon.extend({options: {iconSize:[40, 40], iconAnchor:[12, 20], popupAnchor:[0, -25]}});
                                        
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
                                                            <img src="<?=base_url('assets/images/icon/'.$s->warna) ?>" width="50">
                                                        </td>
                                                        <td><?=$s->jumlah ?></td>
                                                    </tr>
                                                <?php endforeach ?>
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

        // couner
        document.addEventListener("DOMContentLoaded", () => {
             function counter(id, start, end, duration) {
              let obj = document.getElementById(id),
               current = start,
               range = end - start,
               increment = end > start ? 1 : -1,
               step = Math.abs(Math.floor(duration / range)),
               timer = setInterval(() => {
                current += increment;
                obj.textContent = current;
                if (current == end) {
                 clearInterval(timer);
                }
               }, step);
             }
             counter("count1", 0, <?=$total_sumbangan->jumlah ?>);
             counter("count2", 0, <?=$this->db->query("SELECT COUNT(id_kab) FROM sumbangan GROUP BY id_kab")->num_rows()?>, 3000);
             counter("count3", 0, <?=$this->db->get('sumbangan')->num_rows() ?>, 3000);
            });

</script>

            