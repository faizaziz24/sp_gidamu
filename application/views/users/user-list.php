  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user" aria-hidden="true"></i> Manajemen Pengguna
        <small>Daftar Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Daftar Pengguna</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <?php  
                $success = $this->session->flashdata('success');
                if($success)
                {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>      
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                Daftar Pengguna
              </h3>
              <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>add-new-user"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Pengguna</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama Pengguna</th>
                  <th>Bagian</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($userRecords))
                    {
                        $count=0;
                        foreach($userRecords as $record)
                        {
                    ?>
                      <tr>
                        <td><?php echo ++$count ?></td>
                        <td><?php echo $record->user_code ?></td>
                        <td><?php echo $record->user_name ?></td>
                        <td><?php echo $record->role_name ?></td>                        
                        <td><?= ($record->user_activated == 1) ? " Aktif " : "Tidak Aktif" ?></td>
                        <td class="text-center">
                          <a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->user_code; ?>" title="Login history"><i class="fa fa-history"></i></a> | 
                            <a href="<?php echo base_url().'edit-old-user/'.$record->user_code; ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="#" data-usercode="<?php echo $record->user_code; ?>" class="btn btn-sm btn-danger delete-user"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
