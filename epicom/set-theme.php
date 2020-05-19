<?php

    use Magento\Framework\App\Bootstrap;
    require '../app/bootstrap.php';   
    $params = $_SERVER;
    $bootstrap = Bootstrap::create(BP, $params);
    $obj = $bootstrap->getObjectManager();

    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    
	//  get theme id
	$resourceConnection = $obj->get('Magento\Framework\App\ResourceConnection');
	$query = "SELECT * FROM theme WHERE theme_title='Epicom Base'";
	$results = $resourceConnection->getConnection()->fetchAll($query);
	$themeId = $results[0]['theme_id'];
	echo $themeId;

	
	// Set theme id
    $configInterface = $obj->get("Magento\Framework\App\Config\ConfigResource\ConfigInterface"); 
    $configInterface->saveConfig('design/theme/theme_id', $themeId, 'stores', 1);

?>