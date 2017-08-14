<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Calender'), ['action' => 'edit', $calender->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Calender'), ['action' => 'delete', $calender->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calender->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Calenders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Calender'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="calenders view large-9 medium-8 columns content">
    <h3><?= h($calender->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $calender->has('user') ? $this->Html->link($calender->user->name, ['controller' => 'Users', 'action' => 'view', $calender->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plan') ?></th>
            <td><?= $calender->has('plan') ? $this->Html->link($calender->plan->title, ['controller' => 'Plans', 'action' => 'view', $calender->plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($calender->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($calender->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($calender->modified) ?></td>
        </tr>
    </table>
</div>
