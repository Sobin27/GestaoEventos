<?php
namespace Event;

use App\Core\Repository\Event\IVerifyIfUserIsOrganizerEventRepository;
use App\Data\Event\VerifyIfUserIsOrganizerEventRepository;
use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VerifyIfUserIsOrganizerEventRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IVerifyIfUserIsOrganizerEventRepository $sut;

    public function test_verifyIfUserIsOrganizer_returnsTrue(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $event = Events::factory()->createOne(['event_organizer' => $user->id]);
        $this->sut = new VerifyIfUserIsOrganizerEventRepository();
        //Act
        $result = $this->sut->verifyIfUserIsOrganizerEvent($user->id, $event->id);
        //Assert
        $this->assertTrue($result);
    }
    public function test_verifyIfUserIsOrganizer_returnsFalse(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $event = Events::factory()->createOne();
        $this->sut = new VerifyIfUserIsOrganizerEventRepository();
        //Act
        $result = $this->sut->verifyIfUserIsOrganizerEvent($user->id, $event->id);
        //Assert
        $this->assertFalse($result);
    }
}
