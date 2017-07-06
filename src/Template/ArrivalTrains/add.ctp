<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des trains type arrivée'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivalTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($arrivalTrain) ?>
    <fieldset>
        <legend><?= __('Nouveau train type arrivée') ?></legend>
        <?php
            echo $this->Form->control('numero', ['class' => 'even']);
			echo '<span id="erreur"> </span>';
			echo '<span id="erreur-numero"> Le numéro doit être pair </span>';
        ?>
		<?= $this->Form->create($theoricArrival) ?>
		<fieldset>
			<legend><?= __('Arrivée théorique') ?></legend>
			<?php
				echo $this->Form->control('paris_nord_arrival', ['label' => __('Arrivée PNO'), 'empty' => true]);
				echo '<label class="landy_calc">'.__('Arrivée Landy').'</label> <span id="landy_calc">--:--</span>';
				echo $this->Form->control('ascent_time', ['label' => __('Temps de montée (en minutes)')]);
			?>
		</fieldset>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script('calc'); ?>