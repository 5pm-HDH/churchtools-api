<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;
use CTApi\Requests\WikiPageFilesRequestBuilder;
use CTApi\Requests\WikiPageRequestBuilder;
use CTApi\Requests\WikiPageVersionRequestBuilder;

class WikiPage
{
    use FillWithData, MetaAttribute;

    protected ?string $identifier = null;
    protected ?string $title = null;
    protected ?WikiCategory $wikiCategory = null;
    protected ?string $version = null;
    protected ?bool $onStartpage = null;
    protected ?string $redirectTo = null;
    protected array $permissions = [];
    protected ?bool $isMarkdown = null;
    protected ?string $text = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "wikiCategory":
                $this->setWikiCategory(WikiCategory::createModelFromData($data));
                break;
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            case "permissions":
                $this->setPermissions($data);
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "permissions":
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    public function requestVersions(): ?WikiPageVersionRequestBuilder
    {
        $requestedWikiCategory = $this->getWikiCategory()?->getId();
        $requestedIdentifier = $this->getIdentifier();
        if (!is_null($requestedWikiCategory) && !is_null($requestedIdentifier)) {
            return new WikiPageVersionRequestBuilder($requestedWikiCategory, $requestedIdentifier);
        }
        return null;
    }

    public function requestVersion(int $versionId): ?WikiPage
    {
        $requestedWikiCategory = $this->getWikiCategory()?->getId();
        $requestedIdentifier = $this->getIdentifier();
        if (!is_null($requestedWikiCategory) && !is_null($requestedIdentifier)) {
            return WikiPageVersionRequestBuilder::requestPageVersion($requestedWikiCategory, $requestedIdentifier, $versionId);
        }
        return null;
    }

    public function requestText(): self
    {
        $requestedWikiCategory = $this->getWikiCategory()?->getId();
        $requestedIdentifier = $this->getIdentifier();
        if (!is_null($requestedWikiCategory) && !is_null($requestedIdentifier)) {
            $page = WikiPageRequestBuilder::requestPageFromCategoryAndIdentifier($requestedWikiCategory, $requestedIdentifier);
            $this->setText($page?->getText());
        }
        return $this;
    }

    public function requestFiles(): ?WikiPageFilesRequestBuilder
    {
        $requestedWikiCategory = $this->getWikiCategory()?->getId();
        $requestedIdentifier = $this->getIdentifier();
        if (!is_null($requestedWikiCategory) && !is_null($requestedIdentifier)) {
            return (new WikiPageFilesRequestBuilder($requestedWikiCategory, $requestedIdentifier));
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string|null $identifier
     * @return WikiPage
     */
    public function setIdentifier(?string $identifier): WikiPage
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return WikiPage
     */
    public function setTitle(?string $title): WikiPage
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return WikiCategory|null
     */
    public function getWikiCategory(): ?WikiCategory
    {
        return $this->wikiCategory;
    }

    /**
     * @param WikiCategory|null $wikiCategory
     * @return WikiPage
     */
    public function setWikiCategory(?WikiCategory $wikiCategory): WikiPage
    {
        $this->wikiCategory = $wikiCategory;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param string|null $version
     * @return WikiPage
     */
    public function setVersion(?string $version): WikiPage
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getOnStartpage(): ?bool
    {
        return $this->onStartpage;
    }

    /**
     * @param bool|null $onStartpage
     * @return WikiPage
     */
    public function setOnStartpage(?bool $onStartpage): WikiPage
    {
        $this->onStartpage = $onStartpage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedirectTo(): ?string
    {
        return $this->redirectTo;
    }

    /**
     * @param string|null $redirectTo
     * @return WikiPage
     */
    public function setRedirectTo(?string $redirectTo): WikiPage
    {
        $this->redirectTo = $redirectTo;
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
     * @return WikiPage
     */
    public function setPermissions(array $permissions): WikiPage
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsMarkdown(): ?bool
    {
        return $this->isMarkdown;
    }

    /**
     * @param bool|null $isMarkdown
     * @return WikiPage
     */
    public function setIsMarkdown(?bool $isMarkdown): WikiPage
    {
        $this->isMarkdown = $isMarkdown;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return WikiPage
     */
    public function setText(?string $text): WikiPage
    {
        $this->text = $text;
        return $this;
    }
}