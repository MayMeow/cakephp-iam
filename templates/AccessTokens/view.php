<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $accessToken
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Access Token'), ['action' => 'edit', $accessToken->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Access Token'), ['action' => 'delete', $accessToken->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessToken->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Access Tokens'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Access Token'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="accessTokens view content">
            <h3><?= h($accessToken->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Token') ?></th>
                    <td><?= h($accessToken->token) ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Plain') ?></th>
                    <td><?= h($accessToken->token_plain) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $accessToken->has('user') ? $this->Html->link($accessToken->user->id, ['controller' => 'Users', 'action' => 'view', $accessToken->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($accessToken->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($accessToken->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($accessToken->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Read') ?></th>
                    <td><?= $accessToken->can_read ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Can Write') ?></th>
                    <td><?= $accessToken->can_write ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
