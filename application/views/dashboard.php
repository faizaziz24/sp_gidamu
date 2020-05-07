<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Panel Kendali</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php
            if($roleCode == ROLE_ADMIN)
            {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pengguna</span>
                  <span class="info-box-number"><?php echo $userRecords ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <?php
            }
            ?>
            <?php
            if($roleCode == ROLE_PAKAR)
            {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="info-box bg-olive">
                <span class="info-box-icon"><i class="fa fa-paperclip"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Penyakit</span>
                  <span class="info-box-number"><?php echo $diseaseRecords ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-random"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Gejala</span>
                  <span class="info-box-number"><?php echo $symptomRecords ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="info-box bg-teal">
                <span class="info-box-icon"><i class="fa fa-share-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Aturan</span>
                  <span class="info-box-number"><?php echo $ruleRecords ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <?php
            }
            ?>
            <?php
            if($roleCode == ROLE_PERAWAT)
            {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-wheelchair"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Pasien</span>
                  <span class="info-box-number"><?php echo $patientRecords ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Rekam Medis</span>
                  <span class="info-box-number"><?php echo $diagnosisRecords ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <?php
            }
            ?>
          </div>
    </section>
</div>