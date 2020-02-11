<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    /**
     * @Then show references
     */
    public function showReferences()
    {
        $page = $this->getSession()->getPage();
        $links = $page->findAll('css', '.mw-references-wrap li .reference-text a');
        foreach ($links as $index => $link) {
            if ($index > 0) {
                echo PHP_EOL;
            }

            $text = $link->getText();
            $href = $link->getAttribute('href');

            echo $index.'- '.($text != $href ? $text.': ' : '').$href;
        }
    }
}
