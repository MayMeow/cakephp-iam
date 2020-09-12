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
            <?= $this->Html->link(__('List Policies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="policies form content">
            <?= $this->Form->create($policy) ?>
            <fieldset>
                <legend><?= __('Add Policy') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('normalized_name');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
