<?php
/**
 * @var \App\View\AppView $this
 * @var \Iam\ViewModel\UserIndexViewModel[] $users
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('group_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->getId()) ?></td>
                    <td style="<?= $user->isActive() ? 'font-weight: 700' : ''; ?>">
                        <?= h($user->getEmail()) ?>
                    </td>
                    <td><?= h($user->getCreated()) ?></td>
                    <td><?= h($user->getModified()) ?></td>
                    <td><?= $this->Html->link($user->getGroupName(), ['controller' => 'Groups', 'action' => 'view', $user->getGroupId()]) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->getId()]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->getId()]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->getId()], ['confirm' => __('Are you sure you want to delete # {0}?', $user->getId())]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
