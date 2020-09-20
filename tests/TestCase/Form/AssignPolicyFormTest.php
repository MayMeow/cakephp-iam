<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Form;

use Cake\TestSuite\TestCase;
use Iam\Form\AssignPolicyForm;

/**
 * Iam\Form\AssignPolicyForm Test Case
 */
class AssignPolicyFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Form\AssignPolicyForm
     */
    protected $AssignPolicy;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->AssignPolicy = new AssignPolicyForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AssignPolicy);

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
