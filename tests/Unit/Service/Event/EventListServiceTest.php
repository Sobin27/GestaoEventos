<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventListRepository;
use App\Core\Service\Event\IEventListService;
use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Domain\Services\Event\EventListService;
use App\Http\Requests\Event\ListEventRequest;
use Mockery;
use Tests\TestCase;

class EventListServiceTest extends TestCase
{
    private IEventListService $sut;

    public function test_eventListPaginated_returnsOk(): void
    {
        // Arrange
        $request = Mockery::mock(ListEventRequest::class);
        $pagination = Mockery::mock(Pagination::class);
        $pagination->currentPage = 1;
        $pagination->perPage = 10;
        $pagination->total = 10;
        $expectedResult = Mockery::mock(PaginatedList::class);
        $eventRepository = Mockery::mock(IEventListRepository::class);
        $request
            ->shouldReceive('getPagination')
            ->andReturn($pagination);
        $eventRepository
            ->shouldReceive('eventListPaginated')
            ->with($pagination,$request)
            ->andReturn($expectedResult);
        $this->sut = new EventListService($eventRepository);
        // Act
        $result = $this->sut->eventListPaginated($request);
        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
