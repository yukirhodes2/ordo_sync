<div class="grid-6-small-2 has-gutter">
  <div class="one-quarter"></div>
  <div class="one-half">
<?php 
	$redirect = null;
	if (isset($_GET['redirect'])){
		$redirect = h($_GET['redirect']);
	} ?>
	<?= $this->Form->create(null, [
	'url' => ['controller' => 'users', 'action' => 'login', '?' => ['redirect' => $redirect]]]) ?>
		<p class="form-group">
		  <label class="form-label" for="a51i">
			<span class="form-label-txt">Identifiant</span>
			<span class="form-field-wrapper">
			  <input name="username" type="text" class="form-field" id="a51i" placeholder="Identifiant unique ou numéro de CP">
			</span>
		  </label>
		</p>
		<p class="form-group">
		  <label class="form-label" for="a51i">
			<span class="form-label-txt">Mot de passe</span>
			<span class="form-field-wrapper">
			  <input name="password" type="password" class="form-field" id="a51j" placeholder="Veuillez entrer votre mot de passe">
			</span>
		  </label>
		</p>
		<button type="submit" class="btn btn-blue">Se connecter</button>
	<?= $this->Form->end() ?>
	
	
  </div>
  <div class="one-quarter"></div>
</div>