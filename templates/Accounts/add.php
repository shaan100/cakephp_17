<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                echo $this->Form->control('profile.first_name', ['required' => false]);
                echo $this->Form->control('profile.last_name', ['required' => false]);
                echo $this->Form->control('email', ['required' => false]);
                echo $this->Form->control('password', ['required' => false]);
                echo $this->Form->radio('profile.gender', [['value' => "male", 'text' => 'Male'], ['value' => "female", 'text' => 'Female'], ['value' => "others", 'text' => 'Others']]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>