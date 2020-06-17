<div class="form-group">
    <label>Tujuan Negara</label>
      <select required class="form-control" name="tujuan" id="tujuan" required/>
        <option value="Pilih negara dahulu" data-id="0">--Pilih Tujuan --</option>
        <?php foreach ($data_tujuan as $key) { ?>
            <option value="<?php echo $key->negara ?>" data-id="<?php echo $key->id_tujuan ?>"><?php echo $key->negara ?></option>
        <?php } ?>
    </select>
     <input type="hidden" id="makanan" name="makanan" class=" form-control " placeholder="Username">
    <input type="hidden" id="kosmetik"  name="kosmetik" class=" form-control " placeholder="Username">
</div>  


<!-- controller -->
<?php 

    function get_tujuan($id){
        if($id != 'null'):
        $result = $this->tujuan_model->get_tujuan($id)->result();
        echo json_encode($result);
        endif;
    }

    // model
    function get_tujuan($id){
        return $this->db->get_where('tujuan',['id'=>$id])
    }
?>
<script>
  $('#tujuan').change(function(){
    var id = $('#tujuan option:selected').data('id');
    if(id !== 0){
        $.ajax({
            url: '<?=site_url()?>backend/tujuan/get_tujuan/'+id,
        }).done(function(response){
            var res = JSON.parse(response)
            $('#makanan').val(res[0].makanan);
            $('#kosmetik').val(res[0].kosmetik);
        });
    }
});
</script>