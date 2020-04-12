<?php
    use Magento\Framework\App\Bootstrap;
    require '../../app/bootstrap.php';
    $params = $_SERVER;
    $bootstrap = Bootstrap::create(BP, $params);
    $obj = $bootstrap->getObjectManager();
    
    $userInfo = [];
    
    $userInfo['role_id']  = 1;
    $userInfo['username'] = 'guilherme';
    $userInfo['firstname'] = 'Guilherme';
    $userInfo['lastname'] = 'Avelar';
    $userInfo['email'] = 'guilhermesantosavelar@gmail.com';
    $userInfo['password'] = 'password123@';
    $userInfo['interface_locale'] = 'pt_BR';
    $userInfo['is_active'] = '1';
    
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
