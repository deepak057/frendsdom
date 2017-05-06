<div class="card">


<?php


	if(!empty($random_posts)){

	?>


		 <div class="card-body card-padding circle-data-wrap">
      

      <div class="posts-grid-container">
        

		<?php


	
		$this->widget("Postgrid",array("posts"=>$random_posts));
	
		
		
	
		 ?>
	

		</div>
		</div>

	

	<?php



	
	}
	

	?>
	

</div>
