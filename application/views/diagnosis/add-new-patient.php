<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-stethoscope" aria-hidden="true"></i> Manajemen Diagnosis
        <small>Tambah Pasien</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>diagnosis-list">Daftar Rekam Medis</a></li>
        <li><a href="<?php echo base_url(); ?>add-new-diagnosis">Tambah Diagnosis</a></li>
        <li class="active">Tambah Pasien</li>
      </ol>
    </section>    
    <section class="content">   
        <div class="row">
            <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masukkan Detail Pasien</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="addnewpatient" action="<?php echo base_url() ?>save-new-patient" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nama Lengkap</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="fname" name="fname" maxlength="128" placeholder="Nama Lengkap">
                                <input type="hidden" class="form-control" id="pcode" name="pcode" value="<?php echo $codes ?>">
                              </div>
                            </div>                            
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Tanggal Lahir</label>
                              <div class="col-sm-8">
                                <div class="input-group date">
                                  <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Jenis Kelamin</label>
                              <div class="col-sm-8">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="gender" id="gender" value="L">
                                  Laki-laki</label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="gender" id="gender" value="P">
                                  Perempuan</label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Alamat</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="address" name="address" maxlength="128" placeholder="Alamat">
                              </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Ulangi</button>
                            <button type="submit" class="btn btn-success pull-right">Simpan</button>
                        </div>
                  <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
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