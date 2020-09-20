<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Form;

use Cake\TestSuite\TestCase;
use Iam\Form\AssignRoleForm;

/**
 * Iam\Form\AssignRoleForm Test Case
 */
class AssignRoleFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Form\AssignRoleForm
     */
    protected $AssignRole;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->AssignRole = new AssignRoleForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AssignRole);

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
