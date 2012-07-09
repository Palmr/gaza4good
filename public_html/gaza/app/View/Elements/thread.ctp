<?php
  $message = $this->requestAction($type.'s/view/'.$id); 
  echo $this->element('message', array(
      "type" => $type,
      "message" => $message[$type],
      "user" => $message['User'],
      "showDetails" => true,
      "viewLink" => false,
      "rootMessage" => true
  ));

  if($type == 'Request')
    $responses = $this->requestAction('Links/forRequest/'.$id);
  else
    $responses = $this->requestAction('Links/forOffer/'.$id);

?>
<div class="responses-info">
  <div class="respond-btn right dropdown">
    <a class="btn <?php echo ($type == 'Request') ? 'btn-success' : 'btn-primary'; ?>  btn-large dropdown-toggle" id="submit-response-button" data-toggle="dropdown" data-target="#" href="#"><i class="<?php echo ($type == 'Request') ? 'icon-ok' : 'icon-exclamation-sign'; ?>  icon-white"></i> I <?php echo ($type == 'Request') ? 'have' : 'need'; ?> this</a>
    <ul class="dropdown-menu dropdown-menu-right">
      <?php 
      //TODO use real user id
      $userId = $this->Session->read('AuthUser')['User']['id'];
      if($userId == null) $userId = 0;
      if($type == 'Request')
        $listOpts = $this->requestAction('Offers/unsatisfiedByUser/'.$userId);
      else
        $listOpts = $this->requestAction('Requests/unsatisfiedByUser/'.$userId);   

      foreach($listOpts as $opt) :
        $opt['Message'] = ($type == 'Request') ? $opt['Offer'] : $opt['Request'];
      ?>
      <li><a href="#" title="<?php echo h($opt['Message']['details']); ?>" onclick="submitExistingResponse(this,'<?php echo $type; ?>'); return false;"><?php echo h($opt['Message']['title']); ?></a></li>
      <?php endforeach; ?>
      <li class="divider"></li>
      <li>
        <form class="form-inline control-group" id="response-form">
          <input type="text" class="input" id="response-text" placeholder="What do you <?php echo ($type == 'Request') ? 'have' : 'need'; ?>?">
          <button class="btn btn-primary" onclick="submitResponse($('#response-text').val(), null, '<?php echo $type; ?>'); return false;">Post</button>
        </form>
      </li>
    </ul>
  </div>
  <h3>
    <span id="response-count"><?php echo count($responses) ?></span> 
    <?php 
      echo (count($responses) == 1) ? 'person' : 'people'; 
      if($type == 'Offer') {
        if(count($responses) == 1) {
          echo ' needs this';
        } else {
          echo ' need this';
        }
      } else {
        if(count($responses) == 1) {
          echo ' has this';
        } else {
          echo ' have this';
        }        
      }
    ?>
  </h3>
</div>
<?php  

  echo $this->element('messageList', array(
      "type" => ($type == 'Request') ? 'Offer' : 'Request',
      "messages" => $responses,
      "showDetails" => true,
      "viewLink" => true
  ));
  
  /*
  $array = $message[$type];
  $locationStr = $array['location'];
  $latlonstr = "";
  
  if ($locationStr != null) {
    $lon = substr($locationStr, strpos($locationStr, ',')+1);
    $lat = substr($locationStr, 0, strpos($locationStr, ','));
    $latlonstr = $lat . ',' . $lon;
  }
?>
<div id="map" style="width: 300px; height: 250px;"></div>
<script type="text/javascript">

var map;

$(window).load(function () {

	var myLatlng = new google.maps.LatLng(<?php echo $latlonstr; ?>);
	var myOptions = {
	  zoom: 5,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  disableDefaultUI: false,
	  scrollwheel: true,
	  draggable: true,
	  navigationControl: true,
	  mapTypeControl: false,
	  scaleControl: true,
	  disableDoubleClickZoom: false
	};
	map = new google.maps.Map(document.getElementById("map"), myOptions);
  
  var marker = new google.maps.Marker({
    position: myLatlng,
    map: map
  });

});
</script>
*/ ?>