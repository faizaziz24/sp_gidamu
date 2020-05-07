<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user" aria-hidden="true"></i> Manajemen Pengguna
      <small>Riwayat Login Pengguna</small>
    </h1>    
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url(); ?>user-list">Daftar Pengguna</a></li>
      <li class="active">Riwayat Login Pengguna</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Riwayat Login Pengguna
            </h3>            
              <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>login-history"><i class="fa fa-history" aria-hidden="true"></i> Riwayat Login Semua</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>Kode Pengguna</th>
                <th>Riwayat Pengguna</th>
                <th>Alamat IP</th>
                <th>Tipe Browser</th>
                <th>Sistem Operasi</th>
                <th>Tanggal</th>
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
                      <td><?php echo $record->session_data ?></td>
                      <td><?php echo $record->machine_ip ?></td>
                      <td><?php echo $record->browser_type ?></td>
                      <td><?php echo $record->platform ?></td>
                      <td><?php echo $record->created_dtm ?></td>
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
