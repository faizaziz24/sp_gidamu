<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-stethoscope" aria-hidden="true"></i> Manajemen Diagnosis
        <small>Tambah Diagnosis</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>diagnosis-list">Daftar Rekam Medis</a></li>
        <li class="active">Tambah Diagnosis</li>
      </ol>
    </section>    
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
        </div>  
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masukkan Detail Diagnosis</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="addnewdiagnosis" action="<?php echo base_url() ?>save-new-tmp-diagnosis" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group" align="center">
                              <label class="control-label">Silahkan pilih pasien terlebih dahulu.</label>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <select class="form-control select2 required" id="prole" name="prole">
                                    <option value="">Silahkan pilih pasien</option>
                                    <?php
                                    if(!empty($proles))
                                    {
                                        foreach ($proles as $prl)
                                        {
                                            ?>
                                            <option value="<?php echo $prl->patient_code ?>"><?php echo $prl->patient_code ?>. <?php echo $prl->patient_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-default"><a href="<?php echo base_url(); ?>add-new-patient"><i class="fa fa-plus"></i> Tambah Pasien</a></button>
                            <button type="submit" class="btn btn-success pull-right">Simpan</button>
                        </div>
                  <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>   
        <div>
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>