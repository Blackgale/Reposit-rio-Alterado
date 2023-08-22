<?php
//get url
$url_components = parse_url($_SERVER['REQUEST_URI']);
parse_str($url_components['query'], $params);
//get user current
if($params['uid']){
    $idUser = $params['uid'];
}else{
    $idUser = get_current_user_id();
}
$userData = get_user_by('ID', $idUser);
global $wpdb; 
$studentTable = $wpdb->prefix.'yith_wcwl_lists';
$result = $wpdb->get_results("SELECT * FROM $studentTable WHERE (wishlist_privacy = 0) AND user_id = $idUser LIMIT 2");
//
$metauser = get_user_meta($idUser, 'afreg_additional_1198', true);
$dataAn = explode("-", $metauser);
//
$friendsfunctions = new PM_Friends_Functions;
$current_user = wp_get_current_user();
$user1 = $current_user->ID;
$user2 = $params['uid'];
$identifier = 'FRIENDS';
$exist_in_table = $friendsfunctions->profile_magic_is_exist_in_table($user1,$user2);
?>
<div class="d-flex header-profile">
    <div class="about">
        <h3>Sobre</h3>
        <div class="shadow">
            <div>
                <h4>Nome: <strong><?=$userData->display_name;?></strong></h4>
            </div>
            <div>
                <h4>Email: <strong><?=$userData->user_email;?></strong></h4>
            </div>
            <div>
                <h4>Aniversário: <strong><?php echo $dataAn[1] . "/" . $dataAn[2] . "/" . $dataAn[0]; ?></strong></h4>
            </div>
        </div>
    </div>
    <?php if(($exist_in_table->status==2) or (empty($params['uid']))){ ?>
        <?php if($result){ ?>
            <div class="wishlist">
                <h3>Listas compartilhadas</h3>
                <div class="shadow">
                    <ul class="shop_table cart wishlist_table wishlist_manage_table modern_grid responsive" cellspacing="0" style="font-size: 16px; margin-bottom: 0; padding: 0;">
                        <?php foreach($result as $item): 
                            $count_query = "SELECT COUNT(*) FROM $productTable WHERE wishlist_id = $item->ID";
                            $num = $wpdb->get_var($count_query);
                            $date=date_create($item->dateadded);
                            //link wishlist
                            if($idUser==get_current_user_id()){
                                $link = home_url().'/listas-de-desejo/view/'.$item->wishlist_token;
                            }else{
                                $link = home_url().'/listas-de-desejo/view/'.$item->wishlist_token.'?uid='.$idUser;
                            }
                            ?>
                            <li data-wishlist-id="<?php echo esc_attr( $item->ID ); ?>">
                                <div class="item-wrapper">
                                    <div class="item-details" style="align-items: center;">
                                        <div class="wishlist-name wishlist-title">
                                            <h3>
                                                <a class="wishlist-anchor" href="<?=$link?>"><?php echo esc_html( $item->wishlist_name ); ?></a>
                                            </h3>
                                        </div>
                                        <table class="item-details-table">
                                            <tr>
                                                <td class="value" colspan="2">
                                                    <a class="wishlist-anchor" href="<?=$link?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/img/icons/view.svg" /></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<style>
    div#pm-show-cover-image::after{
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
    }
</style>