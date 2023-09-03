<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
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
            <h3><?= h($role->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Role Name') ?></th>
                    <td><?= h($role->role_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role Note') ?></th>
                    <td><?= h($role->role_note) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($role->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $role->user_id === null ? '' : $this->Number->format($role->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($role->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($role->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Permissions') ?></h4>
                <?php if (!empty($role->permissions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Permission Resource') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->permissions as $permissions) : ?>
                        <tr>
                            <td><?= h($permissions->id) ?></td>
                            <td><?= h($permissions->permission_resource) ?></td>
                            <td><?= h($permissions->created) ?></td>
                            <td><?= h($permissions->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Permissions', 'action' => 'view', $permissions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Permissions', 'action' => 'edit', $permissions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Permissions', 'action' => 'delete', $permissions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permissions->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($role->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Token Expire') ?></th>
                            <th><?= __('Token Expiration') ?></th>
                            <th><?= __('Userkeyid') ?></th>
                            <th><?= __('Api Token') ?></th>
                            <th><?= __('Activation Date') ?></th>
                            <th><?= __('Longitude') ?></th>
                            <th><?= __('Latitude') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Tos Date') ?></th>
                            <th><?= __('Secret') ?></th>
                            <th><?= __('Secret Verified') ?></th>
                            <th><?= __('Account Verify') ?></th>
                            <th><?= __('Is Superuser') ?></th>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('Join Date') ?></th>
                            <th><?= __('Login Time') ?></th>
                            <th><?= __('Logout Time') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Trashed') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->token) ?></td>
                            <td><?= h($users->token_expire) ?></td>
                            <td><?= h($users->token_expiration) ?></td>
                            <td><?= h($users->userkeyid) ?></td>
                            <td><?= h($users->api_token) ?></td>
                            <td><?= h($users->activation_date) ?></td>
                            <td><?= h($users->longitude) ?></td>
                            <td><?= h($users->latitude) ?></td>
                            <td><?= h($users->active) ?></td>
                            <td><?= h($users->tos_date) ?></td>
                            <td><?= h($users->secret) ?></td>
                            <td><?= h($users->secret_verified) ?></td>
                            <td><?= h($users->account_verify) ?></td>
                            <td><?= h($users->is_superuser) ?></td>
                            <td><?= h($users->role_id) ?></td>
                            <td><?= h($users->join_date) ?></td>
                            <td><?= h($users->login_time) ?></td>
                            <td><?= h($users->logout_time) ?></td>
                            <td><?= h($users->created) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td><?= h($users->trashed) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->userkeyid]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->userkeyid]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->userkeyid], ['confirm' => __('Are you sure you want to delete # {0}?', $users->userkeyid)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
