<?php

/*
 * Template Name: Don vers Odoo
 */

get_header();
?>

<?php

while (have_posts()): the_post();

    if ($_SERVER['HTTP_HOST'] == TEST_SERVER) {

//        $debug = false;
        $debug = true;
        if ($debug) {
            print_r($_GET);
        }
    } else {

        $debug = false;
    }
    
    $table_name = $wpdb->prefix . "donation_to_odoo";
    global $wpdb;

    if (isset($_GET['COMPLUS']) AND strlen($_GET['COMPLUS']) == 36) {

        error_log('Process to export to Odoo is running now... ');

        $complus = filter_var($_GET['COMPLUS'], FILTER_SANITIZE_STRING);


        $time_transaction = $wpdb->get_var(
                $wpdb->prepare(
                        "SELECT time FROM " . $table_name . " "
                        . "WHERE transaction_id='%s' "
                        . "AND odoo_status = 'submit_to_pf' "
                        . "LIMIT 1", $complus));

        // return from Postfinance should occur within 5 minutes, otherwise we ignore the db update. 
        if ($debug) {
            $additional_time = 1500000;
        } else {
            $additional_time = 72000;
        }
        if (time() < (strtotime($time_transaction) + $additional_time )) {

            if ($debug) {
                echo 'continue donation process...';
            }
            error_log('Update transaction with parameters received from Postfinance');

            $wpdb->update($table_name, array(
                'pf_pm' => $_GET['PM'],
                'pf_payid' => $_GET['PAYID'],
                'pf_brand' => $_GET['BRAND'],
                'pf_raw' => json_encode($_GET),
                'ip_address' => $_GET['IP'],
                'odoo_status' => 'received_from_pf'
                    ), array('transaction_id' => $complus,
                'odoo_complete_time' => NULL)
            );

            unset($_SESSION['transaction']);

//        } else {
//            wp_die('Request timeout. ');
        }
    }

            
    if(isset($_GET) OR isset($_POST)) {

        error_log('Looking for payments to export...');

        $results = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE odoo_status = 'received_from_pf' ");

        if ($debug) {
            print_r($results);
        }

        try {
            if (sizeof($results) >= 1) {

                $odoo = new CompassionOdooConnector($debug);

                foreach ($results as $result) {

                    unset($search_partner);
                    unset($partner);
                    $partner_id = '';

                    try {

                        if ($result->email != '' AND strlen(trim($result->email))>=5 AND $result->child_id != '' AND strlen($result->child_id)>=8) {

                            $search = $odoo->searchContractByPartnerEmailChildCode($result->email, $result->child_id);
                            $partner_id = $search[0]['partner_id'][0];
                        }

                        if (empty($partner_id)) {
                            error_log('Partner ID not found with email and child_id');
                            throw new Exception('foo');
                        }

                    } catch (Exception $e) {

                        if ($result->last_name != '' AND strlen(trim($result->last_name))>=3 AND $result->child_id != '' AND strlen($result->child_id)>=8) {

                            $search = $odoo->searchContractByPartnerLastNameChildCode($result->last_name, $result->child_id);
                            if (!empty($search)) {
                                $partner_id = $search[0]['partner_id'][0];

                                if($debug) {
                                    echo ' ###'.$partner_id.'### ';
                                }
                            }
                        }

                        if(empty($partner_id)) {

                            error_log('Searching partner with email, last_name, first_name, ...');
                            $search = $odoo->searchPartnerByEmailNameCity($result->email, $result->last_name, $result->first_name, $result->city);
                            if($debug) {
                                print_r($search);
                            }
                            if (!empty($search)) {
                                $partner_id = $search[0];
                                if($debug) {
                                    echo ' ##'.$partner_id.'## ';
                                }
                            }
                        }

                        if(empty($partner_id)) {

                            error_log('Let\'s create a partner');
                            $partner_id = $odoo->createPartner(
                                    $result->last_name, $result->first_name, $result->street, $result->zipcode, $result->city, $result->email, $result->country, $result->language);
                        }
                    }

                    if (!empty($partner_id)) {

//                            $invoice_id = $odoo->createInvoiceWithObjects(
//                                    $partner_id, date('Y-m-d H:i:s'), 'survie', '12.34', 'CHF', 'fund', $child_code, 'CreditCard', '1234567890', 'Mastercard');

                        $invoice_id = $odoo->createInvoiceWithObjects(
                                $partner_id, $result->orderid, $result->amount, $result->fund, $result->child_id,
                                $result->pf_pm, $result->pf_payid, $result->pf_brand, $result->utm_source,
                                $result->utm_medium, $result->utm_campaign);

                        if($debug) {
                            print_r($invoice_id);
                        }
                        if (!empty($invoice_id)) {

                            $wpdb->update($table_name, array(
                                'odoo_status' => 'invoiced',
                                'odoo_invoice_id' => $invoice_id,
                                'odoo_complete_time' => date('Y-m-d H:i:s'),
                                    ), array('transaction_id' => $result->transaction_id)
                            );
                        }
                    }                        
                }
            }
        } catch (Exception $ex) {

            echo 'Error occured. Please try again. ';
            if ($debug) {
                print_r($ex);
            }
        }
        
    }
    ?>

    <?php the_content(); ?>

<?php endwhile; ?>




<?php get_footer(); ?>
