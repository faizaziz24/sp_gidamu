<?php
if(!empty($diseaseInfo))
{
    foreach ($diseaseInfo as $df)
    {
        $dcode       = $df->disease_code;
        $dname       = $df->disease_name;
        $dexplain    = $df->disease_explain;
        $dhealing    = $df->healing;
        $dpreventing = $df->preventing;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-paperclip" aria-hidden="true"></i> Manajemen Penyakit
        <small>Ubah Penyakit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>disease-list">Daftar Penyakit</a></li>
        <li class="active">Ubah Penyakit</li>
      </ol>      
    </section>    
    <section class="content">   
        <div class="row">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masukkan Detail Penyakit</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="editolddisease" action="<?php echo base_url() ?>disease-update" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nama Penyakit</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="dname" name="dname" maxlength="128" placeholder="Nama penyakit" value="<?php echo $dname ?>">
                                <input type="hidden" class="form-control" id="dcode" name="dcode" value="<?php echo $dcode ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Penjelasan</label>
                              <div class="col-sm-8">
                                <textarea class="textarea" id="explain" name="explain" placeholder="Penjelasan penyakit" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $dexplain ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Pengobatan</label>
                              <div class="col-sm-8">
                                <textarea class="textarea" id="healing" name="healing" placeholder="Pengobatannya" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $dhealing ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Pencegahan</label>
                              <div class="col-sm-8">
                                <textarea class="textarea" id="preventing" name="preventing" placeholder="Pencegahannya" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $dpreventing ?></textarea>
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