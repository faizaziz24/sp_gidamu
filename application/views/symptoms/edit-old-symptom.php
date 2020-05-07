<?php
if(!empty($symptomInfo))
{
    foreach ($symptomInfo as $sf)
    {
        $scode    = $sf->symptom_code;
        $sname    = $sf->symptom_name;
        $squest   = $sf->symptom_question;        
        $syes     = $sf->if_yes;        
        $sno      = $sf->if_no;        
        $sstart   = $sf->start;        
        $send     = $sf->end;
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-random" aria-hidden="true"></i> Manajemen Gejala
        <small>Ubah Gejala</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>symptom-list">Daftar Gejala</a></li>
        <li class="active">Ubah Gejala</li>
      </ol>
    </section>    
    <section class="content">   
        <div class="row">
            <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masukkan Detail Gejala</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="editoldsymptom" action="<?php echo base_url() ?>symptom-update" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nama Gejala</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="sname" name="sname" maxlength="128" placeholder="Nama Gejala" value="<?php echo $sname ?>">
                                <input type="hidden" class="form-control" id="scode" name="scode" value="<?php echo $scode ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Pertanyaan</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="squest" name="squest" maxlength="128" placeholder="Pertanyaan" value="<?php echo $squest ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Jika Iya</label>
                              <div class="col-sm-8">
                                <select class="form-control select2 required" id="syes" name="syes">
                                  <option value="">Silahkan pilih jika jawaban iya</option>
                                    <?php
                                    if(!empty($sroles))
                                    {
                                        foreach ($sroles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->symptom_code ?>" <?php if($rl->symptom_code == $syes) {echo "selected=selected";} ?>><?php echo $rl->symptom_code ?>. <?php echo $rl->symptom_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if(!empty($droles))
                                    {
                                        foreach ($droles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->disease_code ?>" <?php if($rl->disease_code == $syes) {echo "selected=selected";} ?>><?php echo $rl->disease_code ?>. <?php echo $rl->disease_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Jika Tidak</label>
                              <div class="col-sm-8">
                                <select class="form-control select2 required" id="sno" name="sno">
                                  <option value="">Silahkan pilih jika jawaban tidak</option>
                                    <?php
                                    if(!empty($sroles))
                                    {
                                        foreach ($sroles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->symptom_code ?>" <?php if($rl->symptom_code == $sno) {echo "selected=selected";} ?>><?php echo $rl->symptom_code ?>. <?php echo $rl->symptom_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if(!empty($droles))
                                    {
                                        foreach ($droles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->disease_code ?>" <?php if($rl->disease_code == $sno) {echo "selected=selected";} ?>><?php echo $rl->disease_code ?>. <?php echo $rl->disease_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Mulai</label>
                              <div class="col-sm-8">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="sstart" id="sstart" value="Y" <?php if($sstart =='Y') echo 'checked="checked"'; ?>>
                                  Iya</label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="sstart" id="sstart" value="T" <?php if($sstart =='T') echo 'checked="checked"'; ?>>
                                  Tidak</label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Diakhiri</label>
                              <div class="col-sm-8">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="send" id="send" value="Y" <?php if($send =='Y') echo 'checked="checked"'; ?>>
                                  Iya</label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="send" id="send" value="T" <?php if($send =='T') echo 'checked="checked"'; ?>>
                                  Tidak</label>
                                </div>
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