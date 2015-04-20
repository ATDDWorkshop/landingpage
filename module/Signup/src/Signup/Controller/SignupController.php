<?php
/**
 * Created by PhpStorm.
 * User: gmeyenberg
 * Date: 13.04.2015
 * Time: 17:43
 */

namespace Signup\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Signup\Model\User;
use Signup\Form\SignupForm;

class SignupController extends AbstractActionController
{

    public function signupAction()
    {
        $form = new SignupForm($this->params()->fromQuery("camp"));
        $error = false;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user->exchangeArray($form->getData());

                if ($user->save()) {
                    return $this->redirect()->toUrl("http://shop");
                } else {
                    $error = true;
                }
            }
        }
        return array('form' => $form, 'error' => $error, 'camp' => $camp);

    }
}