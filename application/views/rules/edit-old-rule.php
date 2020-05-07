<?php
if(!empty($ruleInfo))
{
    foreach ($ruleInfo as $rf)
    {
        $rcode    = $rf->rule_code;
        $dcode    = $rf->disease_code;
        $scode    = $rf->symptom_code;
        $cfvalue  = $rf->cf_value;
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-share-alt" aria-hidden="true"></i> Manajemen Aturan
        <small>Ubah Aturan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>rule-list">Daftar Penyakit</a></li>
        <li><a href="<?php echo base_url(); ?>view-old-rule"/>Daftar Aturan</a></li>
        <li class="active">Ubah Aturan</li>
      </ol>
    </section>    
    <section class="content">   
        <div class="row">
            <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masukkan Detail Aturan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="editoldrule" action="<?php echo base_url() ?>rule-update" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Penyakit</label>
                              <div class="col-sm-8">
                                <select class="form-control required select2" id="drole" name="drole">
                                    <option value="">Silahkan pilih penyakit</option>
                                    <?php
                                    if(!empty($droles))
                                    {
                                        foreach ($droles as $drl)
                                        {
                                            ?>
                                            <option value="<?php echo $drl->disease_code ?>" <?php if($drl->disease_code == $dcode) {echo "selected=selected";} ?>><?php echo $drl->disease_code ?>. <?php echo $drl->disease_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" class="form-control" id="rcode" name="rcode" value="<?php echo $rcode ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Gejala</label>
                              <div class="col-sm-8">
                                <select class="form-control required select2" id="srole" name="srole">
                                    <option value="">Silahkan pilih gejala</option>
                                    <?php
                                    if(!empty($sroles))
                                    {
                                        foreach ($sroles as $srl)
                                        {
                                            ?>
                                            <option value="<?php echo $srl->symptom_code ?>" <?php if($srl->symptom_code == $scode) {echo "selected=selected";} ?>><?php echo $srl->symptom_code ?>. <?php echo $srl->symptom_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nilai CF</label>
                              <div class="col-sm-8">
                                <input type="range" class="custom-range" min="0" max="1" step="0.05" id="range_value" name="range_value" value="<?php echo $cfvalue ?>" onchange="updateTextInput(this.value);">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label"></label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control required" id="cfvalue" name="cfvalue" disabled="disabled" value="<?php echo $cfvalue ?>">
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