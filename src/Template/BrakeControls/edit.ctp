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
                ['action' => 'delete', $brakeControl->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette donnée # {0}?', $brakeControl->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des contrôles de freinage'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="brakeControls form large-9 medium-8 columns content">
    <?= $this->Form->create($brakeControl) ?>
    <fieldset>
        <legend><?= __('Editer le contrôle de freinage') ?></legend>
        <?php
            echo $this->Form->control('departure_id', ['options' => $departures, 'label' => 'Départ']);
            echo $this->Form->control('present_id', ['options' => $presents, 'label' => 'Présent']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
