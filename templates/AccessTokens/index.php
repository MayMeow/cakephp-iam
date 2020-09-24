<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $accessTokens
 */
?>
<div class="accessTokens index content">
    <?= $this->Html->link(__('New Access Token'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Access Tokens') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('token') ?></th>
                    <th><?= $this->Paginator->sort('token_plain') ?></th>
                    <th><?= $this->Paginator->sort('can_read') ?></th>
                    <th><?= $this->Paginator->sort('can_write') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accessTokens as $accessToken): ?>
                <tr>
                    <td><?= $this->Number->format($accessToken->id) ?></td>
                    <td><?= h($accessToken->token) ?></td>
                    <td><?= h($accessToken->token_plain) ?></td>
                    <td><?= h($accessToken->can_read) ?></td>
                    <td><?= h($accessToken->can_write) ?></td>
                    <td><?= h($accessToken->created) ?></td>
                    <td><?= $accessToken->has('user') ? $this->Html->link($accessToken->user->id, ['controller' => 'Users', 'action' => 'view', $accessToken->user->id]) : '' ?></td>
                    <td><?= h($accessToken->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $accessToken->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessToken->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessToken->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessToken->id)]) ?>
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
