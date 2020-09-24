<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Form;

use Cake\TestSuite\TestCase;
use Iam\Form\PolicyBuilderForm;

/**
 * Iam\Form\PolicyBuilderForm Test Case
 */
class PolicyBuilderFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Form\PolicyBuilderForm
     */
    protected $PolicyBuilder;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->PolicyBuilder = new PolicyBuilderForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PolicyBuilder);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
