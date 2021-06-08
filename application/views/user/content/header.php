<?php 
if (!empty($_SESSION['user_data']->id_image_profile)) {
  $gambar_profile_header = $_SESSION['user_data']->id_image_profile;
} else {
  $gambar_profile_header = base_url().'assets/template/miminium/asset/img/avatar.jpg';
}
?>

<!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="<?=base_url('user/home')?>" class="navbar-brand"> 
                 <b>Caturindo</b>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?=$_SESSION['user_data']->username?></span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="<?=$gambar_profile_header?>" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                      <li>
                        <a href="<?=base_url('user/profile')?>">
                          <span class="fa fa-user"></span> My Profile
                        </a>
                      </li>
                      <li>
                        <a href="<?=base_url('user/home/logout')?>">
                          <span class="fa fa-power-off "></span> Logout
                        </a>
                      </li>
                     <!-- <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li> -->
                     <!-- <li role="separator" class="divider"></li> -->
                     <!-- <li class="more"> -->
                      <!-- <ul> -->
                        <!-- <li><a href=""><span class="fa fa-cogs"></span></a></li> -->
                        <!-- <li><a href=""><span class="fa fa-lock"></span></a></li> -->
                        <!-- <li><a href="#"><span class="fa fa-user"></span></a></li> -->
                        <!-- <li><a href="<?=base_url('user/home/logout')?>"><span class="fa fa-power-off "></span></a></li> -->
                      <!-- </ul> -->
                    <!-- </li> -->
                  </ul>
                </li>
                <!-- <li ><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li> -->
              </ul>
            </div>
          </div>
        </nav>
<!-- end: Header -->