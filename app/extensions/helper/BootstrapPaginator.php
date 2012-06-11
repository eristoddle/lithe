<?php

/**
*Description: Lithium Helper to extend Paginate helper
*/

namespace app\extensions\helper;

class BootstrapPaginator extends \li3_paginate\extensions\helper\Paginator {

	/* Override Wrapper for Bootstrap style */
	protected $_strings = array(
		'pagingWrapper'	=> '<div class="pagination pagination-centered"><ul>{:content}</ul></div>'
	);
	
	/* Override List elements for Bootstrap style */
	public function __construct(array $config = array()) {
		$defaults = array(
			'showFirstLast' => true,
			'showPrevNext' => true,
			'showNumbers' => true,
			'firstText' => "First",
            'firstTextDisabled' => "",
			'prevText' => "Prev",
			'prevTextDisabled' => "",
			'nextText' => "Next",
			'nextTextDisabled' => "",
			'lastText' => "Last",
            'lastTextDisabled' => "",
			'activeOpenTag' => '<li class="active">',
			'openTag' => "<li>",
			'closeTag' => "</li>",
			'library' => null,
			'controller' => "",
			'action' => ""

		);
		parent::__construct($config + $defaults);
	}

}