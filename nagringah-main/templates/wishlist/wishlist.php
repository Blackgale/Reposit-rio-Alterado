<?php
//get url
$url_components = parse_url($_SERVER['REQUEST_URI']);
parse_str($url_components['query'], $params);
//
$friendsfunctions = new PM_Friends_Functions;
$current_user = wp_get_current_user();
$user1 = $current_user->ID;
$user2 = $params['uid'];
$identifier = 'FRIENDS';
$exist_in_table = $friendsfunctions->profile_magic_is_exist_in_table($user1,$user2);
//get user current
if($params['uid']){
    $idUser = $params['uid'];
}else{
    $idUser = get_current_user_id();
}
$userData = get_user_by('ID', $idUser);
global $wpdb; 
$studentTable = $wpdb->prefix.'yith_wcwl_lists';
$productTable = $wpdb->prefix.'yith_wcwl';
$result = $wpdb->get_results("SELECT * FROM $studentTable WHERE user_id = $idUser AND wishlist_privacy = 0");
$resultComp = $wpdb->get_results("SELECT * FROM $studentTable WHERE user_id = $idUser AND wishlist_privacy = 1");
?>
<div class="d-flex header-interno">
    <div>
        <h5 style="color: #000; font-weight: 600; margin-bottom: 25px;">Lista de desejos de <?=$userData->display_name?></h5>
    </div>
</div>
<?php
if((!$result) and (!$resultComp)){ ?>
<p>Nenhuma lista encontrada!</p>
<?php }
?>
<ul class="shop_table cart wishlist_table wishlist_manage_table modern_grid responsive shadow" cellspacing="0" style="font-size: 16px; margin-bottom: 0; padding: 0;">
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
				<div class="item-details">
                    <div class="wishlist-name wishlist-title">
                        <h3>
                            <a class="wishlist-anchor" href="<?=$link?>"><?php echo esc_html( $item->wishlist_name ); ?></a>
                        </h3>
                    </div>
                    <table class="item-details-table">
                        <tr class="wishlist-item-count">
                            <td class="value">
                                <?=$num?> produto<?php if($num>1){ echo 's'; } ?>
                            </td>
                        </tr>
                        <tr class="wishlist-dateadded">
                            <td class="value"><?=date_format($date,"d/m/Y")?></td>
                        </tr>
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
    <?php if(($exist_in_table->status==2) or (empty($params['uid']))){ ?>
        <?php foreach($resultComp as $item): 
            $count_query = "SELECT COUNT(*) FROM $productTable WHERE wishlist_id = $item->ID";
            $num = $wpdb->get_var($count_query);
            $date=date_create($item->dateadded);
            //link wishlist
            if($idUser==get_current_user_id()){
                $link = home_url().'/listas-de-desejo/view/'.$item->wishlist_token;
            }else{
                $link = home_url().'/listas-de-desejo/view/'.$item->wishlist_token.'?uid='.$idUser;
            } ?>
            <li data-wishlist-id="<?php echo esc_attr( $item->ID ); ?>">
                <div class="item-wrapper">
                    <div class="item-details">
                        <div class="wishlist-name wishlist-title">
                            <h3>
                                <a class="wishlist-anchor" href="<?=$link?>"><?php echo esc_html( $item->wishlist_name ); ?></a>
                            </h3>
                        </div>
                        <table class="item-details-table">
                            <tr class="wishlist-item-count">
                                <td class="value">
                                    <?=$num?> produto<?php if($num>1){ echo 's'; } ?>
                                </td>
                            </tr>
                            <tr class="wishlist-dateadded">
                                <td class="value"><?=date_format($date,"d/m/Y")?></td>
                            </tr>
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
    <?php } ?>
</ul>