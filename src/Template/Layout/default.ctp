<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$title = 'ORDONNANCEMENT';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	

	<?= $this->Html->script('jquery-3.2.0.min.js'); ?>
	<?= $this->Html->script('accessible-megamenu'); ?>
	<?= $this->Html->script('accordions'); ?>
	<?= $this->Html->script('anchors'); ?>
	<?= $this->Html->script('fold'); ?>
	<?= $this->Html->script('hammer'); ?>
	<?= $this->Html->script('help-message'); ?>
	<?= $this->Html->script('megamenu'); ?>
	<?= $this->Html->script('modules'); ?>
	<?= $this->Html->script('off-canvas'); ?>
	<?= $this->Html->script('slider'); ?>
	<?= $this->Html->script('slideshow'); ?>
	<?= $this->Html->script('tabs'); ?>
	<?= $this->Html->script('perso'); ?>
	
	<?= $this->Html->css(
	['sncf',
	'00-config',
	'helpers',
	'perso',]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div class="sg-navbar-desktop-scroll"><div class="sg-navbar-desktop">

  <div class="navbar">
    <div class="galactic-bar">
      <div class="galactic-menu">
        <p class="galactic-menu-home">
          <a class="galactic-menu-home-link" href="/ordo">
			<?= $this->Html->image('logo-sncf.png', ['alt' => 'SNCF', 'class' => 'galactic-menu-home-img']); ?>
			<span class="galactic-menu-home-text">
			<?php
				if ($this->request->session()->read('Auth.User.id')){
					echo $this->request->session()->read('Auth.User.username');
				}else{
					echo $title;
				}?>
			</span>
          </a>
        </p>
      </div>

      <!-- Galactic widgets: -->
      <div class="galactic-widgets">
        <!-- Galactic search form: -->
		<!--
        <div class="galactic-search">
           <form>
             <label class="galactic-search-label">
               <span class="galactic-search-label-txt">Recherche</span>
               <span class="galactic-search-field-wrapper">
                 <input type="text" class="galactic-search-field" id="formsearch" placeholder="Recherche">
                 <button class="galactic-search-submit-btn"><span class="visually-hidden">Lancer la recherche</span></button>
               </span>
             </label>
           </form>
        </div>
		-->

        <!-- Galactic nav: -->
        <ul class="galactic-menu-list">
          <li class="galactic-menu-item">
            <?= $this->Html->link('Aide', ['controller' => '#', 'action' => ''], ['class' => 'galactic-menu-link']); ?>   
		
          </li>
          <li class="galactic-menu-item">
		<?php
		if ($this->request->session()->read('Auth.User.id')) {
			echo $this->Html->link('Deconnexion', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'galactic-menu-link']);        
		}
		else{
			echo $this->Html->link('Se connecter', ['controller' => 'Users', 'action' => 'login'], ['class' => 'galactic-menu-link']);
		}
		?>
          </li>
        </ul>

      </div><!-- /galactic-widgets -->
    </div><!-- /sncf-galactic-bar -->
  </div><!-- /navbar -->

  <!-- Site Header --->
  <header class="header">
    <div class="header-inner">
      <div class="header-title-wrapper">
        <div class="header-title"><?= $title ?></div>
        <!-- these buttons are visible only on mobile: -->
        <button class="header-btn-burger js-menuburger" data-target=".navigation" data-selector-off-canvas=".js-content-off-canvas"><span class="visually-hidden">Ouvrir le menu</span></button>
        <a href="#" class="header-btn-search"><span class="visually-hidden">Recherche</span></a>
        <a href="#" class="header-btn-user"><span class="visually-hidden">Mon compte</span></a>
      </div><!-- /header-title-wrapper -->

      <nav role="navigation" class="navigation js-accessible-navigation"><!-- .js-accessible-navigation to activate the Mega Menu -->
        <ul class="navigation-list">
          <li class="navigation-list-item">
            <a href="#" class="navigation-list-link item-1">Opérations</a>
            <div class="mega-navigation">
              <div class="mega-navigation-inner">
                <div class="mega-navigation-col col-1">
                  <p class="mega-navigation-title">Arrivées</p>
                  <ul class="mega-navigation-list">
                    <li class="mega-navigation-item">
					  <?= $this->Html->link('Consultation arrivées', ['controller' => 'Arrivals', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    </li>
             
                  </ul>
                </div><!-- /mega-navigation-col -->
                <div class="mega-navigation-col col-2">
                  <p class="mega-navigation-title">Départs</p>
                  <ul class="mega-navigation-list">
                    <li class="mega-navigation-item">
					  <?= $this->Html->link('Consultation départs', ['controller' => 'Departures', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    </li>
                   
                  </ul>
                </div><!-- /mega-navigation-col -->
				
				<div class="mega-navigation-col col-2">
                  <p class="mega-navigation-title">Libérations de rame</p>
                  <ul class="mega-navigation-list">
					<li class="mega-navigation-item">
                      <?= $this->Html->link('Consulter libérations', ['controller' => 'TrainSetReleases', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    </li>
                  </ul>
                </div><!-- /mega-navigation-col -->
           
              </div><!-- /mega-navigation-inner -->
            </div><!-- /mega-navigation -->
          </li>
          <li class="navigation-list-item sncf-color-plum"><!-- @TOPROD: see 1.1 Colors for the others CSS class -->
            <a href="#" class="navigation-list-link item-2">Trains</a>
			<div class="mega-navigation">
              <div class="mega-navigation-inner">
                <div class="mega-navigation-col col-1">
                  <p class="mega-navigation-title">Trains</p>
                  <ul class="mega-navigation-list">
                    <li class="mega-navigation-item">
                      <?= $this->Html->link('Liste des trains', ['controller' => 'Trains', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                  
                    </li>
                  </ul>
                </div><!-- /mega-navigation-col -->
                <div class="mega-navigation-col col-2">
                  <p class="mega-navigation-title">Rames</p>
                  <ul class="mega-navigation-list">
                    <li class="mega-navigation-item">
                      <?= $this->Html->link('Liste des rames', ['controller' => 'TrainSets', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    </li>
                  </ul>
                </div><!-- /mega-navigation-col -->
           
              </div><!-- /mega-navigation-inner -->
            </div><!-- /mega-navigation -->
          </li>
          <li class="navigation-list-item sncf-color-raspberry"><!-- @TOPROD: see 1.1 Colors for the others CSS class -->
            <a href="#" class="navigation-list-link item-3">Définitions</a>
			<div class="mega-navigation">
              <div class="mega-navigation-inner">
                <div class="mega-navigation-col col-1">
                  <p class="mega-navigation-title">Fonctionnelle</p>
                  <ul class="mega-navigation-list"><!--
					<li class="mega-navigation-item">
                      <a href="/alerts" class="mega-navigation-link">Alertes</a>
                    </li> -->
                    <li class="mega-navigation-item">
                      <?= $this->Html->link('Types de frein', ['controller' => 'Brakes', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    </li>
                    <li class="mega-navigation-item">
                      <?= $this->Html->link('Types de retard', ['controller' => 'Delays', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    
                    </li>
					<li class="mega-navigation-item">
                      <?= $this->Html->link('Voies', ['controller' => 'Ways', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    
                    </li>
					<li class="mega-navigation-item">
                      <?= $this->Html->link('MAL', ['controller' => 'Lavages', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    
                    </li>
                  </ul>
                </div><!-- /mega-navigation-col -->
				
				<div class="mega-navigation-col col-1">
                  <p class="mega-navigation-title">Etatique</p>
                  <ul class="mega-navigation-list">
					<li class="mega-navigation-item">
                      <?= $this->Html->link('Statuts', ['controller' => 'Status', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    
                    </li>
					<li class="mega-navigation-item">
                      <?= $this->Html->link('Libérations de produit', ['controller' => 'Releases', 'action' => 'index'], ['class' => 'mega-navigation-link']); ?>
                    
                    </li>
                  </ul>
                </div><!-- /mega-navigation-col -->
           
              </div><!-- /mega-navigation-inner -->
            </div><!-- /mega-navigation -->
          </li>
          <li class="navigation-list-item sncf-color-purple"><!-- @TOPROD: see 1.1 Colors for the others CSS class -->
			<?= $this->Html->link('Gestion des comptes', ['controller' => 'Users', 'action' => 'index'], ['class' => 'navigation-list-link item-4']); ?>
                    
          </li>
		  
        </ul>
      </nav>
    </div>
	
  </header>

</div></div>
<ul>
		  <li id="warning">
		  </li></ul>

    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
	
	
    <footer id="footer" class="footer" role="contentinfo">
  <!-- <div id="footer-illustrated" class="footer-illustrated">
    <ul class="footer-illustrated-list">
      <li class="footer-illustrated-item">
        <a href="#" class="footer-illustrated-link">
          <img src="../img/footer/download-sncf-32x32.png" height="32" width="32" alt="" class="footer-illustrated-img">
          <p class="footer-illustrated-content">
            <span class="footer-illustrated-txt1">
              Lorem ipsum
              <span class="footer-illustrated-txt1-alt">dolor</span>
            </span>
            <span class="footer-illustrated-txt2">sit amet, consectetur</span>
          </p>
        </a>
      </li>
      <li class="footer-illustrated-item">
        <a href="#" class="footer-illustrated-link">
          <img src="../img/footer/disc-beta-32x32.png" height="32" width="32" alt="" class="footer-illustrated-img">
          <p class="footer-illustrated-content">
            <span class="footer-illustrated-txt1">
              Lorem ipsum
              <span class="footer-illustrated-txt1-alt">dolor</span>
            </span>
            <span class="footer-illustrated-txt2">sit amet, consectetur</span>
          </p>
        </a>
      </li>
      <li class="footer-illustrated-item">
        <a href="#" class="footer-illustrated-link">
          <img src="../img/footer/speech-bubble-32x32.png" height="32" width="32" alt="" class="footer-illustrated-img">
          <p class="footer-illustrated-content">
            <span class="footer-illustrated-txt1">
              Lorem ipsum
              <span class="footer-illustrated-txt1-alt">dolor</span>
            </span>
            <span class="footer-illustrated-txt2">sit amet, consectetur</span>
          </p>
        </a>
      </li>
    </ul>
  </div> --> <!-- /.footer-illustrated -->
  <div class="footer-inner">
    <div class="footer-primary">
      <ul class="footer-primary-list">
        <li class="footer-primary-item first">
          <a class="footer-primary-link" href="https://www.int.sncf.fr/" onclick="ga('send', 'event', 'Outbound links', 'Click', 'https://www.int.sncf.fr/')">
            <span>
              <span>Intranet SNCF</span><!-- Not in uppercase in HTML code (except if it's really a word in uppercase like "SNCF"). It'll be styled by CSS -->
            </span>
          </a>
        </li><!-- @TOPROD no whitespace
        --><li class="footer-primary-item">
          <a class="footer-primary-link" href="http://digital.sncf.com" onclick="ga('send', 'event', 'Outbound links', 'Click', 'http://digital.sncf.com')">
            <span>
              <span>Communauté digitale SNCF</span>
            </span>
          </a>
        </li><!-- @TOPROD no whitespace
        --><li class="footer-primary-item last">
          <a class="footer-primary-link" href="http://www.sncf.com/identite" onclick="ga('send', 'event', 'Outbound links', 'Click', 'http://www.sncf.com/identite')">
            <span>
              <span>Identité de la marque</span>
            </span>
          </a>
        </li>
      </ul>
    </div>
    <div class="footer-secondary">
      <ul class="footer-secondary-list">
        <li class="footer-secondary-item first">
          <a class="footer-secondary-link" href="http://www.sncf.com/fr/mentions-legales" onclick="ga('send', 'event', 'Outbound links', 'Click', 'http://www.sncf.com/fr/mentions-legales')">
            <span>
              <span>Mentions légales</span><!-- Not in uppercase in HTML code (except if it's really a word in uppercase like "SNCF"). It'll be styled by CSS -->
            </span>
          </a>
        </li><!-- @TOPROD no whitespace
        --><li class="footer-secondary-item last">
          <a class="footer-secondary-link" href="mailto:laurent.candio@sncf.fr" onclick="ga('send', 'event', 'Outbound links', 'Click', 'mailto:laurent.candio@sncf.fr')">
            <span>
              <span>Contact Informatique</span>
            </span>
          </a>
        </li>
      </ul>
    </div>
	
	<div class="footer-secondary">
      <ul class="footer-secondary-list">
		<h3> Design </h3>
        <li class="footer-secondary-item first">
          <a class="footer-secondary-link" href="https://www.digital.sncf.com/" onclick="ga('send', 'event', 'Outbound links', 'Click', 'https://www.digital.sncf.com/')">
            <span>
              <span>Digital SNCF</span><!-- Not in uppercase in HTML code (except if it's really a word in uppercase like "SNCF"). It'll be styled by CSS -->
            </span>
          </a>
        </li><!-- @TOPROD no whitespace
        --><li class="footer-secondary-item last">
          <a class="footer-secondary-link" href="#" >
            <span>
              <span>William Sha</span>
            </span>
          </a>
        </li>
		<li class="footer-secondary-item last">
          <a class="footer-secondary-link" href="#" >
            <span>
              <span>Alexandre Mezned</span>
            </span>
          </a>
        </li>
		<li class="footer-secondary-item last">
          <a class="footer-secondary-link" href="http://fr.freepik.com/" onclick="ga('send', 'event', 'Outbound links', 'Click', 'http://fr.freepik.com/')">
            <span>
              <span>Freepik</span>
            </span>
          </a>
        </li>
      </ul>
    </div>
	
  </div>
</footer> <!-- /.footer -->

</body>
</html>
