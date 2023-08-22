<div class="list-button">
    <?php if(is_user_logged_in()) {
        $user = wp_get_current_user();
        ?>
        <div class="envolve" style="position: relative;">
            <button class="button-logged">
                <div class="text">
                    Olá, <?=$user->display_name;?>
                </div>
                <div class="image">
                    <?php echo get_avatar(get_current_user_id(), 30); ?>
                </div>
            </button>
            <div class="menu-list">
                <ul>
                    <li><a href="<?=get_home_url();?>/meu-perfil/"><img src="<?=get_template_directory_uri().'/dist/img/icons/perfil.svg'?>" alt=""> Meu perfil</a></li>
                    <li><a href="<?=get_home_url();?>/editar-conta/"><img src="<?=get_template_directory_uri().'/dist/img/icons/edit.svg'?>" alt=""> Editar conta</a></li>
                    <li><a href="<?=get_home_url();?>/editar-endereco/"><img src="<?=get_template_directory_uri().'/dist/img/icons/location.svg'?>" alt=""> Editar endereço</a></li>
                    <li><a href="<?=get_home_url();?>/editar-pagamento/"><img src="<?=get_template_directory_uri().'/dist/img/icons/carteira.svg'?>" alt=""> Minha carteira</a></li>
                    <li><a href="<?php echo wp_logout_url( home_url() ); ?>"><img src="<?=get_template_directory_uri().'/dist/img/icons/logout.svg'?>" alt=""> Logout</a></li>
                </ul>
            </div>
        </div>
        <?php
    }else{ ?>
        <a href="<?=get_home_url();?>/minha-conta/">
            <button class="openeble default button-login">
                <div class="image">
                    <img src="<?=get_template_directory_uri().'/dist/img/icons/perfilb.svg'?>" alt="">
                </div>
                <div class="text">
                    Login
                </div>
            </button>
        </a>
    <?php } ?>
    <?php if(is_user_logged_in()) { ?>
        <a href="<?=get_home_url();?>/notificacoes/">
            <button class="default button-notificacoes">
                <div class="image">
                    <img src="<?=get_template_directory_uri().'/dist/img/icons/notification.svg'?>" alt="">
                </div>
                <div class="number"><?php echo do_shortcode('[profilegrid_unread_notifications]'); ?></div>
            </button>
        </a>
    <?php } ?>
    <a href="<?=get_home_url();?>/listas-de-desejo/">
        <button class="default button-login wishlist">
            <div class="image">
                <img src="<?=get_template_directory_uri().'/dist/img/icons/ldesejos.png'?>" alt="">
            </div>
        </button>
    </a>
    <button class="default button-login cpops-toggle-drawer">
        <div class="image">
            <img src="<?=get_template_directory_uri().'/dist/img/icons/shopping-cart.svg'?>" alt="">
        </div>
    </button>
</div>