<?php


namespace CTApi\Test\Unit\Docs;


use CTApi\CTConfig;
use CTApi\Models\Group;
use CTApi\Requests\GroupMeetingRequest;
use CTApi\Requests\GroupRequest;
use CTApi\Test\Unit\TestCaseHttpMocked;

class GroupMeetingRequestTest extends TestCaseHttpMocked
{

    private Group $group;

    protected function setUp(): void
    {
        parent::setUp();
        $this->group = GroupRequest::findOrFail(21);
    }

    public function testRetrieveGroupRequest()
    {
        $meetings = $this->group->requestGroupMeetings()
            ?->where("start_date", "2022-11-01")
            ->where("end_date", "2022-11-15")
            ->get();

        $meeting = $meetings[0];

        $this->assertEquals(2652, $meeting->getId());
        $this->assertEquals(21, $meeting->getGroupId());
        $this->assertEquals("2022-11-09T18:30:00Z", $meeting->getDateFrom());
        $this->assertEquals("2022-11-09T18:30:00Z", $meeting->getDateTo());
        $this->assertEquals(true, $meeting->getIsCompleted());
        $this->assertEquals(false, $meeting->getIsCanceled());
        $this->assertEquals(true, $meeting->getHasEditingStarted());
        $this->assertEquals(5, $meeting->getNumGuests());
        $this->assertEquals("Hello World", $meeting->getComment());

        $this->assertEquals(2, $meeting?->getStatistics()->getPresent());
        $this->assertEquals(1, $meeting?->getStatistics()->getAbsent());
        $this->assertEquals(0, $meeting?->getStatistics()->getUnsure());
    }

    public function testRetrieveGroupMemberRequest()
    {
        $meetings = GroupMeetingRequest::forGroup(21)->get();
        $meeting = $meetings[0];

        $meetingMembers = $meeting->requestMembers()->get();
        $meetingMember = $meetingMembers[0];

        $this->assertEquals(true, $meetingMember->getIsCheckedIn());
        $this->assertEquals("present", $meetingMember->getStatus());

        $groupMember = $meetingMember->getMember();
        // see GroupMember-Model
    }
}