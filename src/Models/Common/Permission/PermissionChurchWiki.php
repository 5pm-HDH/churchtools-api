<?php


namespace CTApi\Models\Common\Permission;


use CTApi\Traits\Model\FillWithData;

class PermissionChurchWiki
{
    use FillWithData;

    protected ?bool $view = null;
    protected array $view_category = [];
    protected array $edit_category = [];
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
     * @return PermissionChurchWiki
     */
    public function setView(?bool $view): PermissionChurchWiki
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
     * @return PermissionChurchWiki
     */
    public function setViewCategory(array $view_category): PermissionChurchWiki
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
     * @return PermissionChurchWiki
     */
    public function setEditCategory(array $edit_category): PermissionChurchWiki
    {
        $this->edit_category = $edit_category;
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
     * @return PermissionChurchWiki
     */
    public function setEditMasterdata(?bool $edit_masterdata): PermissionChurchWiki
    {
        $this->edit_masterdata = $edit_masterdata;
        return $this;
    }
}