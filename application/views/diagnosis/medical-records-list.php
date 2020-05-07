<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-stethoscope" aria-hidden="true"></i> Manajemen Diagnosis
      <small>Daftar Rekam Medis</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url(); ?>diagnosis-list"> Daftar Pasien</a></li>
      <li class="active">Daftar Rekam Medis</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <?php
              $error = $this->session->flashdata('error');
              if($error)
              {
          ?>
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('error'); ?>                    
          </div>
          <?php } ?>
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
              Daftar Rekam Medis
            </h3>            
            <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>add-new-diagnosis"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Diagnosis</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>Kode Diagnosis</th>
                <th>Nama Pasien</th>
                <th>Nama Penyakit</th>
                <th>Nilai CF</th>
                <th>Tanggal</th>
                <th>Diperiksa</th>
                <th class="text-center">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  if(!empty($patientInfo))
                  {
                      $count=0;
                      foreach($patientInfo as $record)
                      {
                  ?>
                    <tr>
                      <td><?php echo ++$count ?></td>
                      <td><?php echo $record->diagnosis_code ?></td>
                      <td><?php echo $record->patient_name ?></td>
                      <td><?php echo $record->disease_name ?></td>
                      <td><?php echo $record->cf_total ?></td>
                      <td><?php echo $record->created_dtm ?></td>
                      <td><?php echo $record->user_name ?></td>                        
                      <td class="text-center">
                          <a href="<?php echo base_url().'view-old-diagnosis/'.$record->diagnosis_code; ?>" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a> |            
                          <a href="<?php echo base_url(); ?>diagnosis-list" data-diagnosiscode="<?php echo $record->diagnosis_code; ?>" class="btn btn-sm btn-danger delete-diagnosis"><i class="fa fa-trash"></i></a>
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
