<?php
   
	include("environment.php");
   
   //compressing HTML content 
   //ob_start("ob_gzhandler"); 
   
   ?>
<!doctype html>
<html>
   <head>
      <link rel="icon" href="<?php echo get_image("favicon.ico"); ?>">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <META HTTP-EQUIV="Content-Language" Content="en">
      <meta name="keywords" content="frendsdom,social network,social networking,social web application,new social networking,new social network,have fun,new social web application,top social networking,best social networking,top social network" />
      <meta name="description" content="social web application,sign up,log in" />
      <title>Copyright Act- Frendsdom</title>
      <link rel="stylesheet" type="text/css" href="css8.css"/>
      <link rel="stylesheet" type="text/css" href="main_stylesheet.css"/>
      <script src="jquery-1.4.js" type="text/javascript"></script><script src="script.js" type="text/javascript"></script><script type="text/javascript" src="jquery.monnaTip.js"></script>
      <script type="text/javascript" src="main_script.js"></script>
   </head>
   <body>
      <?php 
         //insert google analytic code
         include($ga_file); 
         
         get_header_1();
         
         ?>
      <div class="center">
      <div class="page-caption">Digital Millennium Copyright Act (DMCA) Compliance</div>

<div class="policies-container site_width centered left">


<h1>Digital Millennium Copyright Act (DMCA) Compliance</h1>
<p>
    Frendsdom abides by the federal Digital Millennium Copyright Act (DMCA) by responding to notices of alleged infringement that comply with the DMCA and other applicable laws. As part of our response, we may remove or disable access to material residing on a site that is controlled or operated by Frendsdom (such as <a href="<?php echo SITE_URL; ?>"><?php echo SITE_URL; ?></a>) that is claimed to be infringing, in which case we will make a good-faith attempt to contact the person who submitted the affected material so that they may make a counter notification, also in accordance with the DMCA.</p>
<p>Frendsdom does not control content hosted on third party websites, and cannot remove content from sites it does not own or control. If you are the copyright owner of content hosted on a third party site, and you have not authorized the use of your content, please contact the administrator of that website directly to have the content removed.  </p>
<p>Before serving either a Notice of Infringing Material or Counter-Notification, you may wish to contact a lawyer to better understand your rights and obligations under the DMCA and other applicable laws. The following notice requirements are intended to comply with Frendsdom's rights and obligations under the DMCA and, in particular, section 512(c), and do not constitute legal advice.</p>
<p><strong>NOTICE TO COPYRIGHT OWNERS:
    </strong><br />
  If you believe material posted on or linked to or from this site is infringing, please provide a written, signed notice of infringement (a "DMCA Notice") to the designated agent at the Frendsdom, by fax or mail, at the address provided on our <a href="<?php echo SITE_URL."/contact.php"; ?>">contact page</a>. Such DMCA Notice should be in the form set forth below, which is consistent with the form suggested by the United States Digital Millennium Copyright Act (the "DMCA").</p>
<p> Pursuant to federal law you may be held liable for damages and attorneys' fees if you make any material misrepresentations in a Notification. Thus, if you are not sure whether content located on or accessible via a link from the Website infringes your copyright, you should contact an attorney.    </p>
<p><strong>All Notifications should include the following:    </strong></p>
<ul>
  <li>A physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
  <li>Identification of the copyrighted work claimed to have been infringed, or, if multiple copyrighted works at a single online site are covered by a single notification, a representative list of such works at that site.</li>
  <li> Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit the service provider to locate the material.    </li>
  <li>Information reasonably sufficient to permit the service provider to contact the complaining party, such as an address, telephone number, and, if available, an electronic mail address at which the complaining party may be contacted.    </li>
  <li>A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law.
    A statement that the information in the notification is accurate, and under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.    </li>
</ul>
<p>Notifications should be sent to the address shown on our <a href="<?php echo SITE_URL."/contact.php"; ?>">contact page</a>.</p>
<p><strong>Please note: The DMCA provides that you may be liable for damages (including costs and attorneys' fees) if you make a false or bad faith allegation of copyright infringement by using this process. If you are not sure what your rights are, or whether a copyright has been infringed, you should check with a legal advisor first.</strong></p>


</div>

</div>

      <?php get_footer_1(); ?>
   </body>
</html>
