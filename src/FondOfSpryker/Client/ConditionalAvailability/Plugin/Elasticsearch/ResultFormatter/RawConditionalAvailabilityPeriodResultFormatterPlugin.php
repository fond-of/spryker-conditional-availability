<?php

namespace FondOfSpryker\Client\ConditionalAvailability\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawConditionalAvailabilityPeriodResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'periods';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return array
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): array
    {
        $pages = [];
        $results = $searchResult->getResults();

        foreach ($results as $document) {
            $pages[] = $document->getSource();
        }

        return $pages;
    }
}
