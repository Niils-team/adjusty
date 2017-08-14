<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Plan'), ['action' => 'edit', $plan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Plan'), ['action' => 'delete', $plan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Calenders'), ['controller' => 'Calenders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Calender'), ['controller' => 'Calenders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="plans view large-9 medium-8 columns content">
    <h3><?= h($plan->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $plan->has('user') ? $this->Html->link($plan->user->name, ['controller' => 'Users', 'action' => 'view', $plan->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($plan->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($plan->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($plan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($plan->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($plan->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($plan->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Memo') ?></h4>
        <?= $this->Text->autoParagraph(h($plan->memo)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Calenders') ?></h4>
        <?php if (!empty($plan->calenders)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Plan Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($plan->calenders as $calenders): ?>
            <tr>
                <td><?= h($calenders->id) ?></td>
                <td><?= h($calenders->user_id) ?></td>
                <td><?= h($calenders->plan_id) ?></td>
                <td><?= h($calenders->created) ?></td>
                <td><?= h($calenders->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Calenders', 'action' => 'view', $calenders->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Calenders', 'action' => 'edit', $calenders->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Calenders', 'action' => 'delete', $calenders->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calenders->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Events') ?></h4>
        <?php if (!empty($plan->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Plan Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('AllDay') ?></th>
                <th scope="col"><?= __('Start') ?></th>
                <th scope="col"><?= __('End') ?></th>
                <th scope="col"><?= __('Guest Name') ?></th>
                <th scope="col"><?= __('Guest Email') ?></th>
                <th scope="col"><?= __('Fixed Flag') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($plan->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->user_id) ?></td>
                <td><?= h($events->plan_id) ?></td>
                <td><?= h($events->title) ?></td>
                <td><?= h($events->allDay) ?></td>
                <td><?= h($events->start) ?></td>
                <td><?= h($events->end) ?></td>
                <td><?= h($events->guest_name) ?></td>
                <td><?= h($events->guest_email) ?></td>
                <td><?= h($events->fixed_flag) ?></td>
                <td><?= h($events->created) ?></td>
                <td><?= h($events->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
