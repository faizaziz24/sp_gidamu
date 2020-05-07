<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user" aria-hidden="true"></i> Manajemen Pengguna
        <small>Tambah Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>user-list">Daftar Pengguna</a></li>
        <li class="active">Tambah Pengguna</li>
      </ol>
    </section>    
    <section class="content">   
        <div class="row">
            <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Masukkan Detail Pengguna</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="addnewuser" action="<?php echo base_url() ?>save-new-user" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nama Lengkap</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="fname" name="fname" maxlength="128" placeholder="Nama Lengkap">
                                <input type="hidden" class="form-control" id="ucode" name="ucode" value="<?php echo $codes ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Email</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required email" id="email"  name="email" maxlength="128" placeholder="Email">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nomor Telepon</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required digits" id="phone" name="phone" maxlength="20" placeholder="Nomor Telepon">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Password</label>
                              <div class="col-sm-8">
                                <input type="password" class="form-control required" id="password" name="password" maxlength="20" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Ulangi Password</label>
                              <div class="col-sm-8">
                                <input type="password" class="form-control required" id="cpassword" name="cpassword" maxlength="20" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Bagian</label>
                              <div class="col-sm-8">
                                <select class="form-control required" id="role" name="role">
                                    <option value="0">Silahkan pilih bagian</option>
                                    <?php
                                    if(!empty($roles))
                                    {
                                        foreach ($roles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->role_code ?>"><?php echo $rl->role_name ?></option>
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