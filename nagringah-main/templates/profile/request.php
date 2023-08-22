<?php
//get url
$url_components = parse_url($_SERVER['REQUEST_URI']);
parse_str($url_components['query'], $params);
//request friend
$pmrequests = new PM_request;
$dbhandler = new PM_DBhandler;
$friendsfunctions = new PM_Friends_Functions;
$current_user = wp_get_current_user();
$user1 = $current_user->ID;
$user2 = $params['uid'];
$identifier = 'FRIENDS';
$exist_in_table = $friendsfunctions->profile_magic_is_exist_in_table($user1,$user2);
$u1 = $pmrequests->pm_encrypt_decrypt_pass('encrypt',$user1);
$u2 = $pmrequests->pm_encrypt_decrypt_pass('encrypt',$user2);
if(!$exist_in_table){
    if(isset($user2)){ ?> 
        <button class="request-friend"><span class="pm_add_friend_request" onclick="pm_add_friend_request('<?php echo esc_attr($u1);?>','<?php echo esc_attr($u2);?>',this)">Conectar</span></button>
    <?php }
}else{ 
    if($exist_in_table->status==1){ ?>
        <button class="request-friend"><span class="pm_add_friend_request">Solicitação enviada!</span></button>
    <?php }else if($exist_in_table->status==2){ ?>
        <button class="request-friend" disabled><span class="pm_add_friend_request">Amigos</span></button>
    <?php }
}
?>