<?php

namespace CTApi\Models\Common\Permission;

use CTApi\Traits\Model\FillWithData;

class PermissionGlobal
{
    use FillWithData;

    protected ?PermissionChurchCore $churchcore = null;
    protected ?PermissionChurchDb $churchdb = null;
    protected ?PermissionChurchCal $churchcal = null;
    protected ?PermissionChurchResource $churchresource = null;
    protected ?PermissionChurchService $churchservice = null;
    protected ?PermissionChurchWiki $churchwiki = null;
    protected ?PermissionChurchCheckin $churchcheckin = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "churchcore":
                $this->churchcore = PermissionChurchCore::createModelFromData($data);
                break;
            case "churchdb":
                $this->churchdb = PermissionChurchDb::createModelFromData($data);
                break;
            case "churchcal":
                $this->churchcal = PermissionChurchCal::createModelFromData($data);
                break;
            case "churchresource":
                $this->churchresource = PermissionChurchResource::createModelFromData($data);
                break;
            case "churchservice":
                $this->churchservice = PermissionChurchService::createModelFromData($data);
                break;
            case "churchwiki":
                $this->churchwiki = PermissionChurchWiki::createModelFromData($data);
                break;
            case "churchcheckin":
                $this->churchcheckin = PermissionChurchCheckin::createModelFromData($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    /**
     * @return PermissionChurchCore|null
     */
    public function getChurchcore(): ?PermissionChurchCore
    {
        return $this->churchcore;
    }

    /**
     * @param PermissionChurchCore|null $churchcore
     * @return PermissionGlobal
     */
    public function setChurchcore(?PermissionChurchCore $churchcore): PermissionGlobal
    {
        $this->churchcore = $churchcore;
        return $this;
    }

    /**
     * @return PermissionChurchDb|null
     */
    public function getChurchdb(): ?PermissionChurchDb
    {
        return $this->churchdb;
    }

    /**
     * @param PermissionChurchDb|null $churchdb
     * @return PermissionGlobal
     */
    public function setChurchdb(?PermissionChurchDb $churchdb): PermissionGlobal
    {
        $this->churchdb = $churchdb;
        return $this;
    }

    /**
     * @return PermissionChurchCal|null
     */
    public function getChurchcal(): ?PermissionChurchCal
    {
        return $this->churchcal;
    }

    /**
     * @param PermissionChurchCal|null $churchcal
     * @return PermissionGlobal
     */
    public function setChurchcal(?PermissionChurchCal $churchcal): PermissionGlobal
    {
        $this->churchcal = $churchcal;
        return $this;
    }

    /**
     * @return PermissionChurchResource|null
     */
    public function getChurchresource(): ?PermissionChurchResource
    {
        return $this->churchresource;
    }

    /**
     * @param PermissionChurchResource|null $churchresource
     * @return PermissionGlobal
     */
    public function setChurchresource(?PermissionChurchResource $churchresource): PermissionGlobal
    {
        $this->churchresource = $churchresource;
        return $this;
    }

    /**
     * @return PermissionChurchService|null
     */
    public function getChurchservice(): ?PermissionChurchService
    {
        return $this->churchservice;
    }

    /**
     * @param PermissionChurchService|null $churchservice
     * @return PermissionGlobal
     */
    public function setChurchservice(?PermissionChurchService $churchservice): PermissionGlobal
    {
        $this->churchservice = $churchservice;
        return $this;
    }

    /**
     * @return PermissionChurchWiki|null
     */
    public function getChurchwiki(): ?PermissionChurchWiki
    {
        return $this->churchwiki;
    }

    /**
     * @param PermissionChurchWiki|null $churchwiki
     * @return PermissionGlobal
     */
    public function setChurchwiki(?PermissionChurchWiki $churchwiki): PermissionGlobal
    {
        $this->churchwiki = $churchwiki;
        return $this;
    }

    /**
     * @return PermissionChurchCheckin|null
     */
    public function getChurchcheckin(): ?PermissionChurchCheckin
    {
        return $this->churchcheckin;
    }

    /**
     * @param PermissionChurchCheckin|null $churchcheckin
     * @return PermissionGlobal
     */
    public function setChurchcheckin(?PermissionChurchCheckin $churchcheckin): PermissionGlobal
    {
        $this->churchcheckin = $churchcheckin;
        return $this;
    }
}
