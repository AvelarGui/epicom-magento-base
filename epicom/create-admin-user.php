<?php
    use Magento\Framework\App\Bootstrap;
    require '../app/bootstrap.php';
    $params = $_SERVER;
    $bootstrap = Bootstrap::create(BP, $params);
    $obj = $bootstrap->getObjectManager();
    
    $userInfo = [];
    
    $userInfo['role_id']  = 1;
    $userInfo['username'] = getenv('EMAIL');
    $userInfo['firstname'] = getenv('FIRST_NAME');
    $userInfo['lastname'] = getenv('LAST_NAME');
    $userInfo['email'] = getenv('EMAIL');
    $userInfo['password'] = getenv('PASSWORD');
    $userInfo['interface_locale'] = 'pt_BR';
    $userInfo['is_active'] = '1';
    
    // Delete Robot User
    //Mage::getModel('admin/user')->load(1)->delete();

    // Create New User
    $adminUser = $obj->get('\Magento\User\Model\UserFactory')->create()->loadByUsername($userInfo['username']);
    if($adminUser->getId()) {
        echo 'admin user already exist';
    } else {
        try{
            $userModel = $obj->get('\Magento\User\Model\UserFactory')->create();
            $userModel->setData($userInfo);
            $userModel->save();
    
            echo 'admin user created successfully';
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
