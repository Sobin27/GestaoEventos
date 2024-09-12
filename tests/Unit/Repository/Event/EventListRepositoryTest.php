<?php
namespace Repository\Event;

use App\Core\Repository\Event\IEventListRepository;
use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Data\Event\EventListRepository;
use App\Http\Requests\Event\ListEventRequest;
use App\Models\EventAddress;
use App\Models\Events;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventListRepositoryTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private IEventListRepository $sut;

    public function test_eventListPaginated_withValidData_returnsPaginatedList(): void
    {
        // Arrange
        EventAddress::factory(10)->create();
        $request = new ListEventRequest();
        $pagination = new Pagination();
        $pagination->perPage = 10;
        $this->sut = new EventListRepository();
        // Act
        $result = $this->sut->eventListPaginated($pagination, $request);
        // Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(PaginatedList::class, $result);
    }
    public function test_eventListPaginated_withFilterName_returnOk(): void
    {
        // Arrange
        $eventsAddress = EventAddress::factory(10)->create()->random();
        $event = Events::where('id', $eventsAddress->event_id)->first();
        $request = new ListEventRequest();
        $request->name = $event->name;
        $pagination = new Pagination();
        $pagination->perPage = 10;
        $this->sut = new EventListRepository();
        // Act
        $result = $this->sut->eventListPaginated($pagination, $request);
        // Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(PaginatedList::class, $result);
        $this->assertCount(1, $result->list);
    }
    public function test_eventListPaginated_withFilterType_returnOk(): void
    {
        // Arrange
        $type = $this->faker->randomElement(['Privada', 'Publica']);
        EventAddress::factory(10)->create();
        $event = Events::where('type', $type)->count();
        $request = new ListEventRequest();
        $request->type = $type;
        $pagination = new Pagination();
        $pagination->perPage = 10;
        $this->sut = new EventListRepository();
        // Act
        $result = $this->sut->eventListPaginated($pagination, $request);
        // Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(PaginatedList::class, $result);
        $this->assertCount($event, $result->list);
    }
}
