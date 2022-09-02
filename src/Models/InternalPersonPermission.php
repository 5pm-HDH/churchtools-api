<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class InternalPersonPermission
{
    use FillWithData;

    protected ?int $see_persons = null;
    protected ?bool $invite_person = null;
    protected ?bool $see_tags = null;
    protected ?bool $edit_persons = null;
    protected ?bool $do_followup = null;

    protected function fillArrayType(string $key, array $data): void
    {
        if ($key == "churchdb") { // inline "churchdb"-object
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
     * @return InternalPersonPermission
     */
    public function setSeePersons(?int $see_persons): InternalPersonPermission
    {
        $this->see_persons = $see_persons;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getInvitePerson(): ?bool
    {
        return $this->invite_person;
    }

    /**
     * @param bool|null $invite_person
     * @return InternalPersonPermission
     */
    public function setInvitePerson(?bool $invite_person): InternalPersonPermission
    {
        $this->invite_person = $invite_person;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSeeTags(): ?bool
    {
        return $this->see_tags;
    }

    /**
     * @param bool|null $see_tags
     * @return InternalPersonPermission
     */
    public function setSeeTags(?bool $see_tags): InternalPersonPermission
    {
        $this->see_tags = $see_tags;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditPersons(): ?bool
    {
        return $this->edit_persons;
    }

    /**
     * @param bool|null $edit_persons
     * @return InternalPersonPermission
     */
    public function setEditPersons(?bool $edit_persons): InternalPersonPermission
    {
        $this->edit_persons = $edit_persons;
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
     * @return InternalPersonPermission
     */
    public function setDoFollowup(?bool $do_followup): InternalPersonPermission
    {
        $this->do_followup = $do_followup;
        return $this;
    }
}