<?php 

/**
* 
*/
class Omeka_Core_Resource_Pluginbroker extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('Db');
        // Bootstrap the options as well, to make them immediately available
        // to plugins.
        $bootstrap->bootstrap('Options');
        // Initialize the plugin broker with the database object and the 
        // plugins/ directory
        $db = $bootstrap->getResource('Db');
        $broker = new Omeka_Plugin_Broker(PLUGIN_DIR);   
        
        $pluginIniReader = new Omeka_Plugin_Ini(PLUGIN_DIR);
        $pluginLoader = new Omeka_Plugin_Loader($broker, 
                                                $db->getTable('Plugin'), 
                                                $pluginIniReader,
                                                PLUGIN_DIR);
        
        // Set the plugin broker before loading any plugins.  
        // This is important for helper globa functions like get_plugin_ini 
        // which use the plugin broker when plugins are loaded
        Omeka_Context::getInstance()->setPluginBroker($broker);
        
        Zend_Registry::set('pluginloader', $pluginLoader);
        Zend_Registry::set('plugin_ini_reader', $pluginIniReader);
        
        $pluginLoader->registerPluginBroker();
        $pluginLoader->loadLists();
        $pluginLoader->loadActive();
        return $broker;
    }
}
