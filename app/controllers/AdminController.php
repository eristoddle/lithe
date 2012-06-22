<?php

namespace app\controllers;

class AdminController extends \lithium\action\Controller
{
//    public function _init()
//    {
//        parent::_init();
//        
//        $this->_render['paths']['template'] = LI3_ADMIN_PATH . '/views/{:controller}/{:template}.{:type}.php';
//		$this->_render['paths']['element'] = LI3_ADMIN_PATH . '/views/elements/{:template}.html.php'; 
//		
//		//use the application's default layout
//		$this->_render['paths']['layout'] = LITHIUM_APP_PATH . '/views/layouts/default.html.php';
//    }
    
    public function index()
    {
        //find EVERY model and build an array of class => model_slug
        
        $models = array(
            'li3_workflow\models\Ticket' => 'li3_workflow-models-Ticket',
        );
        
        return compact( 'models' );
    }
    
    public function records()
    {
        $model = $this->_getModel();
        
        $records = $model::all();

        $fields = array_keys( $model::schema() );

        $key = $model::key();

        $foreign_keys = $this->_getForeignKeys();
        
        return compact( 'records', 'fields', 'key', 'foreign_keys' );
    }
    
    public function entity()
    {
        $model = $this->_getModel();
        
        $entity = isset( $this->request->id )?
                    $model::first( $this->_getFindOptions() ):
                    $model::create();
                    
        $fields = array();
        
        foreach( $model::schema() as $field => $schema )
        {
            $options = array();
            
            $fields[$field] = $options;
        }
                    
        return compact( 'entity', 'fields' );
    }
    
    protected function _getModel()
    {
        if( !isset( $this->_model ) )
            $this->_model = str_replace('-', '\\',  $this->request->model_slug );
            
        return $this->_model;
    }
    
    protected function _getFindOptions()
    {
        $id = $this->request->id;
        
        $model = $this->_getModel();
        
        $key = $model::key();
        
        $conditions = array(
            $key => $id,
        );
        
        return compact( 'conditions' );
    }
    
    protected function _getForeignKeys()
    {
        $model = $this->_getModel();
        
        $foreign_keys = array();

        foreach( $model::relations() as $name => $relationship )
        {
            if( $relationship->data('type') == 'belongsTo' )
            {
                $field = key( $relationship->data('key') );
                
                $foreign_keys[$field] = str_replace('\\', '-', $relationship->data('to') );
            }
        }
        
        return $foreign_keys;
    }
}