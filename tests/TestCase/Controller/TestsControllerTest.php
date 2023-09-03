<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\TestsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TestsController Test Case
 *
 * @uses \App\Controller\TestsController
 */
class TestsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Tests',
    ];
}
