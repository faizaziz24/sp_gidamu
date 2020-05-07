<?php
if(!empty($patientInfo))
{
    foreach ($patientInfo as $pf)
    {
        $pcode    = $pf->patient_code;
        $pname    = $pf->patient_name;
        $pdate    = $pf->patient_born_date;
        $pgender  = $pf->patient_gender;
        $paddress = $pf->patient_address;
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-wheelchair" aria-hidden="true"></i> Manajemen Diagnosis
        <small>Ubah Pasien</small>
      </h1>      
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>diagnosis-list">Daftar Pasien</a></li>
        <li class="active">Ubah Pasien</li>
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
                    <form class="form-horizontal" id="editoldpatient" action="<?php echo base_url() ?>patient-update" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nama Lengkap</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="fname" name="fname" maxlength="128" placeholder="Nama Lengkap" value="<?php echo $pname ?>">
                                <input type="hidden" class="form-control" id="pcode" name="pcode" value="<?php echo $pcode ?>">
                              </div>
                            </div>                            
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Tanggal Lahir</label>
                              <div class="col-sm-8">
                                <div class="input-group date">
                                  <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd" value="<?php echo $pdate ?>">
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
                                    <input type="radio" name="gender" id="gender" value="L" <?php if($pgender =='L') echo 'checked="checked"'; ?>>
                                  Laki-laki</label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="gender" id="gender" value="P" <?php if($pgender =='P') echo 'checked="checked"'; ?>>
                                  Perempuan</label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Alamat</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="address" name="address" maxlength="128" placeholder="Alamat" value="<?php echo $paddress ?>">
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