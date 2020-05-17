<?php

	use Magento\Framework\App\Bootstrap;
	require '../app/bootstrap.php';	  
	$params = $_SERVER;
	$bootstrap = Bootstrap::create(BP, $params);
	$obj = $bootstrap->getObjectManager();
	   
	$state = $obj->get('Magento\Framework\App\State');
	$state->setAreaCode('frontend');
	 
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager

	// Get categories ids
	$_categoryFactory = $obj->get('Magento\Catalog\Model\CategoryFactory');
	$categoriesIds = [];
	$categories = $_categoryFactory->create()->getCollection();
	foreach ($categories as $key => $value) {
		if($value->getId() != 1){
			$categoriesIds[$key] = $value->getId();
		}
	}

	// Insert products
	$products = include('products.php');
 
	foreach ($products as $key => $_product) {
	
		$product = $objectManager->create('\Magento\Catalog\Model\Product');
		$product->setName($_product['name']); // name of Product
		$product->setSku($_product['sku']); // sku of product (It must be unique)
		$product->setAttributeSetId(4); // attribute set id
		$product->setStatus(1); // status of product (1 => enabled / 0 => disabled)
		$product->setWeight(1); // weight of product
		$product->setVisibility(4); // visibilty of product (1 => Not visible individually / 2 => catalog / 3 => search / 4 => catalog, search)
		$product->setTaxClassId(0); // tax class id
		$product->setTypeId('simple'); // type of product (simple / virtual / downloadable / configurable)
		$product->setPrice($_product['price']); // price of product
		if($_product['specialPrice']){ $product->setSpecialPrice($_product['specialPrice']); }
		$product->setWebsiteIds(array(1));
		$product->setDesciption($_product['description']);
		$product->setShortDescription($_product['shortDescription']);
		$product->setStockData(
		    [
		        'use_config_manage_stock' => 0,
		        'manage_stock' => 1,
		        'is_in_stock' => 1,
		        'qty' => 1000
		    ]
		);
		$product->save();

		// Add image in product
		$filesystem = $objectManager->create('\Magento\Framework\Filesystem');
		$mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		$mediaPath = $mediaDirectory->getAbsolutePath();
		$imagePath = $mediaPath .'import/sample.jpg'; // path of the image
		$product->addImageToMediaGallery($imagePath, array('image', 'small_image', 'thumbnail'), false, false);
		$product->save();

		//Add categories in product
		$categoryLinkRepository = $objectManager->create('\Magento\Catalog\Api\CategoryLinkManagementInterface');
		$categoryLinkRepository->assignProductToCategories($product->getSku(),$categoriesIds);

	}


?>