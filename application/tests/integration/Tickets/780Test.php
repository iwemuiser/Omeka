<?php
require_once HELPER_DIR . DIRECTORY_SEPARATOR . 'all.php';

class Tickets_780Test extends Omeka_Test_AppTestCase
{    
    public function testAutoDiscoveryLinkOnItemShowPageLinksToBrowsePageOutput()
    {
        $this->dispatch('items/show/1');
        $output = auto_discovery_link_tag();
        $this->assertEquals('<link rel="alternate" type="application/rss+xml" title="Omeka RSS Feed" href="/items/browse?output=rss2" />', $output);
    }
}
