<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des alertes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="alerts form large-9 medium-8 columns content">
    <?= $this->Form->create($alert) ?>
    <fieldset>
        <legend><?= __('Editer alerte '.$alert->libelle) ?></legend>
		
        <?php
			echo '<p> Les minuteurs sont exprimés en <span class="sncf-color-plum">minutes</span>. </p>';
            echo $this->Form->control('first_timer', ['label' => 'Minuteur départ/arrivée']);
            echo $this->Form->control('second_timer', ['label' => 'Minuteur rendu']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
