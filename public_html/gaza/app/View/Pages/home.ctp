<div class="span6 front-page-list">
  <h2>Need</h2>
  <?php 
  	$requests = $this->requestAction('Requests/index/sort:id/direction:desc/limit:5'); 
  	echo $this->element('messageList', array(
  			"type" => 'Request',
  	    "messages" => $requests,
        "showDetails" => false,
        "viewLink" => true
  	));
  ?>
</div>
<div class="span6 front-page-list">
  <h2>Have</h2>
  <?php 
    $offers = $this->requestAction('Offers/index/sort:id/direction:desc/limit:5'); 
    echo $this->element('messageList', array(
        "type" => 'Offer',
        "messages" => $offers,
        "showDetails" => false,
        "viewLink" => true
    ));
  ?>
</div>