  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-share-alt" aria-hidden="true"></i> Manajemen Aturan
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
              <a class="btn btn-success pull-right" href="<?php echo base_url(); ?>add-new-rule"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Aturan</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama Penyakit</th>
                  <th class="text-center">Jumlah Gejala</th>
                  <th class="text-center">Nilai CF</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($ruleRecords))
                    {
                        $count=0;
                        foreach($ruleRecords as $record)
                        {
                    ?>
                      <tr>
                        <td><?php echo ++$count ?></td>
                        <td><?php echo $record->disease_code ?></td>
                        <td><?php echo $record->disease_name ?></td>
                        <td class="text-center"><?php echo $record->item_symptom ?> gejala</td>  
                        <td class="text-center"><?php echo $record->cf_value ?></td>                  
                        <td class="text-center">
                            <a href="<?php echo base_url().'view-old-rule/'.$record->disease_code; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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
