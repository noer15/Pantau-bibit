<script type="text/javascript">
            function loadKabupaten()
            {
                var propinsi = $("#propinsi").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo site_url('sumbang'); ?>/kabupaten",
                    data:"id=" + propinsi,
                    success: function(html)
                    { 
                       $("#kabupatenArea").html(html);
                    }
                }); 
            }
            function loadKecamatan()
            {
                var kabupaten = $("#kabupaten").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo site_url('sumbang'); ?>/kecamatan",
                    data:"id=" + kabupaten,
                    success: function(html)
                    { 
                        $("#kecamatanArea").html(html);
                    }
                }); 
            }
            function loadDesa()
            {
                var kecamatan = $("#kecamatan").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo site_url('sumbang'); ?>/desa",
                    data:"id=" + kecamatan,
                    success: function(html)
                    { 
                        $("#desaArea").html(html);
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
                                <li class="breadcrumb-item active" aria-current="page">Sumbangan</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                            <div class="col">
                                <div class="card">
                                    

                                    <form action="<?=site_url('sumbang/update') ?>" method="POST">
                                        <div class="card-body">
                                            <?php if($this->session->flashdata('msg') == TRUE):?> 
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Kategori GTPP</label>
                                                         <select class="form-control" name="id_kategori">
                                                             <option selected="" value="<?=$e_sumbang->id_category?>"><?=$e_sumbang->name_category?></option>
                                                             <?php foreach ($this->db->get('category')->result() as $j): ?>
                                                                 <option value="<?=$j->id_category ?>"><?=$j->name_category ?></option>
                                                             <?php endforeach ?>
                                                         </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Jenis Bibit</label>
                                                         <select class="form-control" name="id_jenis">
                                                             <option selected="" value="<?=$e_sumbang->id_jenis ?>"><?=$e_sumbang->jenis_name?></option>
                                                             <?php foreach ($this->db->get('jenis')->result() as $j): ?>
                                                                 <option value="<?=$j->id_jenis ?>"><?=$j->jenis_name ?></option>
                                                             <?php endforeach ?>
                                                         </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Jumlah Bibit</label>
                                                         <input type="text" class="form-control" name="jumlah" value="<?=$e_sumbang->jumlah ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nama Penyumbang</label>
                                                         <input type="text" class="form-control" name="penyumbang" value="<?=$e_sumbang->nama_penyumbang ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" class="form-control" name="id_sumbangan" value="<?=$e_sumbang->id_sumbangan ?>">
                                                        <a href="<?=site_url('sumbang') ?>" class="btn btn-secondary">Cancel</a>
                                                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                    </div>
                                            </div>
                                        </div>  
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
