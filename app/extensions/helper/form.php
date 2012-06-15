<?php

 /**
Description:	
Lithium Form Helper for Twitter Bootstrap
Public Clone URL:	git://gist.github.com/2293441.git
*/

namespace app\extensions\helper;

class Form extends \lithium\template\helper\Form {

    /**
     * String templates used by this helper.
     *
     * @var array
     */
    protected $_strings = array(
        'button'         => '<button{:options}>{:name}</button>',
        'checkbox'       => '<input type="checkbox" name="{:name}"{:options} />',
        'checkbox-multi' => '<input type="checkbox" name="{:name}[]"{:options} />',
        'checkbox-multi-group' => '{:raw}',
        'error'          => '<span class="help-inline">{:content}</span>',
        'errors'         => '{:raw}',
        'input'          => '<input type="{:type}" name="{:name}"{:options} />',
        'file'           => '<input type="file" name="{:name}"{:options} />',
        'form'           => '<form action="{:url}"{:options}>{:append}',
        'form-end'       => '</form>',
        'hidden'         => '<input type="hidden" name="{:name}"{:options} />',
        'field'          => '<div{:wrap}>{:label}<div class="controls">{:input}{:error}</div></div>',
        'field-checkbox' => '<div{:wrap}>{:input}<div class="controls">{:label}{:error}</div></div>',
        'field-radio'    => '<div{:wrap}>{:input}<div class="controls">{:label}{:error}</div></div>',
        'label'          => '<label for="{:id}" class="control-label"{:options}>{:title}</label>',
        'legend'         => '<legend>{:content}</legend>',
        'option-group'   => '<optgroup label="{:label}"{:options}>{:raw}</optgroup>',
        'password'       => '<input type="password" name="{:name}"{:options} />',
        'radio'          => '<input type="radio" name="{:name}"{:options} />',
        'select'         => '<select name="{:name}"{:options}>{:raw}</select>',
        'select-empty'   => '<option value=""{:options}>&nbsp;</option>',
        'select-multi'   => '<select name="{:name}[]"{:options}>{:raw}</select>',
        'select-option'  => '<option value="{:value}"{:options}>{:title}</option>',
        'submit'         => '<input type="submit" value="{:title}"{:options} />',
        'submit-image'   => '<input type="image" src="{:url}"{:options} />',
        'text'           => '<input type="text" name="{:name}"{:options} />',
        'textarea'       => '<textarea name="{:name}"{:options}>{:value}</textarea>',
        'fieldset'       => '<fieldset{:options}><legend>{:content}</legend>{:raw}</fieldset>',

        'money'          => '<div class="input-prepend"><span class="add-on">$</span><input type="text" name="{:name}"{:options} /></div>',
        'date'           => '<input type="text" data-date-format="yyyy-mm-dd" class="date-field" name="{:name}"{:options} />',
        'submit-button'  => '<button type="submit"{:options}>{:name}</button>'
    );

    public function field($name, array $options = array()) {

        if (!isset($options['wrap'])) {
            $options['wrap'] = array();
        }

        if (!isset($options['wrap']['class'])) {
            $options['wrap']['class'] = ''; 
        }

        $options['wrap']['class'] .= ' control-group';

        //TODO: This errors out if not commented
        /* $errors = $this->_binding->errors();

        if (isset($errors[$name])) {
            $options['wrap']['class'] .= ' error';
        } */ 

        # Auto-populate select-box lists from validation rules
        if (isset($options['type']) and $options['type'] == 'select' and !isset($options['list'])) {
            $rules = $this->_binding->rules();

            if (isset($rules[$name])) {
                if (is_array($rules[$name][0])) {
                    $rule_list = $rules[$name];
                } else {
                    $rule_list = array($rules[$name]);
                }
                
                foreach ($rule_list as $rule) {
                    if ($rule[0] === 'inList' and isset($rule['list'])) {
                        foreach ($rule['list'] as $optval) {
                            $options['list'][$optval] = ucwords($optval);
                        }
                    }
                }
            }
        }
        

        return parent::field($name, $options);
    }
}