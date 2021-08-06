<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class Group
{
    use FillWithData;

    protected ?string $id;
    protected ?string $guid;
    protected ?string $name;
    protected ?string $securityLevelForGroup;
    protected array $permissions = [];
    protected array $information = [];
    protected array $settings = [];
    protected array $followUp = [];
    protected array $roles = [];

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return Group
     */
    public function setId(?string $id): Group
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGuid(): ?string
    {
        return $this->guid;
    }

    /**
     * @param string|null $guid
     * @return Group
     */
    public function setGuid(?string $guid): Group
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Group
     */
    public function setName(?string $name): Group
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecurityLevelForGroup(): ?string
    {
        return $this->securityLevelForGroup;
    }

    /**
     * @param string|null $securityLevelForGroup
     * @return Group
     */
    public function setSecurityLevelForGroup(?string $securityLevelForGroup): Group
    {
        $this->securityLevelForGroup = $securityLevelForGroup;
        return $this;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     * @return Group
     */
    public function setPermissions(array $permissions): Group
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return array
     */
    public function getInformation(): array
    {
        return $this->information;
    }

    /**
     * @param array $information
     * @return Group
     */
    public function setInformation(array $information): Group
    {
        $this->information = $information;
        return $this;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     * @return Group
     */
    public function setSettings(array $settings): Group
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @return array
     */
    public function getFollowUp(): array
    {
        return $this->followUp;
    }

    /**
     * @param array $followUp
     * @return Group
     */
    public function setFollowUp(array $followUp): Group
    {
        $this->followUp = $followUp;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return Group
     */
    public function setRoles(array $roles): Group
    {
        $this->roles = $roles;
        return $this;
    }
}