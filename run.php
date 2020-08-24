<?php

error_reporting(E_ALL & ~E_NOTICE);

require 'vendor/autoload.php';

use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlObserver;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

use Symfony\Component\DomCrawler\Crawler as DomCrawler;


/** 
 * CrawlObserver class, passing to Crawler when start crawling it. The crawl logic all here.
 */
class zCrawlObserver extends CrawlObserver
{
    public $productList = [];

    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null
    ) {
        
        $z2cConverter = new zh2cnConvert();
        $domCrawler = new DomCrawler((string)$response->getBody());
        
        // Get the product json data block
        $domFetched = $domCrawler->filter('script[type="application/ld+json"][data-rh="true"]');

        // The number of products must more then 50, if not then throw exception, outside will try to crawl again
        if ($domFetched->count() < 50) {
            throw new Exception('The page not loaded');
        }

        // Loop every json block that fetched
        foreach ($domFetched as $jsonBlock) {
            $productFetched = json_decode($jsonBlock->nodeValue, true);
            
            // Not every json item is "product"
            if ('Product' !== $productFetched['@type']) {
                continue;
            }

            // Get product name and price, the product name will conver to Simplified Chinese using z2cConverter
            $product['name'] = $z2cConverter->convert(html_entity_decode($productFetched['name']));
            $product['price'] = (true === isset($productFetched['offers']['price'])) ? ('$' . $productFetched['offers']['price']) : ('$' . $productFetched['offers']['lowPrice'] . ' - $' . $productFetched['offers']['highPrice']);
            
            $this->productList[] = $product;
        }
        
        foreach ($this->productList as $prod) {
            echo $prod['name'] . "\n";
            echo $prod['price'] . "\n";
            echo "---\n";
        }
    }

    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    ) {
        throw new Exception("Crewl Failed");
    }
}



/** 
 * Crawler running start from here
 */

$tryLimit = 5;
$attempts = 0;

// If catch exception then try to crawl again, if try times more than $tryLimit then stop trying
do {

    try
    {
        Crawler::create()->setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36')
            ->setMaximumCrawlCount(1)
            ->executeJavaScript()
            ->setCrawlObserver(new zCrawlObserver())
            ->startCrawling('https://shopee.tw/%E7%8E%A9%E5%85%B7-cat.75.2185?brands=5005&locations=-1&page=0&ratingFilter=4');
    } catch (Exception $e) {
        echo "Try again ...\n";
        $attempts++;
        sleep(rand(2, 5));
        continue;
    }

    break;

} while ($attempts < $tryLimit);

