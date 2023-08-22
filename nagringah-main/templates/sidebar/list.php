<?php
$url_components = parse_url($_SERVER['REQUEST_URI']);
parse_str($url_components['path'], $params);
parse_str($url_components['query'], $visitor);
$uid = $visitor['uid'];
//
$friendsfunctions = new PM_Friends_Functions;
$current_user = wp_get_current_user();
$user1 = $current_user->ID;
$user2 = $visitor['uid'];
$identifier = 'FRIENDS';
$exist_in_table = $friendsfunctions->profile_magic_is_exist_in_table($user1,$user2);
?>
<div class="menu-sidebar">
    <div class="item et_pb_module et_pb_blurb et_pb_blurb_4 et_clickable et_pb_text_align_left et_pb_blurb_position_left et_pb_bg_layout_light <?php if($params=="meu-perfil"){ echo "active-aa"; } ?>">
        <div class="et_pb_blurb_content">
            <a href="<?=home_url();?>/meu-perfil/<?php if($uid){ echo '?uid='.$uid; } ?>">
                <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="64" height="58" src="<?=get_template_directory_uri()?>/dist/img/icons/perfilb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-714 et-animated"></span></div>
                    <div class="et_pb_blurb_container">
                    <h4 class="et_pb_module_header"><span>Perfil</span></h4>
                </div>
            </a>
        </div>
    </div>
    <?php if(!$visitor['uid']){ ?>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_5 notification et_clickable  et_pb_text_align_left  et_pb_blurb_position_left et_pb_bg_layout_light <?php if($params=="notificacoes"){ echo "active-aa"; } ?>">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/minha-conta">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="64" height="58" src="<?=get_template_directory_uri()?>/dist/img/icons/dashboardb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-714 et-animated"></span></div>
                    <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Minha conta</span></h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_5 notification et_clickable  et_pb_text_align_left  et_pb_blurb_position_left et_pb_bg_layout_light <?php if($params=="notificacoes"){ echo "active-aa"; } ?>">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/notificacoes">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="64" height="58" src="<?=get_template_directory_uri()?>/dist/img/icons/notificationb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-714 et-animated"></span></div>
                    <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Notificações</span></h4>
                        <div class="et_pb_blurb_description"><?php echo do_shortcode('[profilegrid_unread_notifications]'); ?></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_5 notification et_clickable  et_pb_text_align_left  et_pb_blurb_position_left et_pb_bg_layout_light">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/meus-pedidos/">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="64" height="58" src="<?=get_template_directory_uri()?>/dist/img/icons/pedidosb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-714 et-animated"></span></div>
                    <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Meus pedidos</span></h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_5 notification et_clickable  et_pb_text_align_left  et_pb_blurb_position_left et_pb_bg_layout_light">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/refer">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="64" height="58" src="<?=get_template_directory_uri()?>/dist/img/icons/referb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-714 et-animated"></span></div>
                    <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Indicar amigos</span></h4>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
    <?php if(($exist_in_table->status==2) or (empty($uid))){ ?>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_8 et_clickable et_pb_text_align_left et_pb_blurb_position_left et_pb_bg_layout_light ">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/avaliacoes/<?php if($uid){ echo '?uid='.$uid; } ?>">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="256" height="256" src="<?=get_template_directory_uri()?>/dist/img/icons/avaliacoesb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-124 et-animated"></span></div>
                        <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Avaliações</span></h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_12 et_clickable et_pb_text_align_left et_pb_blurb_position_left et_pb_bg_layout_light">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/lista-de-amigos/<?php if($uid){ echo '?uid='.$uid; } ?>">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="67" height="67" src="<?=get_template_directory_uri()?>/dist/img/icons/amigosb.svg" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-719 et-animated"></span></div>
                        <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Lista de amigos</span></h4>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
    <?php if($uid){ ?>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_13 et_clickable et_pb_text_align_left et_pb_blurb_position_left et_pb_bg_layout_light">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/listas-de-desejov/<?php if($uid){ echo '?uid='.$uid; } ?>">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="62" height="62" src="<?=home_url();?>/wp-content/uploads/2022/05/ldesejos.png" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-716 et-animated"></span></div>
                        <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Lista de Desejo</span></h4>
                    </div>
                </a>
            </div>
        </div>
    <?php }else{ ?>
        <div class="item et_pb_module et_pb_blurb et_pb_blurb_13 et_clickable et_pb_text_align_left et_pb_blurb_position_left et_pb_bg_layout_light">
            <div class="et_pb_blurb_content">
                <a href="<?=home_url();?>/listas-de-desejo/manage/">
                    <div class="et_pb_main_blurb_image"><span class="et_pb_image_wrap et_pb_only_image_mode_wrap"><img width="62" height="62" src="<?=home_url();?>/wp-content/uploads/2022/05/ldesejos.png" alt="" class="et-waypoint et_pb_animation_off et_pb_animation_off_tablet et_pb_animation_off_phone wp-image-716 et-animated"></span></div>
                        <div class="et_pb_blurb_container">
                        <h4 class="et_pb_module_header"><span>Lista de Desejo</span></h4>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
    <?php if($exist_in_table->status==0){ ?>
        
    <?php } ?>
</div>