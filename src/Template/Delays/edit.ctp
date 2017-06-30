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
                ['action' => 'delete', $delay->id],
                ['confirm' => __('Voulez-vous vraiment supprimer ce type de retard ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des types de retard'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="delays form large-9 medium-8 columns content">
    <?= $this->Form->create($delay) ?>
    <fieldset>
        <legend><?= __('Édition du type de retard') ?></legend>
        <?php
            echo $this->Form->control('libelle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
