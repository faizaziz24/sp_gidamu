<?php
if(!empty($diseaseInfo))
{
    foreach ($diseaseInfo as $df)
    {
        $dcode   = $df->disease_code;
        $dname   = $df->disease_name;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-share-alt" aria-hidden="true"></i> Manajemen Aturan
        <small>Daftar Aturan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>rule-list">Daftar Penyakit</a></li>
        <li class="active">Daftar Aturan</li>
      </ol>
    </section>    
    <section class="content">     
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Aturan</h3>
            </div>
            <form id="addnewrule" action="<?php echo base_url() ?>save-new-rule" method="post" role="form">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nama Penyakit</label>
                        <input type="text" class="form-control" id="fname" name="fname" disabled="disabled" value="<?php echo $dname ?>">
                        <input type="hidden" class="form-control" id="drole" name="drole" value="<?php echo $dcode ?>">
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Nama Gejala</label>
                        <select class="form-control required select2" id="srole" name="srole">
                            <option value="">Silahkan pilih gejala</option>
                            <?php
                            if(!empty($sroles))
                            {
                                foreach ($sroles as $srl)
                                {
                                    ?>
                                    <option value="<?php echo $srl->symptom_code ?>"><?php echo $srl->symptom_code ?>. <?php echo $srl->symptom_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" class="form-control" id="rcode" name="rcode" value="<?php echo $coder ?>">
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Jarak CF</label>
                        <input type="range" class="custom-range" min="0" max="1" step="0.05" id="range_value" name="range_value" onchange="updateTextInput(this.value);">
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->                
                    <div class="col-md-1">
                      <div class="form-group">
                        <label>Nilai CF</label>
                            <input type="text" class="form-control required" id="cfvalue" name="cfvalue" disabled="disabled" value="0.5">
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
            </form>
         </div>
        <!-- /.box -->

        <div class="row">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <form class="form-horizontal" id="addnewrule" action="<?php echo base_url() ?>save-new-rule" method="post" role="form">
                        <div class="box-body">
                          <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No.</th>
                              <th>Kode</th>
                              <th>Nama Gejala</th>
                              <th class="text-center">Nilai CF</th>
                              <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php
                                if(!empty($diseaseInfo))
                                {
                                    $count=0;
                                    foreach($diseaseInfo as $record)
                                    {
                                ?>
                                  <tr>
                                    <td><?php echo ++$count ?></td>
                                    <td><?php echo $record->symptom_code ?></td>
                                    <td><?php echo $record->symptom_name ?></td>
                                    <td class="text-center"><?php echo $record->cf_value ?></td>                  
                                    <td class="text-center">
                                        <a href="<?php echo base_url().'edit-old-rule/'.$record->rule_code; ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                        <a href="#" data-rulecode="<?php echo $record->rule_code; ?>" class="btn btn-sm btn-danger delete-rule"><i class="fa fa-trash"></i></a>
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
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>   
    </section>
</div>