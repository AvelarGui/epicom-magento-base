<?php

	use Magento\Framework\App\Bootstrap;
	require '../app/bootstrap.php';
	$params = $_SERVER;
	$bootstrap = Bootstrap::create(BP, $params);
	$obj = $bootstrap->getObjectManager();

	$site_url = \Magento\Framework\App\ObjectManager::getInstance();
	$storeManager = $site_url->get('\Magento\Store\Model\StoreManagerInterface');
	$mediaurl= $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	$state = $obj->get('\Magento\Framework\App\State');
	$state->setAreaCode('frontend');
	
	// we Get Website ID
	$websiteId = $storeManager->getWebsite()->getWebsiteId();
	echo 'websiteId: '.$websiteId." ";

	// we Get Store ID 
	$mage_store = $storeManager->getStore();
	$store_Id = $mage_store->getStoreId();
	echo 'storeId: '.$store_Id." ";

	// we Get Root Category ID
	$root_node_id = $mage_store->getRootCategoryId();
	echo 'rootNodeId: '.$root_node_id." ";
	
	// we Get Root Category
	$root_cat_id = $obj->get('Magento\Catalog\Model\Category');
	$cat_info = $root_cat_id->load($root_node_id);

	$categorys_data = array(
		'Novidades',
		'Promoções',
		'Categoria 1',
		'Categoria 2',
		'Categoria 3',
		'Categoria 4',
		'Categoria 5',
		'Categoria 6',
		'Categoria 7',
		'Saldão'
	); // we Category Names

	foreach($categorys_data as $cat_val){
		// catagory name
		$cat_name = ucfirst($cat_val);
		$site_url = strtolower($cat_val);
		$clean_url = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($site_url))))));
		$category_factory=$obj->get('\Magento\Catalog\Model\CategoryFactory');
		// Add a new sub category under root category
		$category_obj = $category_factory->create();
		$category_obj->setName($cat_name);
		$category_obj->setIsActive(true);
		$category_obj->setUrlKey($clean_url);

		$category_obj->setData('description', 'description');
		$category_obj->setParentId($root_cat_id->getId());
		$mediaAttribute = array ('image', 'small_image', 'thumbnail');
		$category_obj->setImage('category.jpg', $mediaAttribute, true, false);
		// add image at Path of  pub/meida/catalog/category/catagory_img.png
		// add store id 
		$category_obj->setStoreId($store_Id);
		$category_obj->setPath($root_cat_id->getPath());
		// save category
		$category_obj->save();
	}

?>