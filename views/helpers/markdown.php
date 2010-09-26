<?php

/*
* syntax: http://michelf.com/projects/php-markdown/extra/
* markdown extra plugin - see http://michelf.com/projects/php-markdown/ for more information
* helper code taken from http://bakery.cakephp.org/articles/view/baking-with-markdown-and-dp-syntaxhighlighter
*/

APP::import("Vendor",'LarkUtils.markdown');

class MarkdownHelper extends AppHelper {
	function parse($text) {
		return $this->output(Markdown($text));
	}
}
?>