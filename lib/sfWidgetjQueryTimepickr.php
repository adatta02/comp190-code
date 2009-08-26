<?php

/*
 * sfWidgetjQueryTimepickr
 *
 * Copyright (c) 2009 Ashish Datta 
 *                    ashish@setfive.com
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 *
 */


class sfWidgetjQueryTimepickr extends sfWidgetFormInput
{
	
  /**
   * Constructor.
   *
   * Available options along with default and description.
   *
   *  * type "text" The widget type
   *  * convention    24    Hour convention (12 or 24)
   *  * dropslide   {trigger: 'focus'}  Dropslide options
   *  * format12  "{h:02.d}:{m:02.d} {suffix:s}"  12h format string
   *  * format24  "{h:02.d}:{m:02.d}"   24h format string
   *  * handle  false   handle is a DOM element which will open the menu upon click
   *  * hours   true  Show hours picker
   *  * minutes   true  Show minutes picker
   *  * seconds   false   Show seconds picker
   *  * prefix  ['am', 'pm']  Time prefix
   *  * suffix  ['am', 'pm']  Time suffix
   *  * rangeMin  ['00', '15', '30', '45']  Minutes range
   *  * rangeSec  ['00', '15', '30', '45']  Seconds range
   *  * updateLive  true  Update input value on each mouseover
   *  * val   false   Initial value
   *  * resetOnBlur   true  Input reset itself on blur when no click happens 
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
  	$this->addOption('convention', '12');
  	$this->addOption('dropslide', "{trigger: 'focus'}");
  	$this->addOption('format12', "{h:02.d}:{m:02.d} {suffix:s}");
  	$this->addOption('format24', "{h:02.d}:{m:02.d}");
  	$this->addOption('handle', false);
  	$this->addOption('hours', true);
  	$this->addOption('minutes', true);
  	$this->addOption('seconds', false);
  	$this->addOption('prefix', array('am', 'pm'));
  	$this->addOption('suffix', array('am', 'pm'));
  	$this->addOption('rangeMin', array('00', '15', '30', '45'));
  	$this->addOption('rangeSec', array('00', '15', '30', '45'));
  	$this->addOption('updateLive', "true");
  	$this->addOption('resetOnBlur', "false");
  	
    $this->addOption('type', 'text');
    $this->setOption('is_hidden', false);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
  	
  	if(isset($attributes["nojs"]) && $attributes["nojs"]){
  		return $this->renderTag('input', array_merge(array('type' => $this->getOption('type'), 'name' => $name, 'value' => $value), $attributes));
  	}
  	
  	return 
      "<script type='text/javascript'>
        $(document).ready( function(){
        
          $('#" . $this->generateId($name) . "')
            .timepickr({
              convention: " . $this->getOption('convention') . ",
              dropslide: " . $this->getOption('dropslide') . ",
              format12: '" . $this->getOption('format12') . "',
              format24: '" . $this->getOption('format24') . "',
              handle: " . json_encode($this->getOption('handle')) . ",
              hours: " . json_encode($this->getOption('hours')) . ",
              minutes: " . json_encode($this->getOption('minutes')) . ",
              seconds: " . json_encode($this->getOption('seconds')) . ",
              prefix: " . json_encode($this->getOption('prefix')) . ",
              suffix: " . json_encode($this->getOption('suffix')) . ",
              rangeMin: " . json_encode($this->getOption('rangeMin')) . ",
              rangeSec: " . json_encode($this->getOption('rangeSec')) . ",
              updateLive: " . json_encode($this->getOption('updateLive')) . ",
              resetOnBlur: " . json_encode($this->getOption('resetOnBlur')) . "
            });
        });
        </script>" 
       . $this->renderTag('input', array_merge(array('type' => $this->getOption('type'), 'name' => $name, 'value' => $value), $attributes));
  }
  
  
    public function getStylesheets()
  {
    return array(
      '/css/ui.dropslide.css' => 'screen',
      '/css/ui.timepickr.css' => 'screen'
    );
  }
 
  public function getJavaScripts()
  {
    return array('/js/ui.dropslide.js', '/js/jquery.strings.js', '/js/jquery.utils.js', 
                 '/js/jquery.timepickr.js');
  }
  
}
?>