<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $group
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Groups'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="groups form content">
            <?= $this->Form->create($group) ?>
            <fieldset>
                <legend><?= __('Add Group') ?></legend>
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
