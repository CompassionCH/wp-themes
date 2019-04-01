<?php

$child_id = get_the_id();
$country_id = get_post_meta($child_id, '_child_country', true);
$child_meta = get_child_meta($child_id);
$child_number = get_post_meta($child_id, '_child_number', true);
$child_reserved = get_post_meta($child_id, '_child_reserved', true) === 'true';
$my_current_lang = apply_filters('wpml_current_language', NULL);

$now = new DateTime();
$now = $now->format('Y-m-d');
$child_expiration = get_post_meta($child_id, '_child_reserved_expiration', true);
$child_expired = $now >= $child_expiration;

if ($child_expired) {
    echo _e('This child has expired', 'compassion');
    exit();
}

function get_buttons_infos()
{
    $base_link = get_the_permalink(get_theme_mod("pate-werden"));
    $child_id = get_the_id();

    return array(
        'lang' => apply_filters('wpml_current_language', NULL),
        'base_link' => $base_link,
        'child_id' => $child_id,
        'title' => get_the_title(),
        'link' => $base_link . '?childid=' . $child_id,
        'classes' => 'button button-large'
    );
}

function get_sponsor_buttons()
{
    $a = get_buttons_infos();
    $res = '<a href="' . $a['link'] . '" class="' . $a['classes'] . '">';
    /* translators: The placeholder references the child's name. */
    $res .= sprintf(__('Werden Sie %ss Pate', 'compassion'),$a['title']);
    $res .= '</a>';
    return $res;
}

function share_child_mail($lang, $post_data, $child_id, $child_image, $child_number)
{
    $odoo = new CompassionOdooConnector();
    $odoo->reserveChild($child_number);

    require_once ABSPATH . WPINC . '/class-phpmailer.php';
    require_once ABSPATH . WPINC . '/class-smtp.php';

    $email = new PHPMailer();
    $email->isSMTP();                                      // Set mailer to use SMTP
    $email->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
    $email->SMTPAuth = true;                               // Enable SMTP authentication
    $email->Username = 'apikey';                 // SMTP username
    $email->Password = SENDGRID_API_KEY; // SMTP password
    $email->Port = 587;
    $email->CharSet = 'UTF-8';
    $email->From = 'compassion@compassion.ch';
    $email->FromName = __('Compassion Schweiz', 'child-sponsor-lang');
    $email->Subject = $_POST['coordinates'] . __(' vous propose de parrainer ', 'compassion') . get_the_title() ;
    $email->Body = get_email_template($lang, $post_data, $child_id, $child_image);
    $email->isHTML(true);
    $email->AddAddress($_POST['friend_email']);
    $email->addCustomHeader('X-SMTPAPI', '{"filters": {"subscriptiontrack" : {"settings" : {"enable" : 0}}}}');
    $email->Send();
    exit();
}

function get_email_template($lang, $post_data, $child_id, $child_image)
{
    ob_start();
    include('recommend_child_emails/email_' . $lang . '/share_child.php');
    return ob_get_clean();
}

function get_page_title($recommend_title = false)
{
    $title = '<h2>';
    if ($recommend_title) {
        /* translators: The placeholder references the child's name. */
        $title .= sprintf(_x('%s einem Freund oder einer Freundin empfehlen', 'title', 'compassion'),get_the_title());
    } else {
        /* translators: The placeholder references the child's name. */
        $title .= sprintf(_x('Werden Sie %ss Pate', 'title', 'compassion'),get_the_title());
    }
    $title .= '</h2>';
    return $title;
}

if (isset($_POST['share_child'])) {
    share_child_mail($my_current_lang, $_POST, get_the_id(), get_the_post_thumbnail(), $child_number);
}

if (isset($_GET['recommend'])) { ?>
    <script>
        jQuery(function () {
            jQuery('#share_child_accordion').find('li').first().addClass('is-active');
        });
    </script>
<?php }

?>


<div class="section background-blue section_abgerissen_unten has_breadcrumb">

    <div class="row section_breadcrumb">
        <?php compassion_breadcrumb(false); ?>
    </div>

    <div class="row section_row contains-nav">

        <div class="large-10 large-centered column">

            <?php
            $next_post = get_next_post();
            $prev_post = get_previous_post();
            ?>

            <nav class="child-nav">
                <?php if ($prev_post) { ?>
                    <a href="<?php echo get_the_permalink($prev_post->ID); ?>" class="prev"></a>
                <?php } ?>
                <a href="<?php bloginfo('url'); ?>/kinderpatenschaften/finden-sie-ein-patenkind/" class="overview"></a>
                <?php if ($next_post) { ?>
                    <a href="<?php echo get_the_permalink($next_post->ID); ?>" class="next"></a>
                <?php } ?>
            </nav>
            <?= get_page_title(isset($_GET['recommend'])) ?>
        </div>

    </div>
</div>

<div class="section background-beige section_gradient_unten">

    <div class="row profile">
        <div class="large-4 column">

            <div class="image">
                <?php the_post_thumbnail(); ?>
            </div>
            <p><?= get_sponsor_buttons() ?></p>

            <?php if (!$child_reserved): ?>
                <script>
                    function get_regex(type) {
                        switch(type) {
                            case 'name':
                                return new RegExp("^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄ" +
                                    "ĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$", "u");
                            case 'mail':
                                return new RegExp(['^(([^<>()[\\]\\\.,;:\\s@\"]+(\\.[^<>()\\[\\]\\\.,;:\\s@\"]+)*)',
                                    '|(".+"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.',
                                    '[0-9]{1,3}\])|(([a-zA-Z\\-0-9]+\\.)+',
                                    '[a-zA-Z]{2,}))$'].join(''));
                            case 'text':
                                return new RegExp('.+'); // au moins un caractère
                        }
                    }

                    jQuery(function () {
                        // javascript pour mettre un accordion toggle sur le bouton de recommendation d'un ami
                        // attention : plante si d'autres accordions sont sur la même page !
                        jQuery('.button_recommend_friend').first().click(function (e) {
                            setTimeout(function () {
                                jQuery('.alert_recommendation_submitted').first().hide();
                            }, 500);
                            if (jQuery(this).parent().find('.accordion-content').first().css('display') === 'block') {
                                jQuery('.hidden-accordion').first().trigger('click');
                                e.preventDefault();
                                e.stopImmediatePropagation();
                            }
                        });

                        // javascript pour exécuter une requête AJAX demande à wordpress d'envoyer le mail
                        jQuery('.button_submit_recommend_friend').first().click(function () {
                            // vérification des champs côté client
                            var cant_submit = false;
                            var form = jQuery('#share_child_form');
                            form.find('input[name], textarea[name]').each(function () {
                                var must_be_verified = true;
                                console.log(jQuery(this).attr('name'));
                                switch (jQuery(this).attr('name')) {
                                    case 'coordinates':
                                    case 'friend_lastname':
                                        var r = get_regex('name');
                                        break;
                                    case 'friend_email':
                                        var r = get_regex('mail');
                                        break;
                                    case 'text_email':
                                        var r = get_regex('text');
                                        break;
                                    default:
                                        must_be_verified = false;
                                        break;
                                }
                                if (must_be_verified) {
                                    var verification = r.test(jQuery(this).val());
                                    cant_submit = cant_submit || !verification;
                                    jQuery(this).next().css('display', verification ? 'none' : 'block');
                                }
                            });
                            if (!cant_submit) {
                                jQuery.post("<?= get_post_permalink($child_id) ?>", form.serialize());
                                jQuery('.alert_recommendation_submitted').first().show();
                                jQuery('.hidden-accordion').first().trigger('click');
                                jQuery('.button_recommend_friend').hide();
                                form.get(0).reset();
                            }
                        });

                        // modification de la textarea en temps réel lorsqu'on modifie le prénom de l'ami
                        jQuery('input[name="friend_lastname"]').on('keyup', function() {
                            var text = jQuery('textarea[name="text_email"]').first();
                            var friend_lastname = jQuery(this).val();
                            var r = new RegExp("^<?=__('Hallo,', 'compassion')?>?.*\n");
                            if (friend_lastname == '') {
                                text.val(text.val().replace(r, '<?=__("Hallo,", "compassion")?>\n'));
                            } else {
                                text.val(text.val().replace(r, '<?=__("Hallo,", "compassion")?>'.replace(',', ' ') + friend_lastname + ',\n'));
                            }
                        });
                    });
                </script>
                <p>
                <ul class="accordion" id="share_child_accordion" data-accordion style="display: none;">
                    <li class="accordion-item" data-accordion-item>
                        <a href="#" class="button button-large button_recommend_friend">
                            <?php
                            switch ($my_current_lang) {
                                case 'fr':
                                    echo 'Recommander '.get_the_title().' à un ami'; break;
                                case 'de':
                                    echo get_the_title().' einem Freund oder einer Freundin empfehlen'; break;
                                case 'it':
                                    echo 'Consiglia '.get_the_title().' ad un amico'; break;
                            }
                            ?>
                        </a>
                        <div class="accordion-content" data-tab-content>
                            <form id="share_child_form">
                                <input name="share_child" type="hidden"/>
                                <label><?= __('Ihr Name und Nachname', 'compassion') ?></label>
                                <input name="coordinates" type="text"/>
                                <small class="error"><?= __('Das Feld ist erforderlich.', 'compassion') ?></small>
                                <!--<?= __('', 'compassion') ?>-->
                                <label><?= __('Name Ihrer Freundin/ Ihres Freundes', 'compassion') ?></label>
                                <input name="friend_lastname" type="text"/>
                                <small class="error"><?= __('Das Feld ist erforderlich.', 'compassion') ?></small>
                                <label><?= __('E-Mail-Adresse Ihrer Freundin/ Ihres Freundes', 'compassion') ?></label>
                                <input name="friend_email" type="text"/>
                                <small class="error"><?= __('Das Feld ist erforderlich.', 'compassion') ?></small>
                                <label><?= __('Mitteilung an Ihren Freund/ Ihre Freundin', 'compassion') ?></label>
                                <textarea name="text_email" rows="5"><?=
                                   __( 'Hallo,', 'compassion')." \n".__('Ich habe dieses Kind gefunden und denke, es könnte genau für dich sein!', 'compassion')
                                ?></textarea>
                                <small class="error"><?= __('Diese Nachricht ist leer.', 'compassion') ?></small>
                            </form>
                            <button class="button button-small button_submit_recommend_friend">
                                <?= __('Senden', 'compassion') ?>
                            </button>
                        </div>
                    </li>
                    <li class="accordion-item" data-accordion-item>
                        <a href="#" style="display: none;" class="accordion-title hidden-accordion"></a>
                        <div class="accordion-content" data-tab-content>
                            <div class="alert_recommendation_submitted">
                                <?= ($my_current_lang == 'de') ? (__('Ihre Nachricht wurde gesendet. Danke, dass Sie sich für ', 'compassion') .get_the_title().__(' einsetzen', 'compassion')):(__('Votre message a été envoyé. Merci pour l\'intérêt porté à ', 'compassion') .get_the_title()) ?>
                            </div>
                        </div>
                    </li>
                </ul>
            <?php endif ?>
        </div>

        <div class="large-8 column">
            <div class="meta">
                <span class="child-number"><?php echo $child_number; ?></span>
                <span class="waiting">
                <p><?php _e('Wartezeit in Tagen', 'compassion'); ?></p>
                <span class="child-waiting"><?php echo $child_meta['waiting_days']; ?></span>
            </span>
            </div>

            <h4 class="svg-divider"><?php the_title(); ?></h4>

            <p class="subtitle">
                <?php the_title();
                if ($my_current_lang == "fr") {
                    echo ($child_meta['gender'] == 'Fille' ? ' est née' : ' est né') . ' le ';
                } elseif ($my_current_lang == "it") {
                    echo ($child_meta['gender'] == 'Fille' ? ' è nata' : ' è nato') . ' il ';
                } else {
                    _e(' wurde am', 'compassion');
                };
                $birthday = $child_meta['birthday'];
                ?>
                <?= ($my_current_lang == 'de' ? date_i18n('j. F Y', $birthday) : date_i18n('j F Y', $birthday)) ?>
                <?= __('geboren und wohnt', 'compassion') . ' ' . get_post_meta($country_id, '_cmb_country_child_title', true) ?>.
            </p>

            <ul>
                <li>
                    <div class="single-icon icon-small">
                        <object type="image/svg+xml"
                                data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                 alt="No SVG support">
                        </object>
                    </div>
                    <span><strong><?php _e('Land', 'compassion'); ?>:</strong> <?= $child_meta['country'] ?></span>
                </li>
                <li>
                    <div class="single-icon icon-small">
                        <object type="image/svg+xml"
                                data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                 alt="No SVG support">
                        </object>
                    </div>
                    <span><strong><?php _e('Alter', 'compassion'); ?>:</strong> <?= $child_meta['age'] ?></span>
                </li>
                <li>
                    <div class="single-icon icon-small">
                        <object type="image/svg+xml"
                                data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                 alt="No SVG support">
                        </object>
                    </div>
                    <span><strong><?php _e('Geschlecht', 'compassion'); ?>:</strong> <?= $child_meta['gender'] ?></span>
                </li>
            </ul>

            <?php the_content(); ?>

        </div>
    </div>
</div>

<div class="slick-slider slick-carousel"
     data-slickSlides="1"
     data-slickScroll="1"
     data-slickArrows="true"
     data-slickDots="true">

    <div class="slide">
        <div class="slide-image"
             style="background-image: url(<?= get_post_meta($country_id, '_cmb_country_photo', true); ?>);">
        </div>
        <div class="slide-content-wrapper">
            <div class="slide-content">
            </div>
        </div>
    </div>

</div>

<div class="section background-beige section_gradient_oben section_gradient_unten">

    <div class="row about">
        <div class="large-6 column">
            <h4 class="text-uppercase"><?php _e('Das Kinderzentrum', 'compassion'); ?>
                <!-- <?php the_title(); ?>s <?php _e('Projekt', 'compassion'); ?> --></h4>
            <div class="content">
                <?php echo wpautop(get_post_meta($child_id, '_child_project', true)); ?>
            </div>
        </div>
        <div class="large-6 column">
            <h4 class="text-uppercase"><?php _e('Das Land', 'compassion'); ?>
                <!-- <?php the_title(); ?>s <?php _e('Land', 'compassion'); ?> --></h4>
            <?php echo wpautop(get_post_meta($country_id, '_cmb_country_info', true)); ?>
        </div>
    </div>
    <div class="text-center">
        <?= get_sponsor_buttons() ?>
    </div>
</div>

<div class="section section-map">
    <div id="child-map" data-icon="<?php echo get_bloginfo('template_directory') ?>/assets/img/marker.png"
         data-title="<?php echo get_the_title($country_id); ?>"
         data-lat="<?php echo get_post_meta($country_id, '_cmb_google_latitude', true); ?>"
         data-lng="<?php echo get_post_meta($country_id, '_cmb_google_longitude', true); ?>">
    </div>
</div>