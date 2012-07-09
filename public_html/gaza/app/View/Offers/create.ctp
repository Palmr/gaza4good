<h2>Post an Offer</h2>
<p class="lead">
	Tell us what you have, and any other details that might be useful - like where you are and when it's available until. We'll tweet you if anyone responds.
</p>


<div class="row-fluid">
	<div class="span2"></div>
	  <div class="span8">
	    <?php echo $this->Form->create('Offer', array('class' => 'form-horizontal')); ?>
	      <fieldset>
	      	<!-- TODO use real user id -->
	      	<?php echo $this->Form->input('user_id', array( 'label' => false, 'type' => 'hidden', 'value' => $this->Session->read('AuthUser')['User']['id'])); ?>
	        <div class="control-group">
	          <label class="control-label" for="data[Offer][title]">What do you have?</label>
	          <?php echo $this->Form->input('title', array( 'label' => false, 'div' => 'controls')); ?>
	        </div>
	        <div class="control-group">
	          <label class="control-label" for="data[Offer][deadline][day]">When is it available until?</label>
	          <?php echo $this->Form->input('deadline', array( 'label' => false, 'type' => 'date', 'minYear' => date('Y'), 'maxYear' => date('Y')+5, 'div' => 'controls')); ?>
	        </div>	        
	        <div class="control-group">
	          <label class="control-label" for="data[Offer][details]">Any more details?</label>
	          <?php echo $this->Form->input('details', array( 'label' => false, 'type' => 'textarea', 'rows' => 5, 'cols' => 40, 'div' => 'controls')); ?>
	        </div>  
	        <div class="control-group">
	          <label class="control-label" for="data[Offer][tags]">Tags - separate with commas, eg computer, laptop, electronics</small></label>
	          <?php echo $this->Form->input('tags', array( 'label' => false, 'div' => 'controls')); ?>
	        </div>       
	      </fieldset>
        <div class="form-actions">
        	<?php echo $this->Form->end(array('label'=> 'Post', 'class' => 'btn btn-primary')); ?>  
        </div>  	      
	  </div>
	<div class="span2"></div>
</div>
