<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class PermissionChurchCheckin
{
    use FillWithData;

    protected ?bool $view = null;
    protected ?bool $create_person = null;
    protected ?bool $edit_masterdata = null;

    /**
     * @return bool|null
     */
    public function getView(): ?bool
    {
        return $this->view;
    }

    /**
     * @param bool|null $view
     * @return PermissionChurchCheckin
     */
    public function setView(?bool $view): PermissionChurchCheckin
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCreatePerson(): ?bool
    {
        return $this->create_person;
    }

    /**
     * @param bool|null $create_person
     * @return PermissionChurchCheckin
     */
    public function setCreatePerson(?bool $create_person): PermissionChurchCheckin
    {
        $this->create_person = $create_person;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditMasterdata(): ?bool
    {
        return $this->edit_masterdata;
    }

    /**
     * @param bool|null $edit_masterdata
     * @return PermissionChurchCheckin
     */
    public function setEditMasterdata(?bool $edit_masterdata): PermissionChurchCheckin
    {
        $this->edit_masterdata = $edit_masterdata;
        return $this;
    }


}