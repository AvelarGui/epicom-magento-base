<?php
    use Magento\Framework\App\Bootstrap;
    require '../app/bootstrap.php';
    $params = $_SERVER;
    $bootstrap = Bootstrap::create(BP, $params);
    $obj = $bootstrap->getObjectManager();
    
    
    //$scope = $obj->get('\Magento\Framework\App\Config\ScopeConfigInterface');
	
	// $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;


	// echo $scope->getValue('admincolors/general/colorPrimary', 'stores');

	$scope = $obj->get('\Magento\Framework\App\State\CleanupFiles');
    $scope->clearMaterializedViewFiles();
    //$this->_eventManager->dispatch('clean_static_files_cache_after');