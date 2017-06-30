<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des libérations de rame'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="trainSetReleases form large-9 medium-8 columns content">
    <?= $this->Form->create($trainSetRelease) ?>
    <fieldset>
        <legend><?= __('Nouvelle libération de rame') ?><?php if (isset($train_set)){echo ' '.$train_set['numero'];} ?></legend>
       <?php
			echo $this->Form->control('train_set_id', ['options' => $trainSets, 'label' => 'Rame']);
            echo $this->Form->control('release1_id', ['label' => 'Libération arrivée', 'options' => $releases, 'empty' => true]);
			echo $this->Form->control('status1_id', ['label' => 'Statut arrivée', 'options' => $status, 'empty' => true]);
			
            echo $this->Form->control('release2_id', ['label' => 'Libération départ', 'options' => $releases, 'empty' => true]);
            echo $this->Form->control('status2_id', ['label' => 'Statut départ', 'options' => $status, 'empty' => true]);
			
			echo $this->Form->control('comment', ['label' => 'Observations', 'type' => 'textarea']);

			if ($trainSetRelease->status2_id === 1){
				echo $this->Form->control('heure');
			}
			else{
				echo "<p>Note : L'heure de la libération ne peut pas être saisie tant que le statut départ n'est pas DEX.</p>";
			}
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
