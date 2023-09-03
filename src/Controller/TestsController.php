<?php

declare(strict_types=1);

namespace App\Controller;


/**
 * Tests Controller
 *
 */
class TestsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index']);
        $this->Authorization->skipAuthorization();
    }


    public function index()
    {
        echo $this->request->getAttribute('identity')->getIdentifier();

        $Users = $this->getTableLocator()->get('Users');

        $users = $Users->get($this->request->getAttribute('identity')->getIdentifier());

        pr($users);

        $this->autoRender = false;
    }
}
