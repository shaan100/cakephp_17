<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 * @var string[]|\Cake\Collection\CollectionInterface $permissions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $role->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roles form content">
            <?= $this->Form->create($role) ?>
            <fieldset>
                <legend><?= __('Edit Role') ?></legend>
                <?php
                echo $this->Form->control('role_name');
                echo $this->Form->control('role_note');
                ?>
                <div>
                    <?php $x = 0;
                    foreach ($role->permissions as $pr) : ?>
                    <div class="my-3">
                        <input type="checkbox" class="form-check-input" name="permissions[_ids][]"
                            value="<?= $pr->id; ?>"
                            <?php if ($pr->_joinData) : echo 'checked';
                                                                                                                                endif; ?>><?= $pr->permission_resource ?>
                        <div>
                            View<?= $this->Form->checkbox($pr->permission_resource . '_view', ['class' => 'form-check-input', 'checked' => $pr->_joinData->_view]); ?>
                            Create<?= $this->Form->checkbox($pr->permission_resource . '_create', ['class' => 'form-check-input', 'checked' => $pr->_joinData->_create]); ?>
                            Edit<?= $this->Form->checkbox($pr->permission_resource . '_edit', ['class' => 'form-check-input', 'checked' => $pr->_joinData->_edit]); ?>
                            Delete<?= $this->Form->checkbox($pr->permission_resource . '_delete', ['class' => 'form-check-input', 'checked' => $pr->_joinData->_delete]); ?>
                        </div>
                    </div>
                    <?php $x++;
                    endforeach; ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>