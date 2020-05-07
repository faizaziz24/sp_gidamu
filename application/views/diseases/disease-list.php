  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-paperclip" aria-hidden="true"></i> Manajemen Penyakit
        <small>Daftar Penyakit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Daftar Penyakit</li>
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
                Daftar Penyakit
              </h3>
              <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>add-new-disease"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Penyakit</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama Penyakit</th>
                  <th>Penjelasan</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($diseaseRecords))
                    {
                        $count=0;
                        foreach($diseaseRecords as $record)
                        {
                    ?>
                      <tr>
                        <td><?php echo ++$count ?></td>
                        <td><?php echo $record->disease_code ?></td>
                        <td><?php echo $record->disease_name ?></td>
                        <td><?php echo $record->disease_explain ?></td>                       
                        <td class="text-center">
                            <a href="<?php echo base_url().'edit-old-disease/'.$record->disease_code; ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo base_url(); ?>disease-list" data-diseasecode="<?php echo $record->disease_code; ?>" class="btn btn-sm btn-danger delete-disease"><i class="fa fa-trash"></i></a>
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
