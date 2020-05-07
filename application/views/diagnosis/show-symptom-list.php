<?php
if(!empty($sroles))
{
    foreach ($sroles as $srs)
    {
        $scode      = $srs->symptom_code;
        $squestion  = $srs->symptom_question;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-stethoscope" aria-hidden="true"></i> Manajemen Diagnosis
        <small>Daftar Pertanyaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>diagnosis-list">Daftar Rekam Medis</a></li>
        <li><a href="<?php echo base_url(); ?>add-new-diagnosis">Tambah Diagnosis</a></li>
        <li class="active">Daftar Pertanyaan</li>
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
                        <h3 class="box-title">Daftar Pertanyaan Gejala</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="showsymptomlist" action="<?php echo base_url() ?>add-symptom-session" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group" align="center">
                              <label class="control-label">Jawab pertanyaan dibawah ini sesuai dengan gejala yang dialami</label>
                            </div>
                            <div class="form-group" align="center">
                              <?php echo $squestion ?>
                              <input type="hidden" class="form-control" id="scode" name="scode" value="<?php echo $scode ?>">
                            </div>
                            <div class="form-group" align="center">
                              <div class="col-sm-3 col-sm-offset-3">
                                <input type="radio" name="answer" id="answer" value="Y"> Iya
                              </div>
                              <div class="col-sm-2">
                                <input type="radio" name="answer" id="answer" value="T"> Tidak
                              </div>
                            </div>
                            <div class="form-group" align="center">
                              <div class="col-sm-12">
                                <label>
                                  <input type="range" class="custom-range" min="0" max="1" step="0.05" id="range_value" name="range_value" onchange="updateTextInput(this.value);">
                                </label>
                              </div>
                            </div>
                            <div class="form-group" align="center">
                              <div class="col-sm-12">
                                <label>
                                <input type="text" class="form-control required" id="cfvalue" name="cfvalue" disabled="disabled" value="0.5"></label>
                              </div>
                            </div>
                            <div class="form-group" align="center">
                              <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Lanjut</button>
                              </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>  
    </section>
</div>