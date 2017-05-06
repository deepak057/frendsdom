  
    <div class="card">
      
      <div class="circle-data-header card-header bgm-blue">
	
	<?php $this->Widget("Circleicon",array("circle"=>$circle)); ?>
        <h2 class="inline-block">

	<a title="Go to this Circle's page" class="c-white" href="<?php echo AppURLs::CircleURL($circle->id); ?>"><?php
	
          echo ucwords($circle->title);

		 ?></a>
        
        <small>
          Activities on this circle.
        </small>
        
      </h2>
      


<?php if($is_part){ ?>
<div class="dropdown">

        <!--<button title="Add people to this Circle" aria-expanded="false" class="bgm-blue btn-float waves-effect manage-circle-trigger no-border" cid="<?php echo $circle->id; ?>">
          

<i class="md md-add">
          </i>

        </button>
-->


        <button title="Add a Post" aria-expanded="false" class="btn-float btn-info fix-float-btn waves-effect add-post-trigger no-border bgm-white" cid="<?php echo $circle->id; ?>">
          

<i class="md md-add">
          </i>

        </button>
</div>

<?php } ?>



    </div>
    
    <div class="card-body card-padding circle-data-wrap">
      

      <div class="posts-grid-container">
        
        

  <?php 


if($posts){


		$this->widget("Postgrid",array("posts"=>$posts));
          
   

}


else {

?>

<div class="center no-posts-msg italic-text m-b-20"><h2>No posts in this circle yet<br/><span class="pointer-origin">Be the first to create a post here.</span></h2></div>


<?php

}


?>
                
        
        
      </div>
      
    
    </div><div class="clearfix">
    
    </div>