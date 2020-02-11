<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context
{
    protected array $numberArticlesByLang;

    public function __construct()
    {
        $this->numberArticlesByLang = [];
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

    /**
     * @Then /^(?:|I )store the number of articles$/
     */
    public function iStoreNumberOfArticles()
    {
        $session = $this->getSession();
        $page = $session->getPage();
        $numberContainer = $page->find('css', '.mw-statistics-numbers');

        preg_match('/http(?:s?):\/\/(\w+)\./', $session->getCurrentUrl(), $matches);
        $lang = $matches[1];

        if ( ! empty($numberContainer)) {
            $this->numberArticlesByLang[$lang] = str_replace([' ', ' ', ',', '.'], '',
                html_entity_decode($numberContainer->getText()));
        }
    }

    /**
     * @Then show the number of articles
     */
    public function showTheNumberOfArticles()
    {
        $iterationNumber = 0;
        arsort($this->numberArticlesByLang);
        foreach ($this->numberArticlesByLang as $lang => $numArticles) {
            if ($iterationNumber > 0) {
                echo PHP_EOL;
            }
            echo $lang.': '.number_format($numArticles, 0, ',', '.');

            $iterationNumber++;
        }
    }
}
