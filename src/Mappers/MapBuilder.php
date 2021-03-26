<?php

namespace Ulex\ElasticsearchDevTools\Mappers;

use Closure;
use Ulex\ElasticsearchDevTools\Connection;
use Elasticsearch\Common\Exceptions\InvalidArgumentException;

class MapBuilder
{
    /**
     * Plastic connection instance.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * Map grammar instance.
     *
     * @var MapGrammar
     */
    protected $grammar;

    /**
     * Blueprint resolver callback.
     *
     * @var Closure
     */
    protected $resolver;

    /**
     * Schema constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->grammar = $connection->getMapGrammar();
    }

    /**
     * Create a map on your elasticsearch index.
     *
     * @param string $type
     * @param Closure $callback
     * @param null $index
     */
    public function create(string $type, Closure $callback, $index = null)
    {
        if (!is_string($type)) {
            throw new InvalidArgumentException('type should be a string');
        }

        if ($index and !is_string($index)) {
            throw new InvalidArgumentException('index should be a string');
        }

        $blueprint = $this->createBlueprint($type, $closure = null, $index);

        $blueprint->create();

        $callback($blueprint);

        $this->build($blueprint);
    }

    /**
     * Execute the blueprint to build.
     *
     * @param MapBlueprint $blueprint
     */
    protected function build(MapBlueprint $blueprint)
    {
        $blueprint->build($this->connection, $this->grammar);
    }

    /**
     * Create a new command set with a Closure.
     *
     * @param string $type
     * @param Closure|null $callback
     * @param null $index
     *
     * @return mixed|MapBlueprint
     */
    protected function createBlueprint(string $type, Closure $callback = null, $index = null)
    {
        if (isset($this->resolver)) {
            return call_user_func($this->resolver, $type, $callback, $index);
        }

        return new MapBlueprint($type, $callback, $index);
    }

    /**
     * Set the Schema Blueprint resolver callback.
     *
     * @param Closure $resolver
     *
     * @return void
     */
    public function blueprintResolver(Closure $resolver)
    {
        $this->resolver = $resolver;
    }
}
