<ul class="responses">
<?php foreach ($messages as $message) {
	echo $this->element('message', array(
			"type" => $type,
	    "message" => $message[$type],
	    "user" => $message['User'],
      "showDetails" => $showDetails,
      "viewLink" => $viewLink,
      "rootMessage" => false
	));
} ?>
</ul>

