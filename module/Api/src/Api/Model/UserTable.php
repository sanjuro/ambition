<?php

namespace Api\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Api\Model\User;

 class UserTable extends AbstractTableGateway
 {
    # protected $tableGateway;
    protected $table = 'user';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function find($id)
    {
        $id = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find User with id " . $id);
        }

        $user = new User();
        $user->exchangeArray($row);
        return $user;
    }

    public function save(User $user)
    {
        $data = array(
                      'first_name' => stripslashes($user->first_name),
                      'last_name' => stripslashes($user->last_name),
                      'username' => stripslashes($user->username),
                      'email' => stripslashes($user->email),
                      'password' => md5($user->password),
                      'dob' => $user->dob,
                     );

        $id = (int) $user->id;
        if ($id == 0) {
            try {
                $this->insert($data);
                $id = $this->getLastInsertValue(); //Add this line
            } catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e) {
                throw $e->getPrevious();
            }
        } else {
            try {
                $this->update($data, array('id' => $id));
            } catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e) {
                throw $e->getPrevious();
            }
        }

        return $id;
    }

    public function remove($id)
    {
        $this->delete(array('id' => $id));
    }
 }