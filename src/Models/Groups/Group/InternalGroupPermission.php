<?php

namespace CTApi\Models\Groups\Group;

use CTApi\Traits\Model\FillWithData;

class InternalGroupPermission
{
    use FillWithData;

    protected ?int $see_persons = null;
    protected ?int $see_group = null;
    protected ?bool $see_group_tags = null;
    protected ?bool $add_person = null;
    protected ?bool $edit_groupmemberstatus = null;
    protected ?bool $get_emails = null;
    protected ?bool $do_followup = null;
    protected ?bool $do_group_meeting = null;
    protected ?bool $export_group_members = null;
    protected ?bool $mail_group_members = null;
    protected ?bool $edit_group_hierachy = null;
    protected ?bool $see_hidden_group = null;
    protected ?bool $edit_group = null;
    protected ?bool $admin_group_fields = null;
    protected ?bool $admin_automatic_emails = null;
    protected ?bool $remove_from_group = null;
    protected ?bool $admin_group_chat = null;

    protected function fillArrayType(string $key, array $data): void
    {
        if ($key == "churchdb") { // inline churchdb-object
            $this->fillWithData($data);
            return;
        }
        $this->fillDefault($key, $data);
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        $key = str_replace("+", "", $key); // remove +-sign
        $this->fillDefault($key, $value);
    }

    /**
     * @return int|null
     */
    public function getSeePersons(): ?int
    {
        return $this->see_persons;
    }

    /**
     * @param int|null $see_persons
     * @return InternalGroupPermission
     */
    public function setSeePersons(?int $see_persons): InternalGroupPermission
    {
        $this->see_persons = $see_persons;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSeeGroup(): ?int
    {
        return $this->see_group;
    }

    /**
     * @param int|null $see_group
     * @return InternalGroupPermission
     */
    public function setSeeGroup(?int $see_group): InternalGroupPermission
    {
        $this->see_group = $see_group;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSeeGroupTags(): ?bool
    {
        return $this->see_group_tags;
    }

    /**
     * @param bool|null $see_group_tags
     * @return InternalGroupPermission
     */
    public function setSeeGroupTags(?bool $see_group_tags): InternalGroupPermission
    {
        $this->see_group_tags = $see_group_tags;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAddPerson(): ?bool
    {
        return $this->add_person;
    }

    /**
     * @param bool|null $add_person
     * @return InternalGroupPermission
     */
    public function setAddPerson(?bool $add_person): InternalGroupPermission
    {
        $this->add_person = $add_person;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditGroupmemberstatus(): ?bool
    {
        return $this->edit_groupmemberstatus;
    }

    /**
     * @param bool|null $edit_groupmemberstatus
     * @return InternalGroupPermission
     */
    public function setEditGroupmemberstatus(?bool $edit_groupmemberstatus): InternalGroupPermission
    {
        $this->edit_groupmemberstatus = $edit_groupmemberstatus;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getGetEmails(): ?bool
    {
        return $this->get_emails;
    }

    /**
     * @param bool|null $get_emails
     * @return InternalGroupPermission
     */
    public function setGetEmails(?bool $get_emails): InternalGroupPermission
    {
        $this->get_emails = $get_emails;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDoFollowup(): ?bool
    {
        return $this->do_followup;
    }

    /**
     * @param bool|null $do_followup
     * @return InternalGroupPermission
     */
    public function setDoFollowup(?bool $do_followup): InternalGroupPermission
    {
        $this->do_followup = $do_followup;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDoGroupMeeting(): ?bool
    {
        return $this->do_group_meeting;
    }

    /**
     * @param bool|null $do_group_meeting
     * @return InternalGroupPermission
     */
    public function setDoGroupMeeting(?bool $do_group_meeting): InternalGroupPermission
    {
        $this->do_group_meeting = $do_group_meeting;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExportGroupMembers(): ?bool
    {
        return $this->export_group_members;
    }

    /**
     * @param bool|null $export_group_members
     * @return InternalGroupPermission
     */
    public function setExportGroupMembers(?bool $export_group_members): InternalGroupPermission
    {
        $this->export_group_members = $export_group_members;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMailGroupMembers(): ?bool
    {
        return $this->mail_group_members;
    }

    /**
     * @param bool|null $mail_group_members
     * @return InternalGroupPermission
     */
    public function setMailGroupMembers(?bool $mail_group_members): InternalGroupPermission
    {
        $this->mail_group_members = $mail_group_members;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditGroupHierachy(): ?bool
    {
        return $this->edit_group_hierachy;
    }

    /**
     * @param bool|null $edit_group_hierachy
     * @return InternalGroupPermission
     */
    public function setEditGroupHierachy(?bool $edit_group_hierachy): InternalGroupPermission
    {
        $this->edit_group_hierachy = $edit_group_hierachy;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSeeHiddenGroup(): ?bool
    {
        return $this->see_hidden_group;
    }

    /**
     * @param bool|null $see_hidden_group
     * @return InternalGroupPermission
     */
    public function setSeeHiddenGroup(?bool $see_hidden_group): InternalGroupPermission
    {
        $this->see_hidden_group = $see_hidden_group;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditGroup(): ?bool
    {
        return $this->edit_group;
    }

    /**
     * @param bool|null $edit_group
     * @return InternalGroupPermission
     */
    public function setEditGroup(?bool $edit_group): InternalGroupPermission
    {
        $this->edit_group = $edit_group;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdminGroupFields(): ?bool
    {
        return $this->admin_group_fields;
    }

    /**
     * @param bool|null $admin_group_fields
     * @return InternalGroupPermission
     */
    public function setAdminGroupFields(?bool $admin_group_fields): InternalGroupPermission
    {
        $this->admin_group_fields = $admin_group_fields;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdminAutomaticEmails(): ?bool
    {
        return $this->admin_automatic_emails;
    }

    /**
     * @param bool|null $admin_automatic_emails
     * @return InternalGroupPermission
     */
    public function setAdminAutomaticEmails(?bool $admin_automatic_emails): InternalGroupPermission
    {
        $this->admin_automatic_emails = $admin_automatic_emails;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRemoveFromGroup(): ?bool
    {
        return $this->remove_from_group;
    }

    /**
     * @param bool|null $remove_from_group
     * @return InternalGroupPermission
     */
    public function setRemoveFromGroup(?bool $remove_from_group): InternalGroupPermission
    {
        $this->remove_from_group = $remove_from_group;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdminGroupChat(): ?bool
    {
        return $this->admin_group_chat;
    }

    /**
     * @param bool|null $admin_group_chat
     * @return InternalGroupPermission
     */
    public function setAdminGroupChat(?bool $admin_group_chat): InternalGroupPermission
    {
        $this->admin_group_chat = $admin_group_chat;
        return $this;
    }
}
