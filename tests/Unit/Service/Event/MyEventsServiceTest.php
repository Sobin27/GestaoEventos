<?php
namespace Service\Event;

use App\Core\Repository\Event\IMyEventsListRepository;
use App\Core\Service\Event\IMyEventsListService;
use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Domain\Services\Event\MyEventsListService;
use App\Http\Requests\Event\MyEventsRequest;
use Mockery;
use Tests\TestCase;

class MyEventsServiceTest extends TestCase
{
    private IMyEventsListService $sut;

    public function test_listMyEvents_returnsOk(): void
    {
        //Arrange
        $request = Mockery::mock(MyEventsRequest::class);
        $pagination = Mockery::mock(Pagination::class);
        $pagination->currentPage = 1;
        $pagination->perPage = 10;
        $pagination->total = 10;
        $expectedResult = Mockery::mock(PaginatedList::class);
        $eventRepository = Mockery::mock(IMyEventsListRepository::class);
        $request
            ->shouldReceive('getPagination')
            ->andReturn($pagination);
        $eventRepository
            ->shouldReceive('getMyEventsList')
            ->with($pagination)
            ->andReturn($expectedResult);
        $this->sut = new MyEventsListService($eventRepository);
        //Act
        $result = $this->sut->getMyEventsList($request);
        //Assert
        $this->assertEquals($expectedResult, $result);
    }
}
