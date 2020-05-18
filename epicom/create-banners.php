<?php

	use Magento\Framework\App\Bootstrap;
	require '../app/bootstrap.php';	  
	$params = $_SERVER;
	$bootstrap = Bootstrap::create(BP, $params);
	$obj = $bootstrap->getObjectManager();
	   
	$state = $obj->get('Magento\Framework\App\State');
	$state->setAreaCode('frontend');
	 
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager

	$resourceConnection = $obj->get('Magento\Framework\App\ResourceConnection');
	
	//  Show Sliders
	// $query = 'SELECT * FROM mageplaza_bannerslider_slider';
	// $results = $resourceConnection->getConnection()->fetchAll($query);
	// echo "<pre>";print_r($results);

	// Delete Sliders
	// $sql = "DELETE FROM mageplaza_bannerslider_slider WHERE slider_id=6";
	// $resourceConnection->getConnection()->query($sql);

	// Create Sliders
	$date = date("Y-m-d H:i:s");
	
	$principal = [
		'name' => 'Banner Principal',
		'status' => '1',
		'location' => 'cms_index_index.content-top',
		'store_ids' => '0',
		'customer_group_ids' => '0,1,2,3',
		'priority' => 0,
		'effect' => 'slider',
		'design' => 0,
		'autoplayTimeout' => 5000,
		'from_date' => '2020-01-01',
		'created_at' => $date,
        'updated_at' => $date
	];

	$support1 = [
		'name' => 'Banners de apoio 1',
		'status' => '1',
		'store_ids' => '0',
		'customer_group_ids' => '0,1,2,3',
		'priority' => 0,
		'effect' => 'slider',
		'design' => 0,
		'autoplayTimeout' => 5000,
		'from_date' => '2020-01-01',
		'created_at' => $date,
        'updated_at' => $date
	];

	$support2 = [
		'name' => 'Banners de apoio 2',
		'status' => '1',
		'store_ids' => '0',
		'customer_group_ids' => '0,1,2,3',
		'priority' => 0,
		'effect' => 'slider',
		'design' => 0,
		'autoplayTimeout' => 5000,
		'from_date' => '2020-01-01',
		'created_at' => $date,
        'updated_at' => $date
	];
		
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_slider', $principal);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_slider', $support1);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_slider', $support2);


	// Showw Banners
	// $query = 'SELECT * FROM mageplaza_bannerslider_banner';
	// $results = $resourceConnection->getConnection()->fetchAll($query);
	// echo "<pre>";print_r($results);

	// Create Banners
	$bannerHome1 = [
        'name' => 'Banner Home 1',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/principal/banner1.jpg',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];

    $bannerHome2 = [
        'name' => 'Banner Home 2',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/principal/banner2.jpg',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];

    $bannerHome3 = [
        'name' => 'Banner Home 3',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/principal/banner3.gif',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];

    $bannerHome4 = [
        'name' => 'Banner de apoio 1',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/support1/banner1.jpg',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];

    $bannerHome5 = [
        'name' => 'Banner de apoio 2',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/support1/banner2.jpg',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];

    $bannerHome6 = [
        'name' => 'Banner de apoio 3',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/support2/banner1.jpg',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];

    $bannerHome7 = [
        'name' => 'Banner de apoio 4',
        'status' => 1,
        'type' => 0,
        'content' => '',
        'image' => 'sample/support2/banner2.jpg',
        'url_banner' =>  '',
        'title' => '',
        'newtab' => 0,
        'created_at' => $date,
        'updated_at' => $date
    ];


    $resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome1);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome2);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome3);

	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome4);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome5);
	
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome6);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner', $bannerHome7);



	// Associate Banners in Sliders
	// $query = 'SELECT * FROM mageplaza_bannerslider_banner_slider';
	// $results = $resourceConnection->getConnection()->fetchAll($query);
	// echo "<pre>";print_r($results);

	$bannerHome1_principal = [
		'slider_id' => 1,
        'banner_id' => 1,
        'position' => 1
	];

	$bannerHome2_principal = [
		'slider_id' => 1,
        'banner_id' => 2,
        'position' => 2
	];

	$bannerHome3_principal = [
		'slider_id' => 1,
        'banner_id' => 3,
        'position' => 3
	];

	$bannerHome4_support1 = [
		'slider_id' => 2,
        'banner_id' => 4,
        'position' => 1
	];

	$bannerHome5_support1 = [
		'slider_id' => 2,
        'banner_id' => 5,
        'position' => 2
	];

	$bannerHome6_support2 = [
		'slider_id' => 3,
        'banner_id' => 6,
        'position' => 1
	];

	$bannerHome7_support2 = [
		'slider_id' => 3,
        'banner_id' => 7,
        'position' => 2
	];

	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome1_principal);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome2_principal);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome3_principal);

	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome4_support1);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome5_support1);

	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome6_support2);
	$resourceConnection->getConnection()->insert('mageplaza_bannerslider_banner_slider', $bannerHome7_support2);
	
 

?>