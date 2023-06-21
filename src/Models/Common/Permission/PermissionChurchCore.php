<?php


namespace CTApi\Models\Common\Permission;


use CTApi\Traits\Model\FillWithData;

class PermissionChurchCore
{
    use FillWithData;

    protected ?bool $administer_settings = null;
    protected ?bool $edit_public_relations = null;
    protected ?bool $edit_translations_masterdata = null;
    protected array $edit_languages = [];
    protected ?bool $administer_persons = null;
    protected ?bool $view_logfile = null;
    protected ?bool $invite_persons = null;
    protected ?bool $simulate_persons = null;

    /**
     * @return bool|null
     */
    public function getAdministerSettings(): ?bool
    {
        return $this->administer_settings;
    }

    /**
     * @param bool|null $administer_settings
     * @return PermissionChurchCore
     */
    public function setAdministerSettings(?bool $administer_settings): PermissionChurchCore
    {
        $this->administer_settings = $administer_settings;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditPublicRelations(): ?bool
    {
        return $this->edit_public_relations;
    }

    /**
     * @param bool|null $edit_public_relations
     * @return PermissionChurchCore
     */
    public function setEditPublicRelations(?bool $edit_public_relations): PermissionChurchCore
    {
        $this->edit_public_relations = $edit_public_relations;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditTranslationsMasterdata(): ?bool
    {
        return $this->edit_translations_masterdata;
    }

    /**
     * @param bool|null $edit_translations_masterdata
     * @return PermissionChurchCore
     */
    public function setEditTranslationsMasterdata(?bool $edit_translations_masterdata): PermissionChurchCore
    {
        $this->edit_translations_masterdata = $edit_translations_masterdata;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditLanguages(): array
    {
        return $this->edit_languages;
    }

    /**
     * @param array $edit_languages
     * @return PermissionChurchCore
     */
    public function setEditLanguages(array $edit_languages): PermissionChurchCore
    {
        $this->edit_languages = $edit_languages;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdministerPersons(): ?bool
    {
        return $this->administer_persons;
    }

    /**
     * @param bool|null $administer_persons
     * @return PermissionChurchCore
     */
    public function setAdministerPersons(?bool $administer_persons): PermissionChurchCore
    {
        $this->administer_persons = $administer_persons;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewLogfile(): ?bool
    {
        return $this->view_logfile;
    }

    /**
     * @param bool|null $view_logfile
     * @return PermissionChurchCore
     */
    public function setViewLogfile(?bool $view_logfile): PermissionChurchCore
    {
        $this->view_logfile = $view_logfile;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getInvitePersons(): ?bool
    {
        return $this->invite_persons;
    }

    /**
     * @param bool|null $invite_persons
     * @return PermissionChurchCore
     */
    public function setInvitePersons(?bool $invite_persons): PermissionChurchCore
    {
        $this->invite_persons = $invite_persons;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSimulatePersons(): ?bool
    {
        return $this->simulate_persons;
    }

    /**
     * @param bool|null $simulate_persons
     * @return PermissionChurchCore
     */
    public function setSimulatePersons(?bool $simulate_persons): PermissionChurchCore
    {
        $this->simulate_persons = $simulate_persons;
        return $this;
    }
}