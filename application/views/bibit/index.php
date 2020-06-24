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
                        <li class="breadcrumb-item active" aria-current="page">Jenis Bibit</li>
                    </ol>
                </nav>
                <div class="page-options">
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Tambah Bibit
                            </button>
    
                                        <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    
                                         <div class="modal-content">
                                            <form action="<?=site_url('jenis/add_action') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambahkan Jenis Bibit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="group-form">
                                                        <input type="text" name="jenis_name" class="form-control" placeholder="enter jenis bibit">
                                                    </div>
                                                </div><br>
                                                <div class="modal-body">
                                                    <div class="group-form">
                                                        <input type="file" name="warna" class="form-control" placeholder="enter warna bibit">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="main-wrapper">
                     <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
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
                                                <th>Jenis Tanaman</th>
                                                <th>Icon Kordinat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no=1;
                                            foreach ($jenis as $j): ?>
                                                <tr>
                                                    <td><?=$no++ ?></td>
                                                    <td><?=$j->jenis_name ?></td>
                                                    <td>
                                                        <img src="<?=base_url('assets/images/icon/'.$j->warna) ?>" width="30">
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_edit<?=$j->id_jenis;?>">Edit</a>
                                                        <a href="<?=site_url('jenis/delete/'.$j->id_jenis) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                    </table>

                                    <?php
                                    foreach($jenis as $i):
                                        $id=$i->id_jenis;
                                        $nama=$i->jenis_name;
                                        $warna=$i->warna;
                                    ?>
                                        <div class="modal fade" id="modal_edit<?php echo $id;?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                     <div class="modal-content">
                                                        <form action="<?=site_url('jenis/update') ?>" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Jenis Bibit</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="group-form">
                                                                    <input type="text" name="jenis_name" class="form-control" placeholder="enter category" value="<?php echo $nama;?>">
                                                                </div><br>
                                                                <div class="group-form">
                                                                    <img src="<?=base_url('assets/images/icon/'.$warna) ?>" width="30">
                                                                    <input type="file" name="warna" class="form-control" placeholder="enter category" >
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_jenis" value="<?=$id; ?>">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                            </div>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
