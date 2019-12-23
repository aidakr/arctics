      <!-- Begin Page Content -->
      <div class="container-fluid">
          <?= $this->session->flashdata('suksesedit');?>
          <?= $this->session->flashdata('sukseshapus');?>
          <?= $this->session->flashdata('suksestambah');?>
        <!-- Page Heading -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">
            <div class="card-columns">
              <?php foreach ($event as $event) {?>
              <div class="card" style="width: 18rem;">
                <img src="<?=base_url('assets/img/festive.jpg')?>" class="card-img-top" >
                <div class="card-body">
                  <h5 class="card-title"><?=$event->nama_event?></h5>
                  <p class="card-text"><?php echo $event->deskripsi ?></p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Waktu: <?php echo $event->waktu ?></li>
                  <li class="list-group-item">Tempat: <?php echo $event->tempat ?></li>
                  <li class="list-group-item">Cp: <?php echo $event->contact_person ?></li>
                  <li class="list-group-item">Status: <?php echo $event->status?></li>
                </ul>
              </div>
                  <?php }?>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
