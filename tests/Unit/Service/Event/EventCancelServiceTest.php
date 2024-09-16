<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventCancelRepository;
use App\Core\Repository\Event\IEventFindByIdRepository;
use App\Core\Repository\Event\IVerifyIfUserIsOrganizerEventRepository;
use App\Core\Service\Event\IEventCancelService;
use App\Domain\Services\Event\EventCancelService;
use App\Events\CancelEvent;
use App\Models\Events;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\TestCase;

class EventCancelServiceTest extends TestCase
{
    private IEventCancelService $sut;

    public function test_cancelEvent_withValidData_returnsOk(): void
    {
        //Arrange
        Mail::fake();
        Event::fake();
        $user = User::factory()->makeOne();
        $user->id = rand(1, 100);
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->makeOne(['event_organizer' => $user->id]);
        $event->id = rand(1, 100);
        $eventRepositoryFindById = Mockery::mock(IEventFindByIdRepository::class);
        $eventRepository = Mockery::mock(IEventCancelRepository::class);
        $eventRepositoryVerifyIfUserIsOrganizer = Mockery::mock(IVerifyIfUserIsOrganizerEventRepository::class);
        $eventRepositoryVerifyIfUserIsOrganizer
            ->shouldReceive('verifyIfUserIsOrganizerEvent')
            ->with($user->id, $event->id)
            ->andReturn(true);
        $eventRepository
            ->shouldReceive('cancelEvent')
            ->with($event->id)
            ->andReturn(true);
        $eventRepositoryFindById->shouldReceive('eventFindById')
            ->with($event->id)
            ->andReturn($event);
        $this->sut = new EventCancelService($eventRepository, $eventRepositoryVerifyIfUserIsOrganizer,$eventRepositoryFindById);
        //Act
        $result = $this->sut->cancelEvent($event->id);
        //Assert
        $this->assertTrue($result);
    }
    public function test_cancelEvent_withUserIsNotOrganize_returns500(): void
    {
        //Arrange
        Mail::fake();
        Event::fake();
        $user = User::factory()->makeOne();
        $user->id = rand(1, 100);
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->makeOne();
        $event->id = rand(1, 100);
        $eventRepositoryFindById = Mockery::mock(IEventFindByIdRepository::class);
        $eventRepository = Mockery::mock(IEventCancelRepository::class);
        $eventRepositoryVerifyIfUserIsOrganizer = Mockery::mock(IVerifyIfUserIsOrganizerEventRepository::class);
        $eventRepositoryVerifyIfUserIsOrganizer
            ->shouldReceive('verifyIfUserIsOrganizerEvent')
            ->with($user->id, $event->id)
            ->andReturn(false);
        $this->sut = new EventCancelService($eventRepository, $eventRepositoryVerifyIfUserIsOrganizer,$eventRepositoryFindById);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $result = $this->sut->cancelEvent($event->id);
    }
}
