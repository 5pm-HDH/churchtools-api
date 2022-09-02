<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class PermissionChurchResource
{
    use FillWithData;

    protected ?bool $view = null;
    protected array $view_resource = [];
    protected array $create_bookings = [];
    protected ?bool $create_virtual_bookings = null;
    protected array $administer_bookings = [];
    protected ?bool $assistance_mode = null;
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
     * @return PermissionChurchResource
     */
    public function setView(?bool $view): PermissionChurchResource
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewResource(): array
    {
        return $this->view_resource;
    }

    /**
     * @param array $view_resource
     * @return PermissionChurchResource
     */
    public function setViewResource(array $view_resource): PermissionChurchResource
    {
        $this->view_resource = $view_resource;
        return $this;
    }

    /**
     * @return array
     */
    public function getCreateBookings(): array
    {
        return $this->create_bookings;
    }

    /**
     * @param array $create_bookings
     * @return PermissionChurchResource
     */
    public function setCreateBookings(array $create_bookings): PermissionChurchResource
    {
        $this->create_bookings = $create_bookings;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCreateVirtualBookings(): ?bool
    {
        return $this->create_virtual_bookings;
    }

    /**
     * @param bool|null $create_virtual_bookings
     * @return PermissionChurchResource
     */
    public function setCreateVirtualBookings(?bool $create_virtual_bookings): PermissionChurchResource
    {
        $this->create_virtual_bookings = $create_virtual_bookings;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdministerBookings(): array
    {
        return $this->administer_bookings;
    }

    /**
     * @param array $administer_bookings
     * @return PermissionChurchResource
     */
    public function setAdministerBookings(array $administer_bookings): PermissionChurchResource
    {
        $this->administer_bookings = $administer_bookings;
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
     * @return PermissionChurchResource
     */
    public function setAssistanceMode(?bool $assistance_mode): PermissionChurchResource
    {
        $this->assistance_mode = $assistance_mode;
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
     * @return PermissionChurchResource
     */
    public function setEditMasterdata(?bool $edit_masterdata): PermissionChurchResource
    {
        $this->edit_masterdata = $edit_masterdata;
        return $this;
    }
}