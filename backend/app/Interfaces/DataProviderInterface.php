<?php
namespace App\Interfaces;

interface DataProviderInterface
{  
    /**
     * Filter users based on various criteria.
     *
     * @param array $filters
     * @return \Illuminate\Support\Collection
     */
    public function filterUsers($filters = []): object;
}
