<?php

/**
*Description: Lithium Helper to extend Paginator helper
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
			'firstText' => "<<",
            'firstTextDisabled' => "",
			'prevText' => "<",
			'prevTextDisabled' => "",
			'nextText' => ">",
			'nextTextDisabled' => "",
			'lastText' => ">>",
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
    
    
    public function paginate(array $options = array()) {
		if (!empty($options)) {
			$this->config($options);
		}
		
		$this->_library = (empty($this->_config['library']) && isset($this->_context->_config['request']->params['library'])) ? $this->_context->_config['request']->params['library'] : $this->_config['library'];
		$this->_controller = (empty($this->_config['controller'])) ? $this->_context->_config['request']->params['controller'] : $this->_config['controller'];
		$this->_action = (empty($this->_config['action'])) ? $this->_context->_config['request']->params['action'] : $this->_config['action'];
		$content = "";
		if ($this->_config["showFirstLast"]) {
            $content .= $this->first();
        }
		if ($this->_config["showPrevNext"]) {
			$content .= $this->prev();
		}
		if ($this->_config["showNumbers"]) {
			$content .= $this->numbers();
		}
		if ($this->_config["showPrevNext"]) {
			$content .= $this->next();
		}
		if ($this->_config["showFirstLast"]) {
            $content .= $this->last();
        }
		return $this->_render(__METHOD__, 'pagingWrapper', compact('content'), array('escape' => false));
	}

}