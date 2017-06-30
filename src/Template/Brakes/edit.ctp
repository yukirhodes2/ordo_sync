<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Supprimer'),
                ['action' => 'delete', $brake->id],
                ['confirm' => __('Voulez-vous vraiment supprimer ce freinage ?', $brake->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des freinages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="brakes form large-9 medium-8 columns content">
    <?= $this->Form->create($brake) ?>
    <fieldset>
        <legend><?= __('Editer le freinage') ?></legend>
        <?php
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
