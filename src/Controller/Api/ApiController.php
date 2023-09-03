<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\Event\EventInterface;
use App\Controller\AppController;
use Cake\Database\Exception\MissingExtensionException;

/**
 * Api Controller
 *
 */
class ApiController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    private function setCorsHeaders()
    {
        $this->response = $this->response->cors($this->request)
            ->allowOrigin(['*'])
            ->allowMethods(['*'])
            ->allowHeaders(['x-xsrf-token', 'Origin', 'Content-Type', 'X-Auth-Token', 'Access-Control-Allow-Headers', 'Authorization', 'HTTP_Authorization', 'X-Requested-With'])
            ->allowCredentials(['true'])
            ->exposeHeaders(['Link'])
            ->maxAge(300)
            ->build();
    }

    public function viewClasses(): array
    {
        if (is_null($this->request->getParam('_ext'))) {
            throw new MissingExtensionException(__('Bad Request! Missing Extenstion (json,xml)'));
        }
        return [JsonView::class, XmlView::class];
    }

    public function beforeRender(EventInterface $event)
    {

        $this->setCorsHeaders();
    }
    public function beforeFilter(EventInterface $event)
    {

        if ($this->request->is('OPTIONS')) {
            $this->setCorsHeaders();
            return $this->response;
        }
    }


    public function jwtToken($result)
    {
        $privateKey = file_get_contents(CONFIG . 'jwt.key');
        $expire  = time() + 60 * 60;
        $payload = [
            'iss' => 'myapp',
            'sub' => $result->getData()->userkeyid,
            'exp' => $expire,
        ];
        return [
            'token' => JWT::encode($payload, $privateKey, 'RS256'),
            'token_expire_time' => $expire
        ];
    }
}