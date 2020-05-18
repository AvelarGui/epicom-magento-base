<?php
    
    use Magento\Framework\App\Bootstrap;
    require '../app/bootstrap.php';   
    $params = $_SERVER;
    $bootstrap = Bootstrap::create(BP, $params);
    $obj = $bootstrap->getObjectManager();
    
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    
    // Get categories ids
    $categoryFactory = $obj->get('Magento\Catalog\Model\CategoryFactory');
    
    $novidades = $categoryFactory->create()->getCollection()->addAttributeToFilter('name','Novidades');
    $novidadesId = $novidades->getFirstItem()->getId();

    $promocoes = $categoryFactory->create()->getCollection()->addAttributeToFilter('name','Promoções');
    $promocoesId = $promocoes->getFirstItem()->getId();

    $saldao = $categoryFactory->create()->getCollection()->addAttributeToFilter('name','Saldão');
    $saldaoId = $saldao->getFirstItem()->getId();

    // Create de home content
    $PageFactory = $objectManager->create('Magento\Cms\Model\PageFactory');
    $homeContent = '';

    $homeContent = $homeContent.'<p>{{block class="Mageplaza\BannerSlider\Block\Widget" template="Mageplaza_BannerSlider::bannersliderSupport.phtml" slider_id="2"}}</p>';

    $homeContent = $homeContent.'<p>{{widget type="Magento\CatalogWidget\Block\Product\ProductsList" title="Promoções" show_pager="0" products_count="5" template="Magento_CatalogWidget::product/widget/content/grid.phtml" conditions_encoded="^[`1`:^[`type`:`Magento||CatalogWidget||Model||Rule||Condition||Combine`,`aggregator`:`all`,`value`:`1`,`new_child`:``^],`1--1`:^[`type`:`Magento||CatalogWidget||Model||Rule||Condition||Product`,`attribute`:`category_ids`,`operator`:`==`,`value`:`'.$novidadesId.'`^]^]"}}</p>';
 
    $homeContent = $homeContent.'<p>{{widget type="Magento\CatalogWidget\Block\Product\ProductsList" title="Novidades" show_pager="0" products_count="5" template="Magento_CatalogWidget::product/widget/content/grid.phtml" conditions_encoded="^[`1`:^[`type`:`Magento||CatalogWidget||Model||Rule||Condition||Combine`,`aggregator`:`all`,`value`:`1`,`new_child`:``^],`1--1`:^[`type`:`Magento||CatalogWidget||Model||Rule||Condition||Product`,`attribute`:`category_ids`,`operator`:`==`,`value`:`'.$promocoesId.'`^]^]"}}</p>';

    $homeContent = $homeContent.'<p>{{block class="Mageplaza\BannerSlider\Block\Widget" template="Mageplaza_BannerSlider::bannersliderSupport.phtml" slider_id="3"}}</p>';

    $homeContent = $homeContent.'<p>{{widget type="Magento\CatalogWidget\Block\Product\ProductsList" title="Saldão" show_pager="0" products_count="5" template="Magento_CatalogWidget::product/widget/content/grid.phtml" conditions_encoded="^[`1`:^[`type`:`Magento||CatalogWidget||Model||Rule||Condition||Combine`,`aggregator`:`all`,`value`:`1`,`new_child`:``^],`1--1`:^[`type`:`Magento||CatalogWidget||Model||Rule||Condition||Product`,`attribute`:`category_ids`,`operator`:`==`,`value`:`'.$promocoesId.'`^]^]"}}</p>';

    $homePage = $PageFactory->create()->load(
        'home',
        'identifier'
    );
        
    // Save content in home
    $homePage->getId();
    $homePage->setContent($homeContent);
    $homePage->save();

    // if ($newPage->getId()) {
    //     $newPage->setContent($newPageContent);
    //     $newPage->save();
    // }
    
    // Usado para criar cms pages 
    //$PageFactory->create()->setData($cmsPageData)->save();
    // $cmsPageData = [
    //     'title' => 'First Magento 2 CMS page', // cms page title
    //     'page_layout' => '1column', // cms page layout
    //     'meta_keywords' => 'Page keywords', // cms page meta keywords
    //     'meta_description' => 'Page description', // cms page description
    //     'identifier' => 'custom-page', // cms page url identifier
    //     'content_heading' => 'Custom cms page', // Page heading
    //     'content' => "<h1>New Magento 2 CMS Page Content</h1>", // page content
    //     'is_active' => 1, // define active status
    //     'stores' => [1], // assign to stores
    //     'sort_order' => 0 // page sort order
    // ];