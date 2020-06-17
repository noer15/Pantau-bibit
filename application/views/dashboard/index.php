 <style type="text/css">
     #map {
        z-index: 50;
        width: 100%;
        height: 500px;
    }
 </style>
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
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <div class="page-options">
                            <a href="<?=site_url('account') ?>" class="btn btn-secondary">Account</a>
                            <a href="#" class="btn btn-primary">Upgrade</a>
                        </div>
                    </div>
                    <div class="main-wrapper">
                        <div class="row stats-row">
                            <div class="col-lg-4 col-md-12">
                                <div class="card card-transparent stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title"><?=$total_sumbangan->jumlah ?><span class="stats-change stats-change-success">+ 
                                                <?php $tes = $perhari_sumbangan->jumlah ?>
                                                <?=$sumbangan = $tes === NULL ? '0' : $tes   ?>
                                                </span></h5>
                                            <p class="stats-text">Total Jumlah Sumbangan</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            <i class="material-icons">trending_up</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card card-transparent stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title">
                                                <!--  -->
                                                <?=$this->db->query("SELECT COUNT(id_kab) FROM sumbangan GROUP BY id_kab")->num_rows()?>
                                                <span class="stats-change stats-change-success">+ <?=$kab_perhari->kab ?></span></h5>
                                            <p class="stats-text">Total Jumlah Kabupaten</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            <i class="material-icons">trending_up</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card card-transparent stats-card">
                                    <div class="card-body">
                                        <div class="stats-info">
                                            <h5 class="card-title"><?=$this->db->get('sumbangan')->num_rows() ?><span class="stats-change stats-change-success">+ <?=$desa_perhari->desa ?></span></h5>
                                            <p class="stats-text">Total Jumlah Desa</p>
                                        </div>
                                        <div class="stats-icon change-success">
                                            <i class="material-icons">trending_up</i>
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
                                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                        maxZoom: 18,
                                        minZoom: 7,
                                        id: 'mapbox/streets-v11',
                                        tileSize: 512,
                                        zoomOffset: -1,
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }).addTo(mymap);
                                      <?php foreach ($lokasi as $l): ?>
                                          var circle = L.circle([<?=$l->lat ?>, <?=$l->long ?>], {
                                            color: '<?=$l->warna ?>',
                                            fillColor: '<?=$l->warna ?>',
                                            fillOpacity: 0.5,
                                            radius: 500,
                                            weight: 10
                                            }).addTo(mymap);
                                            circle.bindPopup("<?=$l->jenis_name ?>");
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
                                        Data has been updated 35 minutes ago, go to the reports page to access data history.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Server Load<span class="card-title-helper">Optimal</span></h5>
                                        <div class="server-load row">
                                            <div class="server-stat col-sm-4">
                                                <p>167GB</p>
                                                <span>Usage</span>
                                            </div>
                                            <div class="server-stat col-sm-4">
                                                <p>320GB</p>
                                                <span>Space</span>
                                            </div>
                                            <div class="server-stat col-sm-4">
                                                <p>57.4%</p>
                                                <span>CPU</span>
                                            </div>
                                        </div>
                                        <div id="server-load-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card card-transactions">
                                    <div class="card-body">
                                        <h5 class="card-title">Transactions<a href="#" class="card-title-helper blockui-transactions"><i class="material-icons">refresh</i></a></h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Company</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>0776</td>
                                                        <td>Sale Management</td>
                                                        <td>$18, 560</td>
                                                        <td><span class="badge badge-success">Finished</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0759</td>
                                                        <td>Dropbox</td>
                                                        <td>$40, 672</td>
                                                        <td><span class="badge badge-warning">Waiting</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0741</td>
                                                        <td>Social Media</td>
                                                        <td>$13, 378</td>
                                                        <td><span class="badge badge-info">In Progress</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0740</td>
                                                        <td>Envato Market</td>
                                                        <td>$17, 456</td>
                                                        <td><span class="badge badge-info">In Progress</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>0735</td>
                                                        <td>Graphic Design</td>
                                                        <td>$29, 999</td>
                                                        <td><span class="badge badge-secondary">Canceled</span></td>
                                                    </tr>
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
                            <span class="footer-text">2019 © stacks</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>