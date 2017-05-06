<?php

//Basic app configuration
$app_config=array(

//site admin's email
"admin_url"=>"deepak057@yahoo.com", 
"admin_email"=>"deepak057@yahoo.com",

//Default options for Post Questions 
"post_default_options"=>array(

	/*array("id"=>1,"name"=>"True"),
	array("id"=>2,"name"=>"False"),
	array("id"=>3,"name"=>"Not Sure"),*/


	),

//Configuration for different kind of dynamically created directories
"directories"=>array(

	"uploads"=>"uploads",
	"post_images"=>"post_images",
	"circle_images"=>"circle_images",
	"profile_pictures"=>"profile_pictures"

	),

//configuration for customizing "Posts Feed"
"posts_grid"=>array(

	"column"=>3,
	"posts_per_page"=>10

	),


//Configuration for default "count" for different modules
"default_count"=>array(

	"comments_count"=>3, //Max number of comments to be shown by default on a post
	"search_items_per_page"=>15, //Number of search items per page
	"max_allowed_options"=>20, //Max number of options that can be added in a post
	"circle_title_length"=>10, //Max number of characters allowed in a circle's title
	"profile_bio_max_len"=>140, //Max number of characters allowed in Profile Bio
	"dashboard_circle_width"=>146.3, //the width of a Circle including its margin 
	"circles_in_trending"=>8,
	"demo_posts"=>15, //number of random posts to be shown on Demo page

	),

"colors"=>array(

"cyan",
"red",
"orange",
"green",
"purple",
"bluegray",
"pink",
"teal",
"lime",
"gray",
"brown",
"blue",
"yellow",
"black",
"deeppurple",
"lightblue",
"lightgreen",
"amber",
"deeporange",
"indigo",

),


/**
** Visibility settings for Post, Circles and user's profiles
** variables to decide wether Posts, Circles or user profiles can 
** be viewed by un-registered people
**/

"public_visibility"=>array(

"posts"=>true,
"circles"=>true,
"users"=>false,
"search"=>true,

),


/**
** visibility control for components of the site
** that have to show up only when a user is logged in
**/

"app_components"=>array(

"sidebar"=>true,

),


//SEO settings and configuration
"seo"=>array(

	"title"=>"Find Vehicle owners by Vehicle registration numbers",
	"keywords"=>"opinion sharing, QA network, online poll, share opinion, know people's opinion",
	"description"=>"Discover, debate and discuss. Share your perspectives on the world. Your opinion matters here.",

	),

);






?>