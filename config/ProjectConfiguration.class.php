<?php

require_once '/usr/share/php/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{

 private static $zendLoaded = false;

  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
  }

  static public function registerZend()
  {
    if (self::$zendLoaded)
    {
      return;
    }
 
    set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
    require_once sfConfig::get('sf_lib_dir').'/vendor/Zend/Loader.php';
    Zend_Loader::registerAutoload();
    self::$zendLoaded = true;
  }


}
