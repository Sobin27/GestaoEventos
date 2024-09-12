<?php
namespace Repository\Event;

use App\Core\Repository\Event\IVerifyHowManyParticipantsEventRepository;
use App\Data\Event\VerifyHowManyParticipantsEventRepository;
use App\Models\Events;
use App\Models\EventUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VerifyHowManyParticipantsEventRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IVerifyHowManyParticipantsEventRepository $sut;

    public function test_verifyHowManyParticipantsEvents_returnsArray(): void
    {
        //Arrange
        $event = Events::factory()->createOne();
        EventUser::factory(10)->create(['event_id' => $event->id]);
        $this->sut = new VerifyHowManyParticipantsEventRepository();
        //Act
        $result = $this->sut->verifyHoManyParticipants($event->id);
        //Assert
        $this->assertIsArray($result);
    }
}
