<?php
// 
// This file contains all the static parameters needed for the template
// and returns thus as a view-object
// 
class showcaseView
{
	public $set = array(						// all definitions
		'name' 			=> 'showcase',
		'stylesheet' 	=> '',
		'script' 		=> '',
		'instanceName' 	=> '',
		'author' 		=> '',
		'version' 		=> '',
		'URL' 			=> '',
		'instanceName' 	=> '',


		'global'		=> array(						// parameters specific to all items, this array contains only one item
			array(
				'param'		=> array(
				),
				'strings' 	=> array(					// strings specific to all items (e.g. the container)
					'title' 		=> "Our Team",
				),
				'images' 	=> array(					// images ''
				),
				'links' 	=> array(					// links ''
				)
			)
		),


		'items' 		=> array(				// contains 1+ items, instances of the stack. if empty, use only the other parameters in $global
			array(
				'strings' 	=> array(
					'title' 		=> 'Icon 1 Text'
				),
				'images' 	=> array(
					'image' 		=> 'photo-2.png',
				)
			),
			array(
				'strings' 	=> array(
					'title' 		=> 'Icon 2 Text'
				),
				'images' 	=> array(
					'image' 		=> 'photo-2.png',
				)
			),
			array(
				'strings' 	=> array(
					'title' 		=> 'Icon 3 Text'
				),
				'images' 	=> array(
					'image' 		=> 'photo-2.png',
				)
			)
		),


		'query'			=> array(
        	'post_type' 	=> 'showcase'
		)
	);
}
$view = new showcaseView();
return $view;
