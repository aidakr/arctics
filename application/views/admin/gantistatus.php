<!-- Begin Page Content -->
<div class="container-fluid">
  <?= $this->session->flashdata('suksesstatus');?>

  <!-- Page Heading -->


  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th><center>No</center></th>
                <th><center>Nama event</center></th>
                <th><center>Waktu</center></th>
                <th><center>Tempat</center></th>
                <th><center>Deskripsi</center></th>
                <th><center>Contact Person</center></th>
                <th><center>Status</center></th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
          <?php $i=1; foreach ($event as $event) {?>
            <tr class="odd gradeX">
                <td></center><?php echo $i ?></center></td>
                <td><?php echo $event->nama_event ?></td>
                <td><?php echo $event->waktu ?></td>
                <td><?php echo $event->tempat ?></td>
                <td><?php echo $event->deskripsi ?></td>
                <td><?php echo $event->contact_person ?></td>
                <td><?php echo $event->status ?></td>
                <td><center><a href="<?php echo base_url('admin/editstatus/'.$event->id_event)?>" class="btn btn-danger btn-sm" title="Ganti Status">
                <i class="fa fa-edit"></i></a></center>
                </td>
            </tr>
            <?php $i++; }?>
          </tbody>
    </table>

  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
