<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Liste des arrivées'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="arrivals form large-9 medium-8 columns content">
    <?= $this->Form->create($arrival) ?>
    <fieldset>
        <legend><?= __('Ajouter une arrivée') ?></legend>
		<p> Vérifiez <span class="sncf-color-plum"> attentivement </span> la date et l'heure réelle de votre arrivée. </p>
        <?php
		
			$id_role = $this->request->session()->read('Auth.User.role_id');
		
			echo $this->Form->control('landy_arrival', ['required' => true, 'label' => 'Arrivée au Landy', 'empty' => true]);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('landy_arrival')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('landy_arrival')"]);
            echo '<br/>';
            echo $this->Form->control('train_id', ['options' => $arrivalTrains, 'label' => 'Train', 'empty' => true, 'required' => true]);
			 echo $this->Form->control('way_id', ['options' => $ways, 'label' => 'Voie', 'empty' => true, 'required' => true]);
			echo $this->Form->control('loc_id', ['label' => 'Loc', 'options' => $trainSets, 'empty' => ['' => '']]);
            echo $this->Form->control('train_set1_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 1']);
            echo $this->Form->control('train_set2_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 2']);
            echo $this->Form->control('train_set3_id', ['options' => $trainSets, 'empty' => true, 'label' => 'Rame 3']);
			
			$options = array('T' => 'Tire', 'P' => 'Pousse');
			echo $this->Form->radio('push_pool', $options);
					
			if ($id_role === 3) // RLP
				echo $this->Form->control('comment_rlp', ['label' => 'Observations', 'type' => 'textarea']);
	
			elseif ($id_role === 5) // EIC
				echo $this->Form->control('comment_eic', ['label' => 'Observations', 'type' => 'textarea']);
			
            // echo $this->Form->control('protection_time', ['empty' => true, 'label' => 'Heure de protection', 'value'=>date('Y-m-d')]);
			
            echo $this->Form->control('lavage_id', ['options' => $lavages, 'empty' => true, 'label' => 'MAL']);   

			echo $this->Form->control('announcement_time', ['empty' => true, 'label' => 'Heure d\'annonce']);
			echo $this->Form->button($this->Html->image('clear.png', ['alt' => 'Effacer', 'class' => 'icon']), ['title' => 'Effacer', 'type' => 'button', 'onclick' => "emptyTime('announcement_time')"]);
			echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('announcement_time')"]);
            echo '<br/>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
<script> emptyTime();</script>
