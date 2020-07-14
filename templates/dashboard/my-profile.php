<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */


$uid = get_current_user_id();
$user = get_userdata( $uid );

$profile_settings_link = tutor_utils()->get_tutor_dashboard_page_permalink('settings');
$rdate = date( "D d M Y, h:i:s a", strtotime( $user->user_registered ) );
$fname = $user->first_name;
$lname = $user->last_name;
$uname = $user->user_login;
$email = $user->user_email;
$phone = get_user_meta($uid,'phone_number',true);
$bio = nl2br(strip_tags(get_user_meta($uid,'_tutor_profile_bio',true)));
?>

<h3><?php _e('Mi perfil', 'tutor'); ?></h3>
<div class="tutor-dashboard-content-inner">
    <div class="tutor-dashboard-profile">
        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Fecha re registro', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo esc_html($rdate) ?>&nbsp;</p>
            </div>
        </div>
        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Nombre', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo $fname ? $fname : esc_html('________'); ?>&nbsp;</p>
            </div>
        </div>
        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Apellido', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo $lname ? $lname : __('________'); ?>&nbsp;</p>
            </div>
        </div>
        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Nombre de usuario', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo $uname; ?>&nbsp;</p>
            </div>
        </div>
        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Email', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo $email; ?>&nbsp;</p>
            </div>
        </div>
        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Número', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo $phone ? $phone : "________"; ?>&nbsp;</p>
            </div>
        </div>

        <div class="tutor-dashboard-profile-item">
            <div class="heading">
                <span><?php _e('Bio', 'tutor'); ?></span>
            </div>
            <div class="content">
                <p><?php echo $bio ? $bio : '________'; ?>&nbsp;</p>
            </div>
        </div>


    </div>

</div>
