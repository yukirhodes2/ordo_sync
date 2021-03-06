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
                ['action' => 'delete', $trainSetRelease->id],
                ['confirm' => __('Voulez-vous vraiment supprimer cette libération de rame ?')]
            )
        ?></li>
        <li><?= $this->Html->link(__('Liste des libérations de rame'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="trainSetReleases form large-9 medium-8 columns content">
    <?= $this->Form->create($trainSetRelease) ?>
    <fieldset>
        <legend><?= __('Editer une libération de rame') ?></legend>
        <?php
			echo $this->Form->control('train_set_id', ['options' => $trainSets, 'label' => 'Rame']);
            echo $this->Form->control('release1_id', ['label' => 'Libération arrivée', 'options' => $releases, 'empty' => ['' => '']]);
			echo $this->Form->control('status1_id', ['label' => 'Statut arrivée', 'options' => $status, 'empty' => ['' => '']]);
			
            echo $this->Form->control('release2_id', ['label' => 'Libération départ', 'options' => $releases, 'empty' => ['' => '']]);
            echo $this->Form->control('status2_id', ['label' => 'Statut départ', 'options' => $status, 'empty' => ['' => '']]);
			
	
		?>
			<span class='msg-alerte'>L'heure de libération sera supprimée.</span>
			
		<script>
			$(document).ready(function(){		
				var f_verif = function(){
					if ($('#status2-id option:selected').val()==1) 
						$('.msg-alerte').hide(); 
					else
						$('.msg-alerte').show();
					}

				f_verif();
				$("div.input.select:last").css("display", "inline");
				$('#status2-id').change(f_verif);
			});
		</script>
		
		<?php
            echo $this->Form->control('comment', ['type' => 'textarea', 'label' => 'Observations']);
			
			if ($trainSetRelease->status2_id === 1){
				echo $this->Form->control('heure', ['label' => 'Heure de libération']);
				echo $this->Form->button($this->Html->image('datetime.png', ['alt' => 'Maintenant', 'class' => 'icon']), ['title' => 'Remplir avec l\'heure actuelle', 'type' => 'button', 'onclick' => "currentTime('heure')"]);
				echo '<br/>';
			}
			else{
				echo "Note : L'heure de la libération ne peut pas être saisie tant que le statut départ n'est pas DEX.";
			}
        ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer')) ?>
    <?= $this->Form->end() ?>
</div>
