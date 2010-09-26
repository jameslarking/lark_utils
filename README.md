#LarkUtils Plugin

Just a collection of various helpers, components for reuse in applications.  At this time this is just for personal use so is not documented and may change at any point.  I will hopefully build this into a library that others may wish to use but for now is really just for me.

##Helpers

###HasMany

Quick linking together of an ajax form and index table for a record with a hasMany relationship that we wish to manage typically in the parent's edit record.

##Filter

Quickly add filters to a cakephp pagination page.

####Todo
-	search box

##Markdown

Add a Markdown Helper to parse markdown using [php markdown extra](http://michelf.com/projects/php-markdown/extra/). Helper code taken from [http://bakery.cakephp.org/articles/view/baking-with-markdown-and-dp-syntaxhighlighter] but just put here for easy reuse

####Usage
	
	//Controller
	<?php var $helpers = array('Markdown');?>

	//View
	<?php 
	echo $markdown->parse($content); 
	?>