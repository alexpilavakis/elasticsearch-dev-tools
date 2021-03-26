<?php

namespace Ulex\ElasticsearchDevTools;

use Ulex\ElasticsearchDevTools\Builders\AggregationBuilder;
use Ulex\ElasticsearchDevTools\Builders\SearchBuilder;
use Ulex\ElasticsearchDevTools\Builders\SuggestionBuilder;

class ElasticDevTools
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * ElasticDevTools constructor.
     * @param array|null $config
     */
    public function __construct(array $config = null)
    {
        $this->connection = new Connection($config);
    }

    /**
     * @return SearchBuilder
     */
    public function search()
    {
        return new SearchBuilder($this->connection);
    }

    /**
     * @return AggregationBuilder
     */
    public function aggregation()
    {
        return new AggregationBuilder();
    }

    /**
     * @return SuggestionBuilder
     */
    public function suggest()
    {
        return new SuggestionBuilder($this->connection);
    }
}
