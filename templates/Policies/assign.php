<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $policy
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Policy'), ['action' => 'edit', $policy->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Policy'), ['action' => 'delete', $policy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $policy->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Policies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Policy'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="policies view content">
            <h3><?= h($policy->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($policy->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Normalized Name') ?></th>
                    <td><?= h($policy->normalized_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($policy->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($policy->description)); ?>
                </blockquote>
            </div>

            <h2>Assigned Roles</h2>
            <table>
                <?php foreach ($policy->roles as $role) :?>
                    <tr>
                        <td><?= $role->name ?></td>
                        <td>
                        <?= $this->Form->create($assignForm, ['url' => ['action' => 'removeFrom', $policy->id]]) ?>
                            <?= $this->Form->control('role_id', ['type' => 'hidden', 'value' => $role->id]); ?>
                            <?= $this->Form->button('Remove from policy') ?>
                        <?= $this->Form->end() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div>
                <?= $this->Form->create($assignForm) ?>
                    <?= $this->Form->control('role_id', ['options' => $roles]); ?>
                    <?= $this->Form->button('Assign') ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
