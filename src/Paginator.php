<?php

namespace Ulex\ElasticsearchDevTools;

use Illuminate\Pagination\LengthAwarePaginator;

class Paginator extends LengthAwarePaginator
{
    /**
     * @var Result
     */
    protected $result;

    /**
     * Paginator constructor.
     *
     * @param Result $result
     * @param int $limit
     * @param int $page
     */
    public function __construct(Result $result, int $limit, int $page)
    {
        $this->result = $result;

        parent::__construct(
            $result->hits(),
            $result->totalHits(),
            $limit,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $hitsReference = &$this->items;

        $result->setHits($hitsReference);
    }

    /**
     * Access the result object.
     *
     * @return Result
     */
    public function result()
    {
        return $this->result;
    }
}
