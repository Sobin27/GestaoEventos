<?php
namespace App\Core\Support;

use App\Core\Traits\ArraySerializer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class PaginatedList
 * @package App\Core\Support
 */
class PaginatedList
{
    use ArraySerializer;
    /**
     * @var Collection
     */
    public Collection $list;
    /**
     * @var Pagination | array
     */
    public Pagination | array $pagination;

    /**
     * @return static
     */
    public static function builder(): static
    {
        return new PaginatedList();
    }

    public static function builderByEloquentPagination(LengthAwarePaginator $paginator, Pagination $pagination): static
    {
        $pagination->setTotal($paginator->total());
        return PaginatedList::builder()
            ->setList($paginator)
            ->setPagination($pagination)
            ;
    }
    /**
     * @param LengthAwarePaginator $query
     * @return PaginatedList
     */
    public function setList(LengthAwarePaginator $query): PaginatedList
    {
        $this->list = collect();
        $queryCollection = collect($query->items());
        $queryCollection->each(function($item){
            $this->list->add($item->mapTo());
        });
        return $this;
    }
    /**
     * @param Pagination $pagination
     * @return PaginatedList
     */
    public function setPagination(Pagination $pagination): PaginatedList
    {
        $this->pagination = $pagination;
        return $this;
    }
}
