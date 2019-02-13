<?php

/*
 * Template Name: test
 */

get_header();
?>

<div class="section background-white step-1 child-sponsor">
    <div class="row">

        <form method="POST" action="?step=2" class="large-8 large-centered medium-10 medium-centered column">


            <h4 class="text-uppercase"><?php _e('Meine persönlichen Daten', 'child-sponsor-lang'); ?></h4>
			
			 <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('Montant de votre don en CHF*', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <input type="text" required data-msg="<?php _e('Nachname erforderlich', 'child-sponsor-lang'); ?>" class="input-field" name="wert" value="<?php echo (isset($session_data['wert'])) ? $session_data['wert'] : ''; ?>">
                </div>
            </div>
            
             <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('Motif de votre don*', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <div class="select-wrapper">
                        <select name="country" class="input-field">
	                         <option value="Fonds d'urgence" <?php echo (isset($session_data['country']) && $session_data['country'] == "Fonds d'urgence") ? 'selected' : '' ?>><?php _e('Fonds urgence', 'child-sponsor-lang'); ?></option>
                            <option value="Fonds famine" <?php echo (isset($session_data['country']) && $session_data['country'] == "Fonds famine") ? 'selected' : '' ?>><?php _e('Fonds famine', 'child-sponsor-lang'); ?></option>
                            <option value="Fonds aide" <?php echo (isset($session_data['country']) && $session_data['country'] == "Fonds aide") ? 'selected' : '' ?>><?php _e('Fonds aide', 'child-sponsor-lang'); ?></option>
                        </select>
                    </div>
                </div>
            </div>


            
            <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('Nachname', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <input type="text" required data-msg="<?php _e('Nachname erforderlich', 'child-sponsor-lang'); ?>" class="input-field" name="last_name" value="<?php echo (isset($session_data['last_name'])) ? $session_data['last_name'] : ''; ?>">
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('Vorname', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <input type="text" required data-msg="<?php _e('Vorname erforderlich', 'child-sponsor-lang'); ?>" class="input-field" name="first_name" value="<?php echo (isset($session_data['first_name'])) ? $session_data['first_name'] : ''; ?>">
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('Strasse/Hausnr.', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <input type="text" required data-msg="<?php _e('Strasse erforderlich', 'child-sponsor-lang'); ?>" class="input-field" name="street" value="<?php echo (isset($session_data['street'])) ? $session_data['street'] : ''; ?>">
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('PLZ/Ort', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-2 columns">
                    <input type="text" required data-msg="<?php _e('PLZ erforderlich', 'child-sponsor-lang'); ?>" class="input-field" name="zipcode" value="<?php echo (isset($session_data['zipcode'])) ? $session_data['zipcode'] : ''; ?>">
                </div>
                <div class="small-6 columns no-padding-left">
                    <input type="text" required data-msg="<?php _e('Stadt erforderlich', 'child-sponsor-lang'); ?>" class="input-field" name="city" value="<?php echo (isset($session_data['city'])) ? $session_data['city'] : ''; ?>">
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('Land', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <div class="select-wrapper">
                        <select name="country" class="input-field">
	                         <option value="Schweiz" <?php echo (isset($session_data['country']) && $session_data['country'] == "Schweiz") ? 'selected' : '' ?>><?php _e('Schweiz', 'child-sponsor-lang'); ?></option>
                            <option value="Deutschland" <?php echo (isset($session_data['country']) && $session_data['country'] == "Deutschland") ? 'selected' : '' ?>><?php _e('Deutschland', 'child-sponsor-lang'); ?></option>
                            <option value="Österreich" <?php echo (isset($session_data['country']) && $session_data['country'] == "Österreich") ? 'selected' : '' ?>><?php _e('Österreich', 'child-sponsor-lang'); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="small-4 columns">
                    <label class="text-left middle"><?php _e('E-Mailadresse', 'child-sponsor-lang'); ?></label>
                </div>
                <div class="small-8 columns">
                    <input type="email" class="input-field" required data-msg="<?php _e('E-Mailadresse erforderlich', 'child-sponsor-lang'); ?>" name="email" value="<?php echo (isset($session_data['email'])) ? $session_data['email'] : ''; ?>">
                </div>
            </div>

            <hr>
            
                

            <hr>

<!--
            <div class="row">
                <div class="large-12 column recaptcha-wrapper">
                    <div class="g-recaptcha" data-sitekey="6Lf1_AcUAAAAADEdnn5_Rmu_LlHyrMPKKs0fVH3l"></div>
                    <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha" data-msg="<?php _e('Bitte zeigen Sie, dass Sie ein Mensch sind.', 'child-sponsor-lang'); ?>">
                </div>
            </div>
-->

            <div class="form-action">
<!--                 <a href="?step=" class="button button-beige button-small"><?php _e('Zurück', 'child-sponsor-lang'); ?></a> -->
                <input type="submit" class="button button-blue button-small" value="<?php _e('Weiter', 'child-sponsor-lang'); ?>"/>
            </div>

        </form>
    </div>

</div>
















<div class="section background-white">

    <div class="spendino-donation-wrapper">
    <form action='<?= POSTFINANCE_URL ?>orderstandard.asp' method='post' name="pf_for_contact_form">
                <input type="hidden" name="PSPID" value="<?php echo $form['PSPID']; ?>"> 
                <input type="hidden" name="ORDERID" value="<?php echo $form['ORDERID']; ?>">
                <input type="hidden" name="AMOUNT" value="<?php echo $form['AMOUNT']; ?>">
                <input type="hidden" name="CURRENCY" value="<?php echo $form['CURRENCY']; ?>">
                <input type="hidden" name="LANGUAGE" value="<?php echo $form['LANGUAGE']; ?>">
                <input type="hidden" name="CN" value="<?php echo $form['CN']; ?>">
                <input name="EMAIL" value="<?php echo $form['EMAIL']; ?>">
                <input type="hidden" name="ACCEPTURL" value="<?php echo $form['ACCEPTURL']; ?>">
                <input type="hidden" name="DECLINEURL" value="<?php echo $form['DECLINEURL']; ?>">
                <input type="hidden" name="EXCEPTIONURL" value="<?php echo $form['EXCEPTIONURL']; ?>">
                <input type="hidden" name="CANCELURL" value="<?php echo $form['CANCELURL']; ?>">
                <input type="hidden" name="SHASIGN" value="<?php echo $hashedString; ?>">
            </form>
 </div>

</div>


          	 
<?php get_footer(); ?>
