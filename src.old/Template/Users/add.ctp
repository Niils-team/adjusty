<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Calenders'), ['controller' => 'Calenders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Calender'), ['controller' => 'Calenders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Relationships'), ['controller' => 'Relationships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Relationship'), ['controller' => 'Relationships', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('new_email');
            echo $this->Form->input('company_name');
            echo $this->Form->input('company_address');
            echo $this->Form->input('company_dep');
            echo $this->Form->input('company_position');
            echo $this->Form->input('company_url');
            echo $this->Form->input('img_type1');
            echo $this->Form->input('img_type2');
            echo $this->Form->input('password');
            echo $this->Form->input('gcal');
            echo $this->Form->input('activation_code');
            echo $this->Form->input('is_mail');
            echo $this->Form->input('is_active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
