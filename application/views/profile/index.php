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
                                    <span style="padding-left: 10px"><?=$this->session->userdata('nama'); ?></span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
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
                                                    <th>Poto Profile</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<?php 
                                            	$no =1;
                                            	foreach ($profile as $p): ?>
                                            		<tr>
	                                                    <td><?=$no++ ?></td>
                                                        <td>
                                                            <img src="<?=base_url('assets/images/profile/'.$p->img_profile) ?>" style="width: 50px; height: 50px; border-radius: 50px;">
                                                        </td>
                                                        <td><?=$p->nama ?></td>
                                                        <td><?=$p->alamat ?></td>
                                                        <td><?=$p->email ?></td>
	                                                    <td>
	                                                    	<a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_edit<?=$p->id;?>"><i class="fa fa-edit"></i></a>
                                                            <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_password<?=$p->id;?>"><i class="fa fa-key"></i></a>
	                                                    </td>
	                                                </tr>
                                            	<?php endforeach ?>
                                        </table>
                                    </div>
                                    <!-- edit -->
                                   <?php
                                    foreach($profile as $i):
                                        $id=$i->id;
                                        $nama=$i->nama;
                                        $alamat=$i->alamat;
                                        $email=$i->email;
                                        $phone_wa=$i->phone_wa;
                                        $password = $i->password;
                                        $img = $i->img_profile;
                                    ?>
                                        <div class="modal fade" id="modal_edit<?php echo $id;?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                     <div class="modal-content">
                                                        <form action="<?=site_url('profile/update') ?>" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                   <img src="<?=base_url('assets/images/profile/'.$img) ?>" style="width: 100px; height: 100px; border-radius: 50px; display: flex; margin: 0 auto;">
                                                                </div>
                                                            </div>
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                    <input type="text" name="nama" class="form-control" placeholder="enter category" value="<?php echo $nama;?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                    <input type="text" name="alamat" class="form-control" placeholder="enter alamat" value="<?php echo $alamat;?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                    <input type="email" name="email" class="form-control" placeholder="enter email" value="<?php echo $email;?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                    <input type="text" name="phone_wa" class="form-control" placeholder="enter phone WA" value="<?php echo $phone_wa;?>">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                    
                                                                    <input type="file" name="img_profile" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id" value="<?=$id; ?>">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                            </div>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>


                                    <!-- password -->
                                    <?php
                                    foreach($profile as $i):
                                        $id=$i->id;
                                        $nama=$i->nama;
                                        $password = $i->password;
                                        $img = $i->img_profile;
                                    ?>
                                        <div class="modal fade" id="modal_password<?php echo $id;?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                     <div class="modal-content">
                                                        <form action="<?=site_url('profile/update_password') ?>" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Password</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body mb-3">
                                                                <div class="group-form">
                                                                    <label class="text">Ubah Password</label>
                                                                    <input type="text" name="password" class="form-control" placeholder="enter Password new">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id" value="<?=$id; ?>">
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
        