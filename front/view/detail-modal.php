<?php
# Silence is golden.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once MENUKAART_PATH . 'front/' . MENUKAART_CLS_PRFX . 'front.php';
$mk_front = new Menukaart_Front(MENUKAART_VERSION);

$menukaartGeneralSettings = $mk_front->menukaart_get_general_settings();
foreach ( $menukaartGeneralSettings as $option_name => $option_value ) {
    if ( isset( $menukaartGeneralSettings[$option_name] ) ) {
        ${"" . $option_name}  = $option_value;
    }
}

$menukaartStylesSettings = $mk_front->menukaart_get_styles_settings();
foreach ( $menukaartStylesSettings as $option_name => $option_value ) {
    if ( isset( $menukaartStylesSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$mk_currency = $mk_front->menukaart_get_currency_symbol( $mk_currency );

$post       = get_post( $post_id );
$mk_price	= get_post_meta( $post->ID, 'mk_price', true );
$mk_wc_prod	= get_post_meta( $post->ID, 'mk_wc_prod', true );
$mk_category = wp_get_post_terms( $post->ID, 'menukaart_courses', array('fields' => 'all') );

if ( ! $mk_disable_price_number_format ) {
    $mk_price = number_format( ( esc_html( $mk_price ) / 100 ), 2, ",", "" );
}

$mk_img 	= MENUKAART_ASSETS . 'img/no-image.jpg';

if ( has_post_thumbnail( $post_id ) ) {
    $mk_img = get_the_post_thumbnail_url($post_id,'full');
}
?>
<div class="mk-detail-modal-wrapper">
    <div class="mk-detail-top-left-right-wrapper">
        <div class="mk-detail-top-left">
            <img src="<?php echo esc_url( $mk_img ); ?>" alt="<?php _e( 'No Image Available', 'menukaart' ); ?>">
        </div>
        <div class="mk-detail-top-right">
            <h2><?php echo $post->post_title; ?></h2>
            <div class="mk-detail-price"><?php echo esc_html( $mk_currency ) . '' . $mk_price; ?></div>
            <div class="mk-detail-desc">
                <?php
                $menu_desc = strip_tags( $post->post_content );
                if ( strlen( $menu_desc ) > 150 ) {
                    echo substr( $menu_desc, 0, 250 ) . ' ...';
                } else {
                    echo $menu_desc;
                }
                ?>
            </div>
            <div class="mk-detail-cat">
                <span class="mk-detail-left">Category:</span>
                <span class="mk-detail-right">
                    <?php
                    $mk_cat_arr = array();
                    foreach( $mk_category as $cat) {
                        $mk_cat_arr[] = "<a href='" . esc_url( home_url( '?mk_title&mk_category_s=' . urlencode( $cat->name )  ) ) . "' class='mk-detail-link'>" . $cat->name . "</a>";
                    }
                    echo implode( ', ', $mk_cat_arr );
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>