<?php
namespace Repository\Event;

use App\Core\Repository\Event\IVerifyIfEventIsStillActiveRepository;
use App\Data\Event\VerifyIfEventIsStillActiveRepository;
use App\Models\Events;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VerifyIfEventIsStillActiveRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IVerifyIfEventIsStillActiveRepository $sut;

    public function test_verifyIfEventIsStillActive_returnsTrue(): void
    {
        //Arrange
        $event = Events::factory()->createOne(['active' => true]);
        $this->sut = new VerifyIfEventIsStillActiveRepository();
        //Act
        $result = $this->sut->verifyIfEventIsStillActive($event->id);
        //Assert
        $this->assertTrue($result);
    }
    public function test_verifyIfEventIsStillActive_returnsFalse(): void
    {
        //Arrange
        $event = Events::factory()->createOne(['active' => false]);
        $this->sut = new VerifyIfEventIsStillActiveRepository();
        //Act
        $result = $this->sut->verifyIfEventIsStillActive($event->id);
        //Assert
        $this->assertFalse($result);
    }
}
