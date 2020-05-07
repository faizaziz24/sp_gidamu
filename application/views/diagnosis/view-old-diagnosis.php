<?php
if(!empty($diagnosisInfo))
{
    foreach ($diagnosisInfo as $df)
    {
        $dgcode     = $df->diagnosis_code;
        $dgcf       = $df->cf_total;
        $uname      = $df->user_name;
        $uphone     = $df->user_phone;
        $dgdtm      = $df->created_dtm;
        $pcode      = $df->patient_code;
        $pname      = $df->patient_name;
        $pgender    = $df->patient_gender;
        $pborn      = $df->patient_born_date;
        $paddress   = $df->patient_address;
        $dcode      = $df->disease_code;
        $dname      = $df->disease_name;
        $dexplain   = $df->disease_explain;
        $dheal      = $df->healing;
        $dprevent   = $df->preventing;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-stethoscope" aria-hidden="true"></i> Manajemen Diagnosis
        <small>Hasil Rekam Medis</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>diagnosis-list">Daftar Pasien</a></li>
        <li><a href="<?php echo base_url().'medical-records-list/'.$pcode; ?>">Daftar Rekam Medis</a></li>
        <li class="active">Hasil Rekam Medis</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
        
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
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-hospital-o"></i> Hasil Rekam Medis #<?php echo $dgcode; ?>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
          Data Rekam Medis :<br>
          <br>
          <address>
            <b>Diperiksa Oleh:</b> <?php echo $uname; ?><br>
            <b>Tanggal Periksa:</b> <?php echo $dgdtm; ?><br>
            <b>Nomor Telepon:</b> <?php echo $uphone; ?><br>
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          Data Pasien :<br>
          <br>
          <address>
            <b>Nama Pasien:</b> <?php echo $pname; ?><br>
            <b>Jenis Kelamin:</b> <?php echo $pgender; ?><br>
            <b>Tanggal Lahir:</b> <?php echo $pborn; ?><br>
            <b>Almaat Pasien:</b> <?php echo $paddress; ?><br>
          </address>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
                <th>Atribut</th>
                <th>Penjelasan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nama Penyakit</td>
                <td><?php echo $dcode; ?> - <?php echo $dname; ?></td>
            </tr>
            <tr>
                <td>Nilai Keyakinan</td>
                <td><?php echo $dgcf; ?> %</td>
            </tr>
            <tr>
                <td>Definisi Penyakit</td>
                <td><?php echo $dexplain; ?></td>
            </tr>
            <tr>
                <td>Gejala-gejala yang dialami</td>
                <td>
                    <?php
                    if(!empty($diseaseInfo))
                    {
                        $count=0;
                        foreach($diseaseInfo as $record)
                        {
                    ?>
                        <h5><?php echo ++$count ?>. <?php echo $record->symptom_name ?></h5>
                    <?php
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Pengobatan</td>
                <td><?php echo $dheal; ?></td>
            </tr>
            <tr>
                <td>Pencegahan</td>
                <td><?php echo $dprevent; ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-12">
          <p class="lead">Keterangan :</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Jika terjadi sakit berkelanjutan, silahkan hubungi dokter gigi terdekat.
          </p>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url().'print-old-diagnosis/'.$dgcode; ?>" target="_blank" class="btn btn-success pull-right"><i class="fa fa-print"></i> Cetak</a>
        </div>
      </div>
    </section>

    <!-- /.content -->
    <div class="clearfix"></div>
</div>