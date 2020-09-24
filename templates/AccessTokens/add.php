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
            <?= $this->Html->link(__('List Access Tokens'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="accessTokens form content">
            <?= $this->Form->create($accessToken) ?>
            <fieldset>
                <legend><?= __('Add Access Token') ?></legend>
                <?php
                    //echo $this->Form->control('token');
                    //echo $this->Form->control('token_plain');
                    echo $this->Form->control('can_read');
                    echo $this->Form->control('can_write');
                    //echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
