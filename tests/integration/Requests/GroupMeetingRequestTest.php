<?php


namespace Tests\Integration\Requests;


use CTApi\Models\GroupMeeting;
use CTApi\Models\GroupMeetingMember;
use CTApi\Requests\GroupRequest;
use Tests\Integration\IntegrationTestData;
use Tests\Integration\TestCaseAuthenticated;

class GroupMeetingRequestTest extends TestCaseAuthenticated
{
    private int $groupId;

    private string $filterStartDate;
    private string $filterEndDate;

    private string $date;
    private int $present;
    private int $absent;
    private int $unsure;
    private int $guests;
    private string $comment;

    private string $anyMememberId;

    protected function setUp(): void
    {
        $this->groupId = IntegrationTestData::getFilterAsInt("update_group_meeting", "group_id");
        $this->filterStartDate = IntegrationTestData::getFilter("update_group_meeting", "start_date");
        $this->filterEndDate = IntegrationTestData::getFilter("update_group_meeting", "end_date");

        $this->date = IntegrationTestData::getResult("update_group_meeting", "last_group_meeting.date");
        $this->present = IntegrationTestData::getResultAsInt("update_group_meeting", "last_group_meeting.present");
        $this->absent = IntegrationTestData::getResultAsInt("update_group_meeting", "last_group_meeting.absent");
        $this->unsure = IntegrationTestData::getResultAsInt("update_group_meeting", "last_group_meeting.unsure");
        $this->guests = IntegrationTestData::getResultAsInt("update_group_meeting", "last_group_meeting.guests");
        $this->comment = IntegrationTestData::getResult("update_group_meeting", "last_group_meeting.comment");

        $this->anyMememberId = IntegrationTestData::getResult("update_group_meeting", "last_group_meeting.any_member.id");
        parent::setUp();
    }

    public function testGetMeeting()
    {
        $meeting = $this->requestMeeting();
        $this->assertInstanceOf(GroupMeeting::class, $meeting);

        $this->assertEquals($this->date, $meeting->getDateFrom());
        $this->assertEquals($this->comment, $meeting->getComment());
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
        $foundMember = null;
        foreach ($members as $member) {
            $this->assertInstanceOf(GroupMeetingMember::class, $member);
            if (is_a($member, GroupMeetingMember::class)) {
                $personId = $member->getMember()?->getPersonId();
                if ($personId == $this->anyMememberId) {
                    $foundMember = $member;
                }
            }
        }
        $this->assertNotNull($foundMember);
    }
}