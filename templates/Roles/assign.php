<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roles view content">
            <h3><?= h($role->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($role->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Normalized Name') ?></th>
                    <td><?= h($role->normalized_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Uuid') ?></th>
                    <td><?= h($role->uuid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($role->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($role->description)); ?>
                </blockquote>
            </div>
            <h2>Users with this role</h2>
            <table>
                <?php foreach($role->users as $user): ?>
                    <tr>
                        <td><?= $user->email ?></td>
                        <td>
                        <?= $this->Form->create($assignForm, ['url' => ['action' => 'removeFrom', $role->id]]) ?>
                            <?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => $user->id]); ?>
                            <?= $this->Form->button('Remove from role') ?>
                        <?= $this->Form->end() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div>
            <?= $this->Form->create($assignForm) ?>
                <?= $this->Form->control('user_id', ['options' => $users]); ?>
                <?= $this->Form->button('Assign') ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
