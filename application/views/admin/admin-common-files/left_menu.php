<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<?php
$dashboard_active = '';
$sp_active = '';
$customers_active = '';
$reviews_active = '';
$setting_active = '';
$setting_main_open = '';
$user_active = '';
$user_main_open = '';

$coupon_active = '';
$coupon_main_open = '';

$pro_active = '';
$pro_main_open = '';

$trx_active = '';
$trx_main_open = '';

$rv_active = '';
$rv_main_open = '';

if($this->router->class=='dashboard' || $this->router->class=='Dashboard')
{
	$dashboard_active = 'active';
}
elseif($this->router->class=='setting' || $this->router->class=='Setting')
{
	$setting_active = 'active';
    $setting_main_open = 'open';
    
}elseif($this->router->class=='users' || $this->router->class=='users')
{
	$user_active = 'active';
    $user_main_open = 'open';
    
}elseif($this->router->class=='coupons' || $this->router->class=='coupons')
{
	$coupon_active = 'active';
    $coupon_main_open = 'open';
    
}elseif($this->router->class=='projections' || $this->router->class=='projections')
{
	$pro_active = 'active';
    $pro_main_open = 'open';
    
}elseif($this->router->class=='transactions' || $this->router->class=='transactions')
{
    $trx_active = 'active';
    $trx_main_open = 'open';
}elseif($this->router->class=='reviews' || $this->router->class=='reviews')
{
    $rv_active = 'active';
    $rv_main_open = 'open';
}
else
{
	$dashboard_active = 'active';
}
?>
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item <?php echo $dashboard_active;?>"><a href="<?php echo base_admin_url("dashboard");?>"><i class="ft-menu"></i><span class="menu-title">Dashboard</span></a></li>
             <li class="nav-item <?php echo $setting_active;?> <?php echo $setting_main_open;?>"><a href="javascript:;"><i class="ft ft-settings"></i><span class="menu-title">Setting</span></a>
                <ul class="menu-content">
					<li><a class="menu-item" href="<?php echo base_admin_url("setting/Changepassword");?>">Change Password</a></li>
					<li><a class="menu-item" href="<?php echo base_admin_url("setting/Profile");?>">Update Profile</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo $user_active;?> <?php echo $user_main_open;?>"><a href="<?php echo base_admin_url("users");?>"><i class="ft ft-user"></i><span class="menu-title">Users</span></a></li>

            <li class="nav-item <?php echo $coupon_active;?> <?php echo $coupon_main_open;?>"><a href="<?php echo base_admin_url("coupons");?>"><i class="ft-zap"></i><span class="menu-title">Coupons</span></a></li>

            <li class="nav-item <?php echo $pro_active;?> <?php echo $pro_main_open;?>"><a href="<?php echo base_admin_url("projections");?>"><i class="ft-grid"></i><span class="menu-title">Projections</span></a></li>

            <li class="nav-item <?php echo $trx_active;?> <?php echo $trx_main_open;?>"><a href="<?php echo base_admin_url("transactions");?>"><i class="ft-credit-card"></i><span class="menu-title">Transactions</span></a></li>

            <li class="nav-item <?php echo $rv_active;?> <?php echo $rv_main_open;?>"><a href="<?php echo base_admin_url("reviews");?>"><i class="ft-message-circle"></i><span class="menu-title">Reviews</span></a></li>
            
            <li class="nav-item"><a href="<?php echo base_admin_url("logout");?>"><i class="ft-power"></i><span class="menu-title" data-i18n="nav.animation.main">Logout</span></a></li>
        </ul>
    </div>
</div>