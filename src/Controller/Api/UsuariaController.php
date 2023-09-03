<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Chronos\Chronos;
use Cake\Utility\Security;
use App\Controller\AppController;
use Cake\Http\Exception\BadRequestException;

/**
 * Usuaria Controller
 *
 * @method \App\Model\Entity\Usuarium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariaController extends ApiController
{


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        $this->Authentication->addUnauthenticatedActions(['index', 'view', 'add', 'delete', 'login']);

        if (in_array($this->request->getParam('action'), ['index', 'view', 'add', 'delete', 'login'])) {
            $this->Authorization->skipAuthorization();
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    public function index()
    {
        $this->request->allowMethod('get');
        $usuaria = $this->paginate($this->Usuaria);

        $this->set(compact('usuaria'));
        $this->viewBuilder()->setOption('serialize', 'usuaria');
    }

    /**
     * View method
     *
     * @param string|null $id Usuarium id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    public function view($id = null)
    {
        $this->request->allowMethod('get');
        $usuarium = $this->Usuaria->get($id, [
            'contain' => [],
        ]);

        $this->set('usuarium', $usuarium);
        $this->viewBuilder()->setOption('serialize', 'usuarium');
    }

    public function login()
    {
        $this->request->allowMethod(['post']);
        $Users = $this->getTableLocator()->get('Users');
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $userIdentity = $this->Authentication->getIdentity();
            $user = $userIdentity->getOriginalData();
            list($user->token, $user->token_expiration) = $this->generateToken();
            $user = $Users->save($user);
            $result = [
                'status' => $result->getStatus(),
                'access_token' => $result->getData()->token,
                //'access_token' => $this->jwtToken($result),
                'user' => $result->getData(),
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $result = $this->Zira->credential($result);
            throw new BadRequestException(__($result));
        }
        $this->set(compact('result'));
        $this->viewBuilder()->setOption('serialize', 'result');
        $Users->updateAll(
            ['token' => null, 'token_expiration' => null],
            ['token_expiration <' => Chronos::now()]
        );
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */

    private function generateToken(int $length = 40, string $expiration = '+6 hours')
    {
        $random = base64_encode(Security::randomBytes($length));
        $cleaned = preg_replace('/[^A-Za-z0-9]/', '', $random);
        return [$cleaned, strtotime($expiration)];
    }


    public function logout()
    {
        $this->Authentication->logout();
        $logout = ['message' => __('logout successfully')];
        $this->set(compact('logout'));
        $this->viewBuilder()->setOption('serialize', 'logout');
    }

    public function add()
    {
        $this->request->allowMethod('post');
        $usuarium = $this->Usuaria->newEmptyEntity();
        $usuarium = $this->Usuaria->patchEntity($usuarium, $this->request->getData());
        if ($this->Usuaria->save($usuarium)) {
            $this->set('usuarium', $usuarium);
            $this->viewBuilder()->setOption('serialize', 'usuarium');

            return;
        }
        throw new \Exception("Record not created");
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuarium id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $usuarium = $this->Usuaria->get($id, [
            'contain' => [],
        ]);
        $usuarium = $this->Usuaria->patchEntity($usuarium, $this->request->getData());
        if ($this->Usuaria->save($usuarium)) {
            $this->set('usuarium', $usuarium);
            $this->viewBuilder()->setOption('serialize', 'usuarium');

            return;
        }
        throw new \Exception("Record not saved");
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuarium id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $usuarium = $this->Usuaria->get($id);
        if ($this->Usuaria->delete($usuarium)) {
            return $this->response->withStatus(204);
        }
        throw new \Exception("Record not deleted");
    }
}
