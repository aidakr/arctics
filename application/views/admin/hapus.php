<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $event->id_event ?>" title="Hapus event">
  <!-- <i class="fa fa-trash-o" ></i> -->
  <i class="fas fa-trash-alt"></i>
</button>

<div class="modal fade" id="myModal<?php echo $event->id_event ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                Apakah anda ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <a href="<?php echo base_url('admin/delete/'.$event->id_event)?>" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>
