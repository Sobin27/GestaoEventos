<?php
namespace Service\Event;

use App\Core\Repository\Event\IEventToParticipateRepository;
use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Core\Repository\Event\IVerifyIfEventIsStillActiveRepository;
use App\Core\Service\Event\IEventToParticipateService;
use App\Domain\Services\Event\EventToParticipateService;
use App\Models\Events;
use App\Models\User;
use Exception;
use Mockery;
use Tests\TestCase;

class EventToParticipateServiceTest extends TestCase
{
    private IEventToParticipateService $sut;

    public function test_eventToParticipate_withValidData_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $user->id = rand(1,100);
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->makeOne(['type' => 'Publica', 'active' => true]);
        $event->id = rand(1,100);
        $eventRepository = Mockery::mock(IEventToParticipateRepository::class);
        $eventRepositoryVerifyHowManyParticipants = Mockery::mock(IVerifyHowManyParticipantsEventRepository::class);
        $eventRepositoryVerifyIfEventIsPublicRepository = Mockery::mock(IVerifyIfEventIsPublicRepository::class);
        $eventRepositoryVerifyIfEventIsStillActiveRepository = Mockery::mock(IVerifyIfEventIsStillActiveRepository::class);
        $eventRepositoryVerifyHowManyParticipants
            ->shouldReceive('verifyHoManyParticipants')
            ->with($event->id)
            ->andReturn([['participants' => 0, 'max_participants' => 10]]);
        $eventRepositoryVerifyIfEventIsPublicRepository
            ->shouldReceive('verifyIfEventIsPublic')
            ->with($event->id)
            ->andReturn(true);
        $eventRepositoryVerifyIfEventIsStillActiveRepository
            ->shouldReceive('verifyIfEventIsStillActive')
            ->with($event->id)
            ->andReturn(true);
        $eventRepository
            ->shouldReceive('toParticipateEvent')
            ->andReturn(true);
        $this->sut = new EventToParticipateService($eventRepositoryVerifyHowManyParticipants, $eventRepositoryVerifyIfEventIsPublicRepository, $eventRepository, $eventRepositoryVerifyIfEventIsStillActiveRepository);
        //Act
        $result = $this->sut->eventToParticipate($event->id);
        //Assert
        $this->assertTrue($result);
    }
    public function test_eventToParticipate_withValidData_butTheEventIsNotPublic_returnsFalse(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $user->id = rand(1,100);
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->makeOne(['type' => 'Privada', 'active' => true]);
        $event->id = rand(1,100);
        $eventRepository = Mockery::mock(IEventToParticipateRepository::class);
        $eventRepositoryVerifyHowManyParticipants = Mockery::mock(IVerifyHowManyParticipantsEventRepository::class);
        $eventRepositoryVerifyIfEventIsPublicRepository = Mockery::mock(IVerifyIfEventIsPublicRepository::class);
        $eventRepositoryVerifyIfEventIsStillActiveRepository = Mockery::mock(IVerifyIfEventIsStillActiveRepository::class);
        $eventRepositoryVerifyHowManyParticipants
            ->shouldReceive('verifyHoManyParticipants')
            ->with($event->id)
            ->andReturn([['participants' => 0, 'max_participants' => 10]]);
        $eventRepositoryVerifyIfEventIsPublicRepository
            ->shouldReceive('verifyIfEventIsPublic')
            ->with($event->id)
            ->andReturn(false);
        $eventRepositoryVerifyIfEventIsStillActiveRepository
            ->shouldReceive('verifyIfEventIsStillActive')
            ->with($event->id)
            ->andReturn(true);
        $eventRepository
            ->shouldReceive('toParticipateEvent')
            ->andReturn(true);
        $this->sut = new EventToParticipateService($eventRepositoryVerifyHowManyParticipants, $eventRepositoryVerifyIfEventIsPublicRepository, $eventRepository, $eventRepositoryVerifyIfEventIsStillActiveRepository);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->eventToParticipate($event->id);
    }
    public function test_eventToParticipate_withValidData_butTheEventIsNotActive_returnsFalse(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $user->id = rand(1,100);
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->makeOne(['type' => 'Privada', 'active' => true]);
        $event->id = rand(1,100);
        $eventRepository = Mockery::mock(IEventToParticipateRepository::class);
        $eventRepositoryVerifyHowManyParticipants = Mockery::mock(IVerifyHowManyParticipantsEventRepository::class);
        $eventRepositoryVerifyIfEventIsPublicRepository = Mockery::mock(IVerifyIfEventIsPublicRepository::class);
        $eventRepositoryVerifyIfEventIsStillActiveRepository = Mockery::mock(IVerifyIfEventIsStillActiveRepository::class);
        $eventRepositoryVerifyHowManyParticipants
            ->shouldReceive('verifyHoManyParticipants')
            ->with($event->id)
            ->andReturn([['participants' => 0, 'max_participants' => 10]]);
        $eventRepositoryVerifyIfEventIsPublicRepository
            ->shouldReceive('verifyIfEventIsPublic')
            ->with($event->id)
            ->andReturn(true);
        $eventRepositoryVerifyIfEventIsStillActiveRepository
            ->shouldReceive('verifyIfEventIsStillActive')
            ->with($event->id)
            ->andReturn(false);
        $eventRepository
            ->shouldReceive('toParticipateEvent')
            ->andReturn(true);
        $this->sut = new EventToParticipateService($eventRepositoryVerifyHowManyParticipants, $eventRepositoryVerifyIfEventIsPublicRepository, $eventRepository, $eventRepositoryVerifyIfEventIsStillActiveRepository);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->eventToParticipate($event->id);
    }
    public function test_eventToParticipate_withValidData_butTheEventIsNotVacancies_returnsFalse(): void
    {
        //Arrange
        $user = User::factory()->makeOne();
        $user->id = rand(1,100);
        $this->actingAs($user, 'jwt');
        $event = Events::factory()->makeOne(['type' => 'Privada', 'active' => true]);
        $event->id = rand(1,100);
        $eventRepository = Mockery::mock(IEventToParticipateRepository::class);
        $eventRepositoryVerifyHowManyParticipants = Mockery::mock(IVerifyHowManyParticipantsEventRepository::class);
        $eventRepositoryVerifyIfEventIsPublicRepository = Mockery::mock(IVerifyIfEventIsPublicRepository::class);
        $eventRepositoryVerifyIfEventIsStillActiveRepository = Mockery::mock(IVerifyIfEventIsStillActiveRepository::class);
        $eventRepositoryVerifyHowManyParticipants
            ->shouldReceive('verifyHoManyParticipants')
            ->with($event->id)
            ->andReturn([['participants' => 10, 'max_participants' => 10]]);
        $eventRepositoryVerifyIfEventIsPublicRepository
            ->shouldReceive('verifyIfEventIsPublic')
            ->with($event->id)
            ->andReturn(true);
        $eventRepositoryVerifyIfEventIsStillActiveRepository
            ->shouldReceive('verifyIfEventIsStillActive')
            ->with($event->id)
            ->andReturn(false);
        $eventRepository
            ->shouldReceive('toParticipateEvent')
            ->andReturn(true);
        $this->sut = new EventToParticipateService($eventRepositoryVerifyHowManyParticipants, $eventRepositoryVerifyIfEventIsPublicRepository, $eventRepository, $eventRepositoryVerifyIfEventIsStillActiveRepository);
        //Assert
        $this->expectException(Exception::class);
        //Act
        $this->sut->eventToParticipate($event->id);
    }
}
