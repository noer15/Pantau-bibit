
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
                                <li class="breadcrumb-item active" aria-current="page">Kontribusi</li>
                            </ol>
                        </nav>
                        <div class="page-options">
                            <a href="<?=site_url('sumbang/add') ?>" class="btn btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="main-wrapper">
                            <div class="col">
                                <div class="card">
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
                                                    <th>Nama</th>
                                                    <th>Kabupaten</th>
                                                    <th>Kecamatan</th>
                                                    <th>Desa</th>
                                                    <th>Kategori</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no =1;
                                                foreach ($sumbangan as $s): ?>
                                                    <tr>
                                                        <td><?=$no++ ?></td>
                                                        <td><?=$s->nama_penyumbang ?></td>
                                                        <td><?=$s->nama_kab ?></td>
                                                        <td><?=$s->nama_kec ?></td>
                                                        <td><?=$s->nama_desa ?></td>
                                                        <td><?=$s->name_category ?></td>
                                                        <td><?=$s->jenis_name ?></td>
                                                        <td><?=$s->jumlah ?></td>
                                                        <td>
                                                            <li class="nav-item nav-profile dropdown" style="list-style: none;">
                                                                <a class="dropdown-toggle btn btn-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                    <a class="dropdown-item" href="<?=site_url('sumbang/edit/'.$s->id_sumbangan) ?>">Edit</a>
                                                                    <a class="dropdown-item" href="<?=site_url('sumbang/delete/'.$s->id_sumbangan) ?>">Hapus</a>
                                                                </div>
                                                            </li>
                                                           
                                                        </td>
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
