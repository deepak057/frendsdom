<?php


class PagesController extends CController{


public $layout="landing";


public function filters()
	{
		return array(
			'accessControl', 
			
		);
	}



	/**
	** Access rules for PagesController
	**/

	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('terms','privacy','copyright','contact'),
				'users'=>array('*'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}


/**
** Method to render the given content page
**/

function RenderContentPage($page,$title){

	$this->pageTitle=$title;

	//get content
	$content=$this->renderPartial($page,array(),true);

	$this->render("content",array("content"=>$content));

}


/**
** Render Terms page
**/

function actionTerms(){

	$this->RenderContentPage("terms","Terms and Conditions");
}


/**
** Render Privacy page
**/

function actionPrivacy(){

	$this->RenderContentPage("privacy","Privacy Policy");
}


/**
** Render Privacy page
**/

function actionCopyright(){

	$this->RenderContentPage("copyright","Digital Millennium Copyright Act (DMCA) Compliance");
}


/**
** Render Contact page
**/

function actionContact(){

	$this->RenderContentPage("contact","Contact Us");
}


}




?>