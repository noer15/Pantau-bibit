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
            <th>Kabupaten</th>
            <th>Total Penyumbang</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($show as $row ): ?>
           <tr>
               <td><?=$row->nama_kab ?></td>
               <td><?=$row->total ?></td>
           </tr>
       <?php endforeach ?>   
</table>
