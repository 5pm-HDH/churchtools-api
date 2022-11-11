<?php


namespace Tests\Integration\Requests;


use CTApi\Models\GroupMeeting;
use CTApi\Models\GroupMeetingMember;
use CTApi\Requests\GroupRequest;
use Tests\Integration\TestCaseAuthenticated;
use Tests\Integration\TestData;

class GroupMeetingRequestTest extends TestCaseAuthenticated
{
    private int $groupId;

    private string $filterStartDate;
    private string $filterEndDate;

    private int $present;
    private int $absent;
    private int $unsure;
    private int $guests;
    private string $comment;

    protected function setUp(): void
    {
        $this->checkIfTestSuiteIsEnabled("GROUP_MEETING");
        $this->groupId = TestData::getValueAsInteger("GROUP_MEETING_GROUP_ID");

        $this->filterStartDate = TestData::getValue("GROUP_MEETING_START_DATE");
        $this->filterEndDate = TestData::getValue("GROUP_MEETING_END_DATE");

        $this->present = TestData::getValueAsInteger("GROUP_MEETING_PRESENT");
        $this->absent = TestData::getValueAsInteger("GROUP_MEETING_ABSENT");
        $this->unsure = TestData::getValueAsInteger("GROUP_MEETING_UNSURE");
        $this->guests = TestData::getValueAsInteger("GROUP_MEETING_GUESTS");
        $this->comment = TestData::getValue("GROUP_MEETING_COMMENT");
        parent::setUp();
    }

    public function testGetMeeting()
    {
        $meeting = $this->requestMeeting();
        $this->assertInstanceOf(GroupMeeting::class, $meeting);

        $this->assertEquals($this->guests, $meeting->getNumGuests());

        $this->assertEquals($this->present, $meeting->getStatistics()?->getPresent());
        $this->assertEquals($this->absent, $meeting->getStatistics()?->getAbsent());
        $this->assertEquals($this->unsure, $meeting->getStatistics()?->getUnsure());
    }

    private function requestMeeting(): GroupMeeting
    {
        $group = GroupRequest::find($this->groupId);
        $this->assertNotNull($group);

        $meetings = $group->requestGroupMeetings()
            ?->where("start_date", $this->filterStartDate)
            ->where("end_date", $this->filterEndDate)->get();

        $this->assertNotEmpty($meetings);

        $meeting = end($meetings);
        return $meeting;
    }

    public function testGetMeetingMembers()
    {
        $meeting = $this->requestMeeting();

        $members = $meeting->requestMembers()?->get();
        $this->assertNotNull($members);
        foreach ($members as $member) {
            $this->assertInstanceOf(GroupMeetingMember::class, $member);
        }
    }
}