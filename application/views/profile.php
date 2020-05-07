<?php
$userCode   = $userInfo->user_code;
$userName   = $userInfo->user_name;
$userEmail  = $userInfo->user_email;
$userPhone  = $userInfo->user_phone;
$roleName   = $userInfo->role_name;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-circle"></i> Profil
        <small>Tampil atau Modifikasi Informasi</small>
      </h1>
    </section>    
    <section class="content">    
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/images/profile.png" alt="User profile picture">
                        <h3 class="profile-username text-center"><?= $userName ?></h3>

                        <p class="text-muted text-center"><?= $roleName ?></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?= $userEmail ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Nomor Telepon</b> <a class="pull-right"><?= $userPhone ?></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="<?= ($active == "details")? "active" : "" ?>"><a href="#details" data-toggle="tab">Detail Pengguna</a></li>
                        <li class="<?= ($active == "changepass")? "active" : "" ?>"><a href="#changepass" data-toggle="tab">Ubah Password</a></li>                        
                    </ul>
                    <div class="tab-content">
                        <div class="<?= ($active == "details")? "active" : "" ?> tab-pane" id="details">
                            <form action="<?php echo base_url() ?>profile-update" method="post" role="form">
                                <?php $this->load->helper('form'); ?>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                                <label >Nama Pengguna</label>
                                                <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo $userName; ?>" value="<?php echo set_value('fname', $userName); ?>" maxlength="128" />
                                                <input type="hidden" value="<?php echo $userCode; ?>" name="userCode" id="userCode" />    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Nomor Telepon</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $userPhone; ?>" value="<?php echo set_value('phone', $userPhone); ?>" maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="reset" class="btn btn-default" value="Ulangi" />
                                    <input type="submit" class="btn btn-success pull-right" value="Simpan" />
                                </div>
                            </form>
                        </div>
                        <div class="<?= ($active == "changepass")? "active" : "" ?> tab-pane" id="changepass">
                            <form role="form" action="<?php echo base_url() ?>change-password" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPassword1">Password Lama</label>
                                                <input type="password" class="form-control" id="inputOldPassword" placeholder="Old password" name="oldPassword" maxlength="20" required>
                                                <input type="hidden" value="<?php echo $userCode; ?>" name="userCode" id="userCode" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPassword1">Password Baru</label>
                                                <input type="password" class="form-control" id="inputPassword1" placeholder="New password" name="newPassword" maxlength="20" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPassword2">Konfirmasi Password Baru</label>
                                                <input type="password" class="form-control" id="inputPassword2" placeholder="Confirm new password" name="cNewPassword" maxlength="20" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
            
                                <div class="box-footer">
                                    <input type="reset" class="btn btn-default" value="Ulangi" />
                                    <input type="submit" class="btn btn-success pull-right" value="Simpan" />
                                </div>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>

            <div class="col-md-4">
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

                <?php  
                    $noMatch = $this->session->flashdata('nomatch');
                    if($noMatch)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('nomatch'); ?>
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