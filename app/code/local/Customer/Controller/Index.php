<?php
class Customer_Controller_Index extends Core_Controller_Customer_Action{
    
    protected $_allowedActions = ['login' , 'loginPost' , 'registration' , 'registrationPost' , 'test'];

    public function testAction(){

        $session = Mage::getSingleton('core/session');
            $session->set('test' , 100);
    }
    public function loginAction(){

        // echo '123';
        $login = $this->getLayout()->createBlock('customer/index_login');
        $this->getLayout()->getChild('content')->addChild('login', $login);
        $this->getLayout()->getChild('head')->addCss('customer/index/login.css');
        $this->getLayout()->toHtml();
    }

    public function loginPostAction(){

        $customer = Mage::getModel('customer/customer')
            ->setData($this->getRequest()->getParam('customer'));

        if($customer->isEmailExist()){
            //check password
            // echo 'alloe for login';
            // die;
            if($customer->isPasswordValid()){
                $customer = $customer->load($customer->getEmail() , 'email');
               
                $session = Mage::getSingleton('core/session')
                    ->set('customer_id' ,$customer->getCustomerId());
                $this->redirect('customer/index/dashboard');
            } else {
                echo "Invalid Password";
                
            }
             
        } else {
            $this->redirect('customer/index/registration');
        }
    }

    public function LogoutAction(){

        // echo 'logout';
        $session = Mage::getSingleton('core/session')
            ->remove('customer_id');
        $this->redirect('customer/index/login');
    }

    public function registrationAction(){

        $layout = $this->getLayout();
        $registration = $layout->createBlock('customer/index_registration');
        $layout->getChild('content')->addChild('registration', $registration);
        $this->getLayout()->getChild('head')->addCss('customer/index/registration.css');
        $this->getLayout()->getChild('head')->addJs('customer/index/registration.js');

        $layout->toHtml();
    }

    public function registrationPostAction(){

        if($this->getRequest()->isAjax()){
            $email = $this->getRequest()->getParam('email');
            $customer = Mage::getModel('customer/customer')
                ->setEmail($email)
                ->isEmailExist();

            if($customer){
                echo "0";
            } else {
                echo '1';
            }
        } else {

            $customer = Mage::getModel('customer/customer')
                ->setData($this->getRequest()->getParam('customer'));
            
            if($customer->isEmailExist()){
                $this->redirect('customer/index/registration');
            } else {
                $customer->save();
                $session = Mage::getSingleton('core/session')
                    ->set('customer_id' , $customer->getCustomerId());
                $this->redirect('customer/index/dashboard');
            }
        } 
       
    }

    public function dashBoardAction(){

        $dashBoard = $this->getLayout()->createBlock('customer/index_dashboard');
        $this->getLayout()->getChild('content')->addChild('dashboard' , $dashBoard);
        $this->getLayout()->getChild('head')->addCss('customer/index/dashboard.css');

        $customer_profile = $this->getLayout()->createBlock('customer/index_dashboard_customer');
        $dashBoard->addChild('customer_profile' , $customer_profile);

        $customer_address = $this->getLayout()->createBlock('customer/index_dashboard_address');
        $dashBoard->addChild('customer_address' , $customer_address);

        $this->getLayout()->toHtml();

    }

    public function profileNewAction(){

        $customerId = $this->getRequest()->getquery();
        $layout = $this->getLayout();
        $address = $layout->createBlock('customer/index_new');
        $layout->getChild('content')->addChild('address' , $address);
        $layout->toHtml();
    }

    public function editProfileAction(){

        $data = $this->getRequest()->getParam('customer');

        Mage::getModel('customer/customer')
            ->setData($data)
            ->save();
          
    }
}

?>