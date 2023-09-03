<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ZiraComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ZiraComponent Test Case
 */
class ZiraComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ZiraComponent
     */
    protected $Zira;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Zira = new ZiraComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Zira);

        parent::tearDown();
    }
}
