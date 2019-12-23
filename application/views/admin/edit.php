
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <?= $this->session->flashdata('suksesedit');?>

        <!-- Page Heading -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">
            <form class="user" method="post" action="<?=base_url('admin/edit/'.$event->id_event)?>">

                <div class="form-group">
                  <label>Nama Event</label>
                  <input type="text" name="nama_event" class="form-control" placeholder="Nama Event" value="<?=$event->nama_event; ?>" required>
                    <?= form_error('nama_event','<small class="text-danger pl-3">','</small>'); ?>
                </div>


                <div class="form-group">
                  <label>Waktu</label>
                  <input type="date" name="waktu" class="form-control tanggal" placeholder="Tanggal pelaksanaan" value="<?=$event->waktu;?>">
                    <?= form_error('waktu','<small class="text-danger pl-3">','</small>'); ?>
                </div>


                <div class="form-group form-group-lg">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Event" required >
                    <?=$event->deskripsi;?>
                  </textarea>
                   <?= form_error('deskripsi','<small class="text-danger pl-3">','</small>'); ?>
                </div>

                <div class="form-group">
                  <label>Tempat</label>
                  <input type="text" name="tempat" class="form-control" placeholder="Tempat" value="<?php echo $event->tempat ?>" required>
                    <?= form_error('tempat','<small class="text-danger pl-3">','</small>'); ?>
                </div>

                <div class="form-group">
                  <label>Contact Person</label>
                  <input type="text" name="contact_person" class="form-control" placeholder="Tempat" value="<?php echo $event->contact_person ?>" required>
                    <?= form_error('contact_person','<small class="text-danger pl-3">','</small>'); ?>
                </div>

                <div class="form-group">
                  <label>Status Event</label>
                  <select class="form-control" name="status" >
                    <option value="checking" <?php if($event->status=="checking") { echo "selected"; }?>>Checking</option>
                    <option value="rejected" <?php if($event->status=="rejected") { echo "selected"; }?>>Rejected</option>
                    <option value="upcoming" <?php if($event->status=="upcoming") { echo "selected"; }?>>Upcoming</option>
                    <option value="end" <?php if($event->status=="end") { echo "selected"; }?>>End</option>
                  </select>
                     <?= form_error('status','<small class="text-danger pl-3">','</small>'); ?>
                </div>

            <button type="submit" name="submit" class="btn btn-primary btn-lg">
              Save
            </button>
        </form>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
