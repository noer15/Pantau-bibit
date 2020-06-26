<!-- <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script> -->

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
                                                  <label class="col-lg-2">Laporan Berdasarkan</label>
                                                  <div class="col-lg-5">
                                                      <select name="pilih_lap"  id="pilih_lap" class="form-control" >
                                                            <option value="">< Pilih Laporan > </option>
                                                            <option value="1">Kelas</option>
                                                            <!-- <option value="2">CDK ( Cabang Dinas Kehutanan )</option> -->
                                                      </select>
                                                </div>
                                          </div><br>                  <s></s>
                                      <div class="form-group" id="divKab">
                                          <label class="col-lg-2">Kabupaten</label>
                                          <div class="col-lg-5">
                                              <select name="kab"  id="kab" class="select-search form-control" 
                                                  data-placeholder="Pilih Kabupaten">
                                                  <option value="0"> < All > </option>
                                                  <?php foreach ($kabupaten as $key => $value) { ?>
                                                      <option value="<?php echo $value->id_kabupaten?>">
                                                          <?php echo $value->nama_kab?>                                           
                                                      </option>
                                                  <?php }  ?>                                
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group" id="kec-group">
                                          <br>
                                        <label class="col-lg-2 control-label">Kecamatan</label>
                                          <div class="col-lg-5">
                                            <select name="kec"  id="kec" class="select-search form-control" 
                                                  data-placeholder="Pilih Kecamatan">
                                                  <option value="0"> < All > </option>
                                                  <?php foreach ($kecamatan as $key => $value) { ?>
                                                    <option value="<?php echo $value->id?>">
                                                        <?php echo $value->nama?>                                       
                                                      </option>
                                                  <?php }  ?>                                
                                            </select>
                                          </div>
                                      </div>
                                      <br>

                
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-flat">
                  <div class="panel-body">
                      <div id="myDIV"></div>
                  </div>
              </div>
                           
        </div>
    </div>
</div>

<script type="text/javascript">                
    $(function(){        
        //var lap = $('#pilih_lap').val();

        $('#divKab').hide();
        $('#myDIV').hide();
        $('#divCDK').hide();
        $('#kec-group').hide();
        

        $('#pilih_lap').change(function(){
            var lap = $(this).val();            
            if(lap==1){
                $('#divKab').show();
                $('#divCDK').show();
                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Kelompoktani/lapkelas/0/0/0'; ?>");
            }else
            if(lap==2){                
                $('#divKab').hide();
                $('#kec-group').hide();

                $('#myDIV').show();
                $('#myDIV').load("<?php echo base_url().'Kelompoktani/lapcdk'; ?>");
            }
            else{
                $('#divKab').hide();
                $('#kec-group').hide();
                $('#myDIV').hide();
            }

        });

    });


    $(function () {
    var baseurl = "<?php echo base_url();?>";
    $('#kec-group').hide();

    $('#kab').change(function(){
            var kab  = $(this).val();     
            var kec  = $('#kec').val();                        
            var lap = $('#pilih_lap').val();        
            var cdk  = $('#cdk').val();
            
            var url_;

            if(lap==1){
                url_ = baseurl+"Report/lapkelas/"+kab+"/"+kec+"/"+cdk;    
                urlLoad = baseurl+"Kelompoktani/lapkelas/"+kab+"/"+kec+"/"+cdk;        
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else            
            if(lap==2){
                url_ = baseurl+"Report/lapkelompokcdk";
                urlLoad = baseurl+"Kelompoktani/lapcdk";
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }

            console.log(urlLoad);
            
           
            $("#kec").empty();
            $('#kec').append($("<option></option>")
                          .attr("value",0)
                            .text('< All >'));
            if(kab==0){
                if(lap==1){
                    urlLoad = baseurl+"Kelompoktani/lapkelas/0"+"/"+kec+"/"+cdk;  
                }else
                if(lap==2){
                    urlLoad = baseurl+"Kelompoktani/lapcdk";                   
                }
                $('#myDIV').show();
                $('#myDIV').load(urlLoad);

              //document.getElementById("colname").innerHTML = " Kabupaten";
              $('#kec-group').hide();
            }else{
              //document.getElementById("colname").innerHTML = " Kecamatan";
              $('#kec-group').show();
              $.ajax({                            
                  url: baseurl+'laporan/getKecamatan/'+kab,
                  type:'GET',
                  contentType: 'application/json',
                  success: function (resp) { 

                    var dataArray = JSON.parse(resp);                   
                    // console.log(dataArray);                                    
                    for (var i in dataArray) {
                      //console.log(dataArray[i]);
                        $('#kec').append($("<option></option>")
                            .attr("value",dataArray[i].id_kecamatan)
                              .text(dataArray[i].nama_kec));
                      }
                      //console.log(dataArray[0].id);                                       
                  },
            });        
          }
            
            $('#cetak').attr('href',url_);
         
        });

        $('#kec').change(function(){
          var kab  = $('#kab').val();
            var kec  = $(this).val();  
            var cdk  = $('#cdk').val();  
            var lap = $('#pilih_lap').val();            
            var url_; 

            if(lap==1){
                url_ = baseurl+"Report/lapkelas/"+kab+"/"+kec+"/"+cdk;     
                urlLoad = baseurl+"Kelompoktani/lapkelas/"+kab+"/"+kec+"/"+cdk;      
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else            
            if(lap==2){
                url_ = baseurl+"Report/lapkelompokcdk";
                urlLoad = baseurl+"Kelompoktani/lapcdk";
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }

            console.log(urlLoad)

            url_ = baseurl+"Report/rekapkelompok/"+kab+"/"+kec;
            $('#cetak').attr('href',url_);
        });

        $('#cdk').change(function(){
            var cdk  = $(this).val();     
            var kab  = $('#kab').val();     
            var kec  = $('#kec').val();                        
            var lap = $('#pilih_lap').val();        

            //console.log(lap);            
            var url_;

            if(lap==1){

                url_ = baseurl+"Report/lapkelas/"+kab+"/"+kec+"/"+cdk;    
                urlLoad = baseurl+"Kelompoktani/lapkelas/"+kab+"/"+kec+"/"+cdk;        
                //$('#myDIV').show();
                $('#myDIV').load(urlLoad);
            }else
            if(lap==2){
                $('#myDIV').load(urlLoad);
            }
            console.log(urlLoad);
            console.log(url_);
            $('#cetak').attr('href',url_);
            //table.ajax.reload(); 

        });

  });

</script>

