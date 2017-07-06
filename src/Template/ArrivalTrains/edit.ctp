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
                ['action' => 'delete', $arrivalTrain->id],
                ['confirm' => __('Voulez-vous vraiment supprimer ce train ?', $arrivalTrain->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des trains type arrivée'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivalTrains form large-9 medium-8 columns content">
    <?= $this->Form->create($arrivalTrain) ?>
    <fieldset>
        <legend><?= __('Editer train type arrivée') ?></legend>
        <?php
            echo $this->Form->control('numero');
        ?>
		<?= $this->Form->create($theoricArrival) ?>
		<?php
			echo $this->Form->control('paris_nord_arrival', ['label' => __('Arrivée PNO')]);
			echo '<label class="landy_calc">'.__('Arrivée Landy').'</label> <span id="landy_calc">--:--</span>';
			echo $this->Form->control('ascent_time', ['label' => __('Temps de montée (en minutes)')]);
		?>
    </fieldset>
    <?= $this->Form->button(__('Valider')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script('calc'); ?>