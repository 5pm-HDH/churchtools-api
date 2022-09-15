<?php


namespace CTApi\Models;


use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\CTLog;
use CTApi\Exceptions\CTRequestException;
use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;

class File
{
    use FillWithData, MetaAttribute;

    protected ?string $id = null;
    protected ?string $imageUrl = null;
    protected ?string $type = null;
    protected ?string $size = null;
    protected ?string $domainType = null;
    protected ?string $domainId = null;
    protected ?string $name = null;
    protected ?string $filename = null;
    protected ?string $fileUrl = null;
    protected ?string $relativeUrl = null;
    protected ?bool $showOnlyWhenEditable = null;
    protected ?string $securityLevelId = null;

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
        }
    }

    public function downloadToPath($path): bool
    {
        $fileContent = $this->requestFileContent();
        if (is_string($fileContent)) {
            return (bool)file_put_contents($path . '/' . $this->name, $fileContent);
        } else {
            CTLog::getLog()->warning("Could not download file-content to path. Invalid file content.");
            return false;
        }
    }

    public function downloadToClient(): void
    {
        header("Content-disposition: attachment;filename=" . $this->name);
        echo $this->requestFileContent();
    }

    public function requestFileContent(): bool|string
    {
        try {
            $baseUrl = $this->getFileUrlBaseUrl();
            if (!is_null($baseUrl)) {
                $response = CTClient::getClient()->get($baseUrl, [
                    'headers' => [
                        'Cache-Control' => 'no-cache'
                    ],
                    'query' => $this->getFileUrlQueryParameters()
                ]);
                return (string)$response->getBody();
            }
        } catch (CTRequestException $e) {
            CTLog::getLog()->error('File: Could not retrieve file-content.');
            // ignore
        }
        return false;
    }


    public function getFileUrlAuthenticated(): ?string
    {
        $fileUrl2 = $this->getFileUrl();
        $apiKey = CTConfig::getApiKey();
        if (is_null($fileUrl2) || is_null($apiKey)) {
            return null;
        }

        return $fileUrl2 . "&login_token=" . $apiKey;
    }

    public function getFileUrlBaseUrl(): ?string
    {
        $fileUrlBase = null;

        $parsedUrl = parse_url((string)$this->getFileUrl());
        if (array_key_exists('scheme', $parsedUrl) && array_key_exists('host', $parsedUrl)) {
            $fileUrlBase = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

            if (array_key_exists('path', $parsedUrl)) {
                $fileUrlBase .= $parsedUrl['path'];
            }
        }
        return $fileUrlBase;
    }

    public function getFileUrlQueryParameters(): array
    {
        $query = [];
        $parsedUrl = parse_url((string)$this->getFileUrl());
        if (array_key_exists('query', $parsedUrl)) {
            $queryString = (string)$parsedUrl['query'];

            foreach (explode('&', $queryString) as $querySubstring) {
                $querySubstringArray = explode('=', $querySubstring);
                if (sizeof($querySubstringArray) == 2) {
                    $query[$querySubstringArray[0]] = $querySubstringArray[1];
                }
            }
        }
        return $query;
    }

    /**
     * @return string|null
     */
    public function getRelativeUrl(): ?string
    {
        return $this->relativeUrl;
    }

    /**
     * @param string|null $relativeUrl
     * @return File
     */
    public function setRelativeUrl(?string $relativeUrl): File
    {
        $this->relativeUrl = $relativeUrl;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowOnlyWhenEditable(): ?bool
    {
        return $this->showOnlyWhenEditable;
    }

    /**
     * @param bool|null $showOnlyWhenEditable
     * @return File
     */
    public function setShowOnlyWhenEditable(?bool $showOnlyWhenEditable): File
    {
        $this->showOnlyWhenEditable = $showOnlyWhenEditable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecurityLevelId(): ?string
    {
        return $this->securityLevelId;
    }

    /**
     * @param string|null $securityLevelId
     * @return File
     */
    public function setSecurityLevelId(?string $securityLevelId): File
    {
        $this->securityLevelId = $securityLevelId;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomainType(): ?string
    {
        return $this->domainType;
    }

    /**
     * @param string|null $domainType
     * @return File
     */
    public function setDomainType(?string $domainType): File
    {
        $this->domainType = $domainType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomainId(): ?string
    {
        return $this->domainId;
    }

    /**
     * @param string|null $domainId
     * @return File
     */
    public function setDomainId(?string $domainId): File
    {
        $this->domainId = $domainId;
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
     * @return File
     */
    public function setName(?string $name): File
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return File
     */
    public function setFilename(?string $filename): File
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    /**
     * @param string|null $fileUrl
     * @return File
     */
    public function setFileUrl(?string $fileUrl): File
    {
        $this->fileUrl = $fileUrl;
        return $this;
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
     * @return File
     */
    public function setId(?string $id): File
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     * @return File
     */
    public function setImageUrl(?string $imageUrl): File
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return File
     */
    public function setType(?string $type): File
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string|null $size
     * @return File
     */
    public function setSize(?string $size): File
    {
        $this->size = $size;
        return $this;
    }
}