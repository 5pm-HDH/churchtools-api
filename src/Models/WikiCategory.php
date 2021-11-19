<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Requests\WikiPageRequestBuilder;

class WikiCategory
{
    use FillWithData;

    protected ?string $id = null;
    protected ?string $name = null;
    protected ?string $nameTranslated = null;
    protected ?string $sortKey = null;
    protected ?string $campusId = null;
    protected ?string $inMenu = null;
    protected ?string $fileAccessWithoutPermission = null;
    protected array $permissions = [];

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "permissions":
                break;
            default:
                $this->{$key} = $value;
        }
    }

    public function requestPages(): ?WikiPageRequestBuilder
    {
        if (!is_null($this->getId())) {
            return new WikiPageRequestBuilder((int)$this->getId());
        } else {
            return null;
        }
    }

    public function requestPage(string $identifier): ?WikiPage
    {
        if (!is_null($this->getId())) {
            return WikiPageRequestBuilder::requestPageFromCategoryAndIdentifier( (string) $this->getId(), $identifier);
        } else {
            return null;
        }
    }

    public function requestWikiPageTree(): ?WikiPageTreeNode
    {
        $pages = $this->requestPages()?->get() ?? [];
        return WikiPageTreeNode::processWikiPagesReturnRootNode($pages);
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
     * @return WikiCategory
     */
    public function setId(?string $id): WikiCategory
    {
        $this->id = $id;
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
     * @return WikiCategory
     */
    public function setName(?string $name): WikiCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameTranslated(): ?string
    {
        return $this->nameTranslated;
    }

    /**
     * @param string|null $nameTranslated
     * @return WikiCategory
     */
    public function setNameTranslated(?string $nameTranslated): WikiCategory
    {
        $this->nameTranslated = $nameTranslated;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortKey(): ?string
    {
        return $this->sortKey;
    }

    /**
     * @param string|null $sortKey
     * @return WikiCategory
     */
    public function setSortKey(?string $sortKey): WikiCategory
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCampusId(): ?string
    {
        return $this->campusId;
    }

    /**
     * @param string|null $campusId
     * @return WikiCategory
     */
    public function setCampusId(?string $campusId): WikiCategory
    {
        $this->campusId = $campusId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInMenu(): ?string
    {
        return $this->inMenu;
    }

    /**
     * @param string|null $inMenu
     * @return WikiCategory
     */
    public function setInMenu(?string $inMenu): WikiCategory
    {
        $this->inMenu = $inMenu;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileAccessWithoutPermission(): ?string
    {
        return $this->fileAccessWithoutPermission;
    }

    /**
     * @param string|null $fileAccessWithoutPermission
     * @return WikiCategory
     */
    public function setFileAccessWithoutPermission(?string $fileAccessWithoutPermission): WikiCategory
    {
        $this->fileAccessWithoutPermission = $fileAccessWithoutPermission;
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
     * @return WikiCategory
     */
    public function setPermissions(array $permissions): WikiCategory
    {
        $this->permissions = $permissions;
        return $this;
    }
}