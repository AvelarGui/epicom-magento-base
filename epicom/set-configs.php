<?php
    use Magento\Framework\App\Bootstrap;
    require '../app/bootstrap.php';
    $params = $_SERVER;
    $bootstrap = Bootstrap::create(BP, $params);
    $obj = $bootstrap->getObjectManager();
    
    
    $admin = $obj->get('\Magento\Framework\App\Config\ConfigResource\ConfigInterface');
	

    /* ========== Geral ========= */

    // Opções de países
	$admin->saveConfig('general/country/default', 'BR', 'default', 0);
	$admin->saveConfig('general/country/optional_zip_countries', 'BR', 'default', 0);
	$admin->saveConfig('general/country/destinations', 'BR', 'default', 0);

	// Opções de localidade
	$admin->saveConfig('general/locale/weight_unit',  'kgs', 'default', 0);

	// Informação da loja
    $admin->saveConfig('general/store_information/name',  getenv('STORE_NAME'), 'default', 0);
    $admin->saveConfig('general/store_information/phone',  getenv('PHONE'), 'default', 0);
    $admin->saveConfig('general/store_information/merchant_vat_number', getenv('DOC'), 'default', 0);
    $admin->saveConfig('general/store_information/country_id',  'BR', 'default', 0);
    $admin->saveConfig('general/store_information/postcode',  getenv('ZIPCODE'), 'default', 0);
    $admin->saveConfig('general/store_information/street_line1', getenv('STREET'), 'default', 0);
    $admin->saveConfig('general/store_information/street_line2',  getenv('NUMBER'), 'default', 0);
    $admin->saveConfig('general/store_information/city',  getenv('CITY'), 'default', 0);
    $admin->saveConfig('general/store_information/region_id',  getEnv('REGIONID'), 'default', 0);

    // Taxa
    $admin->saveConfig('tax/defaults/country', 'BR', 'default', 0);

    // Detalhes do envio
    $admin->saveConfig('shipping/origin/country_id', 'BR', 'default', 0);
	$admin->saveConfig('shipping/origin/region_id', 508, 'default', 0);
	$admin->saveConfig('shipping/origin/postcode', getenv('ZIPCODE'), 'default', 0);
	$admin->saveConfig('shipping/origin/city', getenv('CITY'), 'default', 0);


    /* ===== Métodos de envio ===== */

    // --> Taxa Fixa
    $admin->saveConfig('carriers/flatrate/active', 1, 'default', 0);
    $admin->saveConfig('carriers/flatrate/title', "Retire na Loja", 'default', 0);
    $admin->saveConfig('carriers/flatrate/name', "Grátis", 'default', 0);
    $admin->saveConfig('carriers/flatrate/price', 0, 'default', 0);
    
    // --> Correios
    //$admin->saveConfig('carriers/imaginationmedia_correios/active',  1, 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/name',  'Correios', 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/posting_methods',  '40010,41106', 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/weight_type',  'kg', 'default', 0);
    
    $admin->saveConfig('carriers/imaginationmedia_correios/validate_dimensions', 1, 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/default_height',  2, 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/default_width',  16, 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/default_depth',  11, 'default', 0);
    $admin->saveConfig('carriers/imaginationmedia_correios/show_deliverydays',  11, 'default', 0);

    $admin->saveConfig('carriers/imaginationmedia_correios/max_weight',  30.0000, 'default', 0);

    $admin->saveConfig('carriers/imaginationmedia_correios/function_mode',  2, 'default', 0);


    // --> Customer
    $admin->saveConfig('customer/account_share/scope', 0, 'default', 0);
    // --> Endereço
    $admin->saveConfig('customer/address/street_lines', 4, 'default', 0);
    $admin->saveConfig('customer/address/company_show', 0, 'default', 0);

    /* ===== Formas de Pagamento ====== */
    
    $admin->saveConfig('payment/account/merchant_country', 'BR', 'default', 0);

    $admin->saveConfig('payment/moipboleto/active', 0, 'default', 0);
    $admin->saveConfig('payment/moipcc/active', 0, 'default', 0);

    $admin->saveConfig('payment/checkmo/active', 0, 'default', 0);

    $admin->saveConfig('payment/rm_pagseguro_cc/active', 0, 'default', 0);
    $admin->saveConfig('payment/rm_pagseguro_pagar_no_pagseguro/active', 0, 'default', 0);
    $admin->saveConfig('payment/rm_pagseguro_tef/active', 0, 'default', 0);
    $admin->saveConfig('payment/rm_pagseguro_boleto/active', 0, 'default', 0);

    $admin->saveConfig('payment/pagarme_boleto/active', 0, 'default', 0);

    $admin->saveConfig('payment/banktransfer/active', 1, 'default', 0);
    $admin->saveConfig('payment/banktransfer/title', 'Transferência Bancária', 'default', 0);
    $admin->saveConfig('payment/banktransfer/instructions', 'Banco Bradesco
AG: 9999-1
CC: 999-1
CNPJ: 99.999.999/0001-99

*Após a finalização do pedido, efetue o Depósito ou Transferência. Seu pedido será Despachado após confirmação do pagamento. Dúvidas 11 9999-9999.', 'default', 0);

    $admin->saveConfig('payment/mercadopago_custom/active', 0, 'default', 0);
    $admin->saveConfig('payment/mercadopago_basic/active', 0, 'default', 0);





?>