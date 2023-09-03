<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="container">
    <div class="content">
        <div class="row">
            <?php foreach ($users as $user) : ?>
                <div class="column">
                    <img src="<?= $user->avatar ?>" style="height: 65px;width:65px;border-radius:100%">
                    <h3><?= $user->profile->full_name ?></h3>
                    <span><?= $user->email ?></span>
                </div>
                <div class="column">
                    <?= $this->Html->link('Edit', ['controller' => 'Users', 'action' => 'edit', $this->Identity->get('userkeyid')]) ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>