<!-- <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<style>
    #wilayahArea {width: 100%;}
</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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

            function loadWilayah()
            {
                var wilayah = $("#wilayah").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo site_url('sumbang'); ?>/wilayah",
                    data:"id=" + wilayah,
                    success: function(html)
                    { 
                        $("#wilayahArea").html(html);
                    }
                }); 
            }

            // script

           

     $(document).ready(function(){  
          var i=1;  
          $('#add').click(function(){  
               i++;  
               $('#dynamic_field').append('<div class="col-md-12" ><div class="form-row" id="row'+i+'"><div class="form-group col-md-6"><label for="inputState">Pilih Bibit</label><select class="form-control custom-select" name="id_jenis"><option>--Pilih--</option><?php foreach ($this->db->get('jenis')->result() as $j): ?><option value="<?=$j->id_jenis ?>"><?=$j->jenis_name ?></option><?php endforeach ?></select></div><div class="form-group col-md-4"><label for="inputCity">Jumlah</label><input type="text" class="form-control" id="inputCity" name="jumlah" placeholder="Jumlah" required=""></div><div class="form-group col-md-2" ><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="margin: 30px 35px;">X</button></div></div></div>');  
          });  

          $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
          });
      });
           
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
                    </div>
                    <div class="main-wrapper">
                            <div class="col">
                                <div class="card">
                                    

                                    <?php echo form_open_multipart('sumbang/add_action');?>
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
                                                        <label for="exampleInputEmail1">Nama</label>
                                                         <input type="text" class="form-control" name="nama_penyumbang" required="" placeholder="Masukkan Nama">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Kabupaten</label>
                                                             <select id="kabupaten" onchange="loadKecamatan()" name="id_kab" class="form-control custom-select">
                                                                <option>--Pilih Kabupaten--</option>
                                                                <?php
                                                                foreach ($kabupaten->result() as $p) {
                                                                    echo "<option value='$p->id_kabupaten'>$p->nama_kab</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div id="kecamatanArea"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="desaArea"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div id="wilayahArea"></div>
                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Kategori</label>
                                                         <select class="form-control custom-select" name="id_kategori" >
                                                             <option>--Pilih--</option>
                                                             <?php foreach ($this->db->get('category')->result() as $j): ?>
                                                                 <option value="<?=$j->id_category ?>"><?=$j->name_category ?></option>
                                                             <?php endforeach ?>
                                                         </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                            <label for="exampleInputEmail1">Alamat</label>
                                                             <input type="text" class="form-control" name="alamat" required="" placeholder="Masukkan alamat">
                                                        </div>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-row" id="dynamic_field">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputState">Pilih Bibit</label>
                                                                <select class="form-control custom-select" name="id_jenis">
                                                                     <option>--Pilih--</option>
                                                                     <?php foreach ($this->db->get('jenis')->result() as $j): ?>
                                                                         <option value="<?=$j->id_jenis ?>"><?=$j->jenis_name ?></option>
                                                                     <?php endforeach ?>
                                                                 </select>

                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="inputCity">Jumlah</label>
                                                                <input type="text" class="form-control" id="inputCity" name="jumlah" placeholder="Jumlah" required="">
                                                            </div>
                                                            <div class="form-group col-md-2" >
                                                                <button type="button" name="add" id="add" class="btn btn-success" style="margin: 30px 35px;">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="modal-footer">
                                                            <label for="exampleInputEmail1">Pilih Photo</label>
                                                            <input type="file" name="foto">
                                                            <a href="<?=site_url('sumbang') ?>" class="btn btn-secondary">Cancel</a>
                                                            <input type="submit" class="btn btn-primary" value="SUBMIT">
                                                        </div>
                                                    </div>
                                                    
                                                </div>  
                                            </div>
                                        </div>  
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>


