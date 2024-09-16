<?php
namespace Repository\Event;

use App\Core\Repository\Event\IMyEventsListRepository;
use App\Core\Support\PaginatedList;
use App\Core\Support\Pagination;
use App\Data\Event\MyEventsListRepository;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MyEventsRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    private IMyEventsListRepository $sut;

    public function test_listMyEvents_returnsOk(): void
    {
        //Arrange
        $user = User::factory()->createOne();
        $this->actingAs($user, 'jwt');
        EventUser::factory(10)->create(['participant_id' => $user->id]);
        $pagination = new Pagination();
        $pagination->perPage = 10;
        $this->sut = new MyEventsListRepository();
        // Act
        $result = $this->sut->getMyEventsList($pagination);
        // Assert
        $this->assertNotNull($result);
        $this->assertInstanceOf(PaginatedList::class, $result);
    }
}
