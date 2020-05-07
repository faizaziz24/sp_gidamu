<?php
if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $ucode   = $uf->user_code;
        $rcode   = $uf->role_code;
        $uname   = $uf->user_name;
        $uemail  = $uf->user_email;
        $uphone  = $uf->user_phone;
        $uactive = $uf->user_activated;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user" aria-hidden="true"></i> Manajemen Pengguna
        <small>Ubah Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>user-list">Daftar Pengguna</a></li>
        <li class="active">Ubah Pengguna</li>
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
                    <form class="form-horizontal" id="editolduser" action="<?php echo base_url() ?>user-update" method="post" role="form">
                        <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nama Lengkap</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required" id="fname" name="fname" maxlength="128" placeholder="Nama Lengkap" value="<?php echo $uname ?>">
                                <input type="hidden" class="form-control" id="ucode" name="ucode" value="<?php echo $ucode ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Email</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required email" id="email"  name="email" maxlength="128" placeholder="Email" value="<?php echo $uemail ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Nomor Telepon</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control required digits" id="phone" name="phone" maxlength="20" placeholder="Nomor Telepon" value="<?php echo $uphone ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Password</label>
                              <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" maxlength="20" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Ulangi Password</label>
                              <div class="col-sm-8">
                                <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="20" placeholder="Password">
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
                                            <option value="<?php echo $rl->role_code ?>" <?php if($rl->role_code == $rcode) {echo "selected=selected";} ?>><?php echo $rl->role_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Status</label>
                              <div class="col-sm-8">
                                <select class="form-control" id="status" name="status">
                                    <option value="0" <?php if($uactive == 0) {echo "selected=selected";} ?>>Tidak Aktif</option>
                                    <option value="1" <?php if($uactive == 1) {echo "selected=selected";} ?>>Aktif</option>
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