<?php

namespace CTApi\Models\Common\Permission;

use CTApi\Traits\Model\FillWithData;

class PermissionChurchCal
{
    use FillWithData;

    protected ?bool $view = null;
    protected array $view_category = [];
    protected array $edit_category = [];
    protected array $edit_calendar_entry_template = [];
    protected ?bool $assistance_mode = null;
    protected ?bool $create_personal_category = null;
    protected ?bool $admin_personal_category = null;
    protected ?bool $create_group_category = null;
    protected ?bool $admin_group_category = null;
    protected ?bool $admin_church_category = null;

    /**
     * @return bool|null
     */
    public function getView(): ?bool
    {
        return $this->view;
    }

    /**
     * @param bool|null $view
     * @return PermissionChurchCal
     */
    public function setView(?bool $view): PermissionChurchCal
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewCategory(): array
    {
        return $this->view_category;
    }

    /**
     * @param array $view_category
     * @return PermissionChurchCal
     */
    public function setViewCategory(array $view_category): PermissionChurchCal
    {
        $this->view_category = $view_category;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditCategory(): array
    {
        return $this->edit_category;
    }

    /**
     * @param array $edit_category
     * @return PermissionChurchCal
     */
    public function setEditCategory(array $edit_category): PermissionChurchCal
    {
        $this->edit_category = $edit_category;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditCalendarEntryTemplate(): array
    {
        return $this->edit_calendar_entry_template;
    }

    /**
     * @param array $edit_calendar_entry_template
     * @return PermissionChurchCal
     */
    public function setEditCalendarEntryTemplate(array $edit_calendar_entry_template): PermissionChurchCal
    {
        $this->edit_calendar_entry_template = $edit_calendar_entry_template;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAssistanceMode(): ?bool
    {
        return $this->assistance_mode;
    }

    /**
     * @param bool|null $assistance_mode
     * @return PermissionChurchCal
     */
    public function setAssistanceMode(?bool $assistance_mode): PermissionChurchCal
    {
        $this->assistance_mode = $assistance_mode;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCreatePersonalCategory(): ?bool
    {
        return $this->create_personal_category;
    }

    /**
     * @param bool|null $create_personal_category
     * @return PermissionChurchCal
     */
    public function setCreatePersonalCategory(?bool $create_personal_category): PermissionChurchCal
    {
        $this->create_personal_category = $create_personal_category;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdminPersonalCategory(): ?bool
    {
        return $this->admin_personal_category;
    }

    /**
     * @param bool|null $admin_personal_category
     * @return PermissionChurchCal
     */
    public function setAdminPersonalCategory(?bool $admin_personal_category): PermissionChurchCal
    {
        $this->admin_personal_category = $admin_personal_category;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCreateGroupCategory(): ?bool
    {
        return $this->create_group_category;
    }

    /**
     * @param bool|null $create_group_category
     * @return PermissionChurchCal
     */
    public function setCreateGroupCategory(?bool $create_group_category): PermissionChurchCal
    {
        $this->create_group_category = $create_group_category;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdminGroupCategory(): ?bool
    {
        return $this->admin_group_category;
    }

    /**
     * @param bool|null $admin_group_category
     * @return PermissionChurchCal
     */
    public function setAdminGroupCategory(?bool $admin_group_category): PermissionChurchCal
    {
        $this->admin_group_category = $admin_group_category;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdminChurchCategory(): ?bool
    {
        return $this->admin_church_category;
    }

    /**
     * @param bool|null $admin_church_category
     * @return PermissionChurchCal
     */
    public function setAdminChurchCategory(?bool $admin_church_category): PermissionChurchCal
    {
        $this->admin_church_category = $admin_church_category;
        return $this;
    }
}
