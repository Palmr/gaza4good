<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php echo $this->Html->charset(); ?>
    <title>gaza4good</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/gz4gd.css"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="/js/gz4gd.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="/js/heatmap.js"></script>
    <script type="text/javascript" src="/js/heatmap-gmaps.js"></script>
<?php
/*
    <title>
      <?php echo $cakeDescription ?>:
      <?php echo $title_for_layout; ?>
    </title>
    <?php
      echo $this->Html->meta('icon');

      echo $this->Html->css('cake.generic');

      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');
    ?>
*/
?>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8" style="text-align: right">
          <?php echo $this->element('userActions'); ?>
        </div>
        <div class="span2"></div>
      </div>
      <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
          <div class="row-fluid">
            <div class="span4">
              <h1><a href="/"><img src="/img/logo.png" alt="gaza4good"/></a></h1>
            </div>
            <div class="span8" id="main-menu">
              <a href="/Offers/create">I Have Something</a> / <a href="/Requests/create">I Need Something</a>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
              <?php echo $this->Session->flash(); ?>
              <?php echo $this->fetch('content'); ?>
            </div>
          </div>
        </div>
        <div class="span2"></div>
      </div>
    </div>
  </body>
</html>

