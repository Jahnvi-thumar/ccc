<?php
class Customer_Controller_Index extends Core_Controller_Customer_Action{
    
    protected $_allowedActions = ['login' , 'loginPost' , 'registration' , 'registrationPost' , 'test'];

    public function testAction(){

        // echo 'test action';
        $session = Mage::getSingleton('core/session');
            $session->set('test' , 100);

        // echo '<pre> test : ';
        // print_r($session->get('customer_id'));
        // echo '</pre>';
    }
    public function loginAction(){

        $layout = $this->getLayout();
        $login = $layout->createBlock('customer/index_login');
        $layout->getChild('content')->addChild('login', $login);
        $layout->toHtml();
    }

    public function loginPostAction(){

        $customer = Mage::getModel('customer/customer')
            ->setData($this->getRequest()->getParam('customer'));

        // echo '<pre> login Data : ';
        // print_r($customer);
        // echo '</pre>';
        // /die;

        if($customer->isEmailExist()){
            //check password
            // echo 'alloe for login';
            // die;
            if($customer->isPasswordValid()){
                $customer = $customer->load($customer->getEmail() , 'email');
                // echo "<br> hello";
                // echo '<pre>';
                // print_r($customer);
                // echo '</pre>';
                // echo $customer->getCustomerId();
                // die;
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

        
    }

    public function registrationAction(){

        $layout = $this->getLayout();
        $registration = $layout->createBlock('customer/index_registration');
        $layout->getChild('content')->addChild('registration', $registration);
        $layout->toHtml();
    }

    public function registrationPostAction(){

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

    public function dashBoardAction(){

        $layout = $this->getLayout();
        $dashBoard = $layout->createBlock('customer/index_dashboard');
        $layout->getChild('content')->addChild('dashboard' , $dashBoard);

        $customer_profile = $layout->createBlock('customer/index_dashboard_customer');
        $dashBoard->addChild('customer_profile' , $customer_profile);

        $customer_address = $layout->createBlock('customer/index_dashboard_address');
        $dashBoard->addChild('customer_address' , $customer_address);

        $layout->toHtml();

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