 <body class="circles-back-img <?php if($minimal_layout) echo "demo-page"; ?>">

	<?php
	//render navigation
	$this->widget("Navbar");


	?>
	        
        <section id="main">

            <?php 
		
		//render side bar
		$this->widget('Sidebar'); 

		?>            
          
	
            
            
            <section id="content">
                <div class="container">
                <?php echo $content; ?>
                </div>
            </section>
        </section>
        
        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">IE SUCKS!</h1>
                <p>You are using an outdated version of Internet Explorer, upgrade to any of the following web browser <br/>in order to access the maximum functionality of this website. </p>
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="img/browsers/chrome.png" alt="">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="img/browsers/firefox.png" alt="">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="img/browsers/safari.png" alt="">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                            <div>IE (New)</div>
                        </a>
                    </li>
                </ul>
                <p>Upgrade your browser for a Safer and Faster web experience. <br/>Thank you for your patience...</p>
            </div>   
        <![endif]-->
        

        
    
  <div class="flot-tooltip"></div><div class="flot-tooltip"></div><div style="width: 5px; z-index: auto; cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; display: block; opacity: 0;" class="nicescroll-rails nicescroll-rails-vr" id="ascrail2000"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 5px; height: 252px; background-color: rgba(0, 0, 0, 0.3); border: 0px none; background-clip: padding-box; border-radius: 0px;"></div></div><div style="height: 5px; z-index: auto; position: fixed; left: 0px; width: 100%; bottom: 0px; cursor: default; display: none; opacity: 0;" class="nicescroll-rails nicescroll-rails-hr" id="ascrail2000-hr"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 5px; width: 1600px; background-color: rgba(0, 0, 0, 0.3); border: 0px none; background-clip: padding-box; border-radius: 0px;"></div></div>
</body>
