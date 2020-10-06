<?php
declare(strict_types=1);

namespace Iam\View\Cell;

use Cake\View\Cell;
use Iam\ViewModel\UserDropDownViewModel;

/**
 * UserDropdown cell
 */
class UserDropdownCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        /** @var \Iam\Model\Entity\User $user */
        $user = $this->request->getSession()->read('Auth');

        $model = new UserDropDownViewModel($user->email, (int)$user->id);

        $this->set(compact('model'));
    }
}
