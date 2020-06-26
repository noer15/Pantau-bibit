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
                                <li class="breadcrumb-item active" aria-current="page">Account</li>
                            </ol>
                        </nav>
                        <!-- <div class="page-options">
                            <a href="<?=site_url('sumbang/add') ?>" class="btn btn-primary">Tambah Sumbangan</a>
                        </div> -->
                    </div>
                    <div class="main-wrapper">
                         <div class="row">
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
                                                    <th>NIP</th>
                                                    <th>Nama</th>
                                                    <th>Pangkat</th>
                                                    <th>Level</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no =1;
                                                foreach ($account as $s): ?>
                                                    <tr>
                                                        <td><?=$no++ ?></td>
                                                        <td><?=$s->nip ?></td>
                                                        <td><?=$s->nama ?></td>
                                                        <td><?=$s->pangkat_gol_id ?></td>
                                                        <td><?=$s->role_id ?></td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#modal_edit<?=$s->id;?>"><span class="material-icons">edit</span></a>
                                                            <a href="<?=site_url('account/delete/'.$s->id) ?>"><span class="material-icons">delete</span></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                        </table>
                                    </div>

                                    <!-- modal -->
                                    <?php
                                    foreach($account as $i):
                                        $id=$i->id;
                                        $role=$i->role_id;
                                    ?>
                                        <div class="modal fade" id="modal_edit<?php echo $id;?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                     <div class="modal-content">
                                                        <form action="<?=site_url('account/update') ?>" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Account</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="group-form">
                                                                    <input type="text" name="role_id" class="form-control" placeholder="enter category" value="<?php echo $role;?>">
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
