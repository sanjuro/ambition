<?php

namespace Api\Controller;
 
use Zend\Mvc\Controller\AbstractRestfulController;
 
use Api\Model\User;
use Api\Form\UserForm;
use Api\Model\UserTable;
use Zend\View\Model\JsonModel;

class UserController extends AbstractRestfulController
{
    protected $userTable;

    public function getList()
    { 
        $users = $this->getUserTable()->fetchAll()->toArray();
        return new JsonModel(array('data' => $users));
    }

    public function get($id)
    {  
        $user = $this->getUserTable()->find($id);

        return new JsonModel(array(
            'data' => $user,
        ));
    }

    public function create($data)
    {   
        $form = new Userform();
        $user = new User();
        $form->setInputFilter($user->getInputFilter());
        $form->setData($data);
        if ($form->isValid()) {
            $user->exchangeArray($form->getData());
            $id = $this->getUserTable()->save($user);
        }else{
            $messages = $form->getMessages();
            throw new \Exception(array(
                'errors' => $messages,
            ));
            // return new JsonModel(array(
            //     'errors' => $messages,
            // ));
        }

        return new JsonModel(array(
            'data' => $this->get($id),
        ));
    }

    public function update($id, $data)
    {
        $data['id'] = $id;
        $user = $this->getUserTable()->getUser($id);
        $form = new Userform();
        $form->bind($user);
        $form->setInputFilter($user->getInputFilter());
        $form->setData($data);
        if ($form->isValid()) {
            $id = $this->getUserTable()->save($form->getData());
        }

        return new JsonModel(array(
            'data' => $this->get($id),
        ));
    }

    public function delete($id)
    {
        $this->getUserTable()->deleteUser($id);

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Api\Model\UserTable');
        }
        return $this->userTable;
    }
}