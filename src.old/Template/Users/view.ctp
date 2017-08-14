<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Calenders'), ['controller' => 'Calenders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Calender'), ['controller' => 'Calenders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Relationships'), ['controller' => 'Relationships', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Relationship'), ['controller' => 'Relationships', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('New Email') ?></th>
            <td><?= h($user->new_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($user->company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Dep') ?></th>
            <td><?= h($user->company_dep) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Position') ?></th>
            <td><?= h($user->company_position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Img Type1') ?></th>
            <td><?= h($user->img_type1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Img Type2') ?></th>
            <td><?= h($user->img_type2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gcal') ?></th>
            <td><?= h($user->gcal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Mail') ?></th>
            <td><?= $this->Number->format($user->is_mail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($user->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Company Address') ?></h4>
        <?= $this->Text->autoParagraph(h($user->company_address)); ?>
    </div>
    <div class="row">
        <h4><?= __('Company Url') ?></h4>
        <?= $this->Text->autoParagraph(h($user->company_url)); ?>
    </div>
    <div class="row">
        <h4><?= __('Activation Code') ?></h4>
        <?= $this->Text->autoParagraph(h($user->activation_code)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Calenders') ?></h4>
        <?php if (!empty($user->calenders)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Plan Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->calenders as $calenders): ?>
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
        <?php if (!empty($user->events)): ?>
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
            <?php foreach ($user->events as $events): ?>
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
    <div class="related">
        <h4><?= __('Related Plans') ?></h4>
        <?php if (!empty($user->plans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Memo') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->plans as $plans): ?>
            <tr>
                <td><?= h($plans->id) ?></td>
                <td><?= h($plans->user_id) ?></td>
                <td><?= h($plans->title) ?></td>
                <td><?= h($plans->memo) ?></td>
                <td><?= h($plans->code) ?></td>
                <td><?= h($plans->is_active) ?></td>
                <td><?= h($plans->created) ?></td>
                <td><?= h($plans->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Plans', 'action' => 'view', $plans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Plans', 'action' => 'edit', $plans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Plans', 'action' => 'delete', $plans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Relationships') ?></h4>
        <?php if (!empty($user->relationships)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Host Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->relationships as $relationships): ?>
            <tr>
                <td><?= h($relationships->id) ?></td>
                <td><?= h($relationships->user_id) ?></td>
                <td><?= h($relationships->host_id) ?></td>
                <td><?= h($relationships->created) ?></td>
                <td><?= h($relationships->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Relationships', 'action' => 'view', $relationships->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Relationships', 'action' => 'edit', $relationships->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Relationships', 'action' => 'delete', $relationships->id], ['confirm' => __('Are you sure you want to delete # {0}?', $relationships->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
