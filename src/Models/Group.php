<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\GroupMemberRequestBuilder;

class Group
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $guid = null;
    protected ?string $name = null;
    protected ?string $securityLevelForGroup = null;
    protected array $permissions = [];
    protected array $information = [];
    protected ?GroupSettings $settings = null;
    protected array $followUp = [];
    protected array $roles = [];


    protected function fillNonArrayType(string $key, $value)
    {
        switch ($key) {
            case "title":
                $this->setName($value);
                break;
            case "domainIdentifier":
                $this->setId($value);
                break;
            default:
                $this->{$key} = $value;
        }
    }

    protected function fillArrayType(string $key, array $data)
    {
        switch ($key) {
            case "roles":
                $this->setRoles(GroupRole::createModelsFromArray($data));
                break;
            case "settings":
                $this->setSettings(GroupSettings::createModelFromData($data));
                break;
            default:
                $this->{$key} = $data;
        }
    }


    public function requestMembers(): ?GroupMemberRequestBuilder
    {
        if ($this->getId() != null) {
            return new GroupMemberRequestBuilder((int)$this->getId());
        } else {
            return null;
        }
    }

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
     * @return GroupSettings|null
     */
    public function getSettings(): ?GroupSettings
    {
        return $this->settings;
    }

    /**
     * @param GroupSettings|null $settings
     * @return Group
     */
    public function setSettings(?GroupSettings $settings): Group
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