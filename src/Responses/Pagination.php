<?php

declare(strict_types=1);

namespace Xolphin\Responses;

class Pagination
{
    private int $page = 0;
    private int $limit = 0;
    private int $pages = 0;
    private int $total = 01;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return Pagination
     */
    public function setPage(int $page): Pagination
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return Pagination
     */
    public function setLimit(int $limit): Pagination
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     * @return Pagination
     */
    public function setPages(int $pages): Pagination
    {
        $this->pages = $pages;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return Pagination
     */
    public function setTotal(int $total): Pagination
    {
        $this->total = $total;
        return $this;
    }
}
