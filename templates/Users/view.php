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
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Api Token') ?></th>
                    <td><?= h($user->api_token) ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret') ?></th>
                    <td><?= h($user->secret) ?></td>
                </tr>
                <tr>
                    <th><?= __('Account Verify') ?></th>
                    <td><?= h($user->account_verify) ?></td>
                </tr>
                <tr>
                    <th><?= __('Profile') ?></th>
                    <td><?= $user->has('profile') ? $this->Html->link($user->profile->id, ['controller' => 'Profiles', 'action' => 'view', $user->profile->id]) : '' ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Userkeyid') ?></th>
                    <td><?= $user->userkeyid === null ? '' : $this->Number->format($user->userkeyid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Longitude') ?></th>
                    <td><?= $user->longitude === null ? '' : $this->Number->format($user->longitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Latitude') ?></th>
                    <td><?= $user->latitude === null ? '' : $this->Number->format($user->latitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $this->Number->format($user->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Secret Verified') ?></th>
                    <td><?= $user->secret_verified === null ? '' : $this->Number->format($user->secret_verified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?= $user->is_superuser === null ? '' : $this->Number->format($user->is_superuser) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role Id') ?></th>
                    <td><?= $user->role_id === null ? '' : $this->Number->format($user->role_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Token Expire') ?></th>
                    <td><?= h($user->token_expire) ?></td>
                </tr>
                <tr>
                    <th><?= __('Activation Date') ?></th>
                    <td><?= h($user->activation_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tos Date') ?></th>
                    <td><?= h($user->tos_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Join Date') ?></th>
                    <td><?= h($user->join_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Login Time') ?></th>
                    <td><?= h($user->login_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Logout Time') ?></th>
                    <td><?= h($user->logout_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Trashed') ?></th>
                    <td><?= h($user->trashed) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Profiles') ?></h4>
                <?php if (!empty($user->many_profiles)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Date Of Birth') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Social Links') ?></th>
                            <th><?= __('Bio') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('Accessibility') ?></th>
                            <th><?= __('Dob Visibility') ?></th>
                            <th><?= __('Bio Visibility') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->many_profiles as $manyProfiles) : ?>
                        <tr>
                            <td><?= h($manyProfiles->id) ?></td>
                            <td><?= h($manyProfiles->first_name) ?></td>
                            <td><?= h($manyProfiles->last_name) ?></td>
                            <td><?= h($manyProfiles->date_of_birth) ?></td>
                            <td><?= h($manyProfiles->gender) ?></td>
                            <td><?= h($manyProfiles->user_id) ?></td>
                            <td><?= h($manyProfiles->phone) ?></td>
                            <td><?= h($manyProfiles->social_links) ?></td>
                            <td><?= h($manyProfiles->bio) ?></td>
                            <td><?= h($manyProfiles->avatar) ?></td>
                            <td><?= h($manyProfiles->accessibility) ?></td>
                            <td><?= h($manyProfiles->dob_visibility) ?></td>
                            <td><?= h($manyProfiles->bio_visibility) ?></td>
                            <td><?= h($manyProfiles->created) ?></td>
                            <td><?= h($manyProfiles->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Profiles', 'action' => 'view', $manyProfiles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Profiles', 'action' => 'edit', $manyProfiles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Profiles', 'action' => 'delete', $manyProfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $manyProfiles->id)]) ?>
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