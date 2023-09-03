<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App;

use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use App\Policy\RequestPolicy;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Core\ContainerInterface;
use Cake\ORM\Locator\TableLocator;
use Cake\Datasource\FactoryLocator;
use Authorization\Policy\MapResolver;
use Authorization\Policy\OrmResolver;

use Authorization\AuthorizationService;
use Psr\Http\Message\ResponseInterface;
use Authentication\AuthenticationService;
use Authorization\Policy\ResolverCollection;
use Cake\Routing\Middleware\AssetMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Cake\Http\Middleware\BodyParserMiddleware;

use Cake\Routing\Middleware\RoutingMiddleware;
use Authorization\AuthorizationServiceInterface;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Authentication\AuthenticationServiceInterface;
use Authentication\Identifier\IdentifierInterface;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Authorization\Middleware\AuthorizationMiddleware;
use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\AuthorizationServiceProviderInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authorization\Middleware\RequestAuthorizationMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface, AuthorizationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        } else {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false)
            );
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }

        // Load more plugins here
        $this->addPlugin('Authentication');
        $this->addPlugin('Authorization');
        $this->addPlugin('ADmad/Glide');
        $this->addPlugin('Ajax', ['bootstrap' => true]);
        $this->addPlugin('Muffin/Trash');
        $this->addPlugin('MixerApi/Bake');
        $this->addPlugin('MixerApi/ExceptionRender');
        $this->addPlugin('ApiTokenAuthenticator');
        $this->addPlugin('SwaggerBake');
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $request = new ServerRequest();
        $csrf = new CsrfProtectionMiddleware(['httponly' => true]);
        // Token check will be skipped when callback returns `true`.
        $csrf->skipCheckCallback(function ($request) {
            // Skip token check for API URLs.
            if (strpos($request->getPath(), '/api') === 0) {
                return true;
            }
        });

        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware())

            ->add(new AuthenticationMiddleware($this))

            ->add(new AuthorizationMiddleware($this), [
                'unauthorizedHandler' => [
                    'className' => 'Authorization.Redirect',
                    'url' => '/Accouts/login',
                    'queryParam' => 'redirectUrl',
                    'exceptions' => [
                        MissingIdentityException::class,
                        OtherException::class,
                    ],
                ],
            ])

            ->add(new RequestAuthorizationMiddleware())

            // Cross Site Request Forgery (CSRF) Protection Middleware
            // https://book.cakephp.org/4/en/security/csrf.html#cross-site-request-forgery-csrf-middleware
            ->add($csrf);

        return $middlewareQueue;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
    }

    /**
     * Returns a service provider instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService();
        $fields = [
            IdentifierInterface::CREDENTIAL_USERNAME => 'email',
            IdentifierInterface::CREDENTIAL_PASSWORD => 'password'
        ];

        if (strpos($request->getPath(), '/api') === 0) {

            $service->loadAuthenticator('Authentication.Jwt', [
                'secretKey' => file_get_contents(CONFIG . 'jwt.pem'),
                'algorithm' => 'RS256',
                'returnPayload' => false
            ]);
            $service->loadAuthenticator('Authentication.Form', [
                'fields' => $fields,
                'loginUrl' => Router::url('/api/v1/usuaria/login.json'),
            ]);
            //$service->loadAuthenticator('Authentication.Session');

            $service->loadAuthenticator('Authentication.Token', [
                'queryParam' => 'token',
                'header' => 'Authorization',
                'tokenPrefix' => 'Token',
            ]);

            $service->loadIdentifier('Authentication.JwtSubject', ['fields' => $fields, 'resolver' => ['className' => 'Authentication.Orm'], 'tokenField' => 'userkeyid']);

            $service->loadIdentifier('Authentication.Password', [
                'fields' => $fields,
                'resolver' => [
                    'className' => 'Authentication.Orm',
                    'finder' => 'authenticatedUser' // <<< there it goes
                ]
            ]);
            return $service;
        }
        // Define where users should be redirected to when they are not authenticated
        $service->setConfig([
            'unauthenticatedRedirect' => Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'Accounts',
                'action' => 'login',
            ]),
            'queryParam' => 'redirect',
        ]);


        // Load the authenticators. Session should be first.
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            'loginUrl' => Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'Accounts',
                'action' => 'login',
            ]),
        ]);

        // Load identifiers
        $service->loadIdentifier('Authentication.Password', ['fields' => $fields, 'resolver' => ['className' => 'Authentication.Orm', 'finder' => 'authenticatedUser']]);

        return $service;
    }


    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $map = new MapResolver();

        $map->map(
            ServerRequest::class,
            RequestPolicy::class
        );

        $orm = new OrmResolver();

        $resolver = new ResolverCollection([
            $map,
            $orm
        ]);

        return new AuthorizationService($resolver);
    }

    /**
     * Bootstrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        $this->addOptionalPlugin('Cake/Repl');
        $this->addOptionalPlugin('Bake');

        $this->addPlugin('Migrations');

        // Load more plugins here
    }
}
