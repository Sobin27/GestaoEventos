<?php
namespace Repository\Event;

use App\Core\Repository\Event\IVerifyIfEventIsPublicRepository;
use App\Data\Event\VerifyIfEventIsPublicRepository;
use App\Models\Events;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VerifyIfEventIsPublicRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IVerifyIfEventIsPublicRepository $sut;

    public function test_verifyIfEventIsPublic_returnsTrue(): void
    {
        //Arrange
        $event = Events::factory()->createOne(['type' => 'Publica']);
        $this->sut = new VerifyIfEventIsPublicRepository();
        //Act
        $result = $this->sut->verifyIfEventIsPublic($event->id);
        //Assert
        $this->assertTrue($result);
    }
    public function test_verifyIfEventIsPublic_returnsFalse(): void
    {
        //Arrange
        $event = Events::factory()->createOne(['type' => 'Privada']);
        $this->sut = new VerifyIfEventIsPublicRepository();
        //Act
        $result = $this->sut->verifyIfEventIsPublic($event->id);
        //Assert
        $this->assertFalse($result);
    }
}
