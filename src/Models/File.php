<?php


namespace CTApi\Models;


use CTApi\CTClient;
use CTApi\Models\Traits\FillWithData;
use GuzzleHttp\Exception\GuzzleException;

class File
{
    use FillWithData;

    protected ?string $domainType;
    protected ?string $domainId;
    protected ?string $name;
    protected ?string $filename;
    protected ?string $fileUrl;

    public function downloadToPath($path): bool
    {
        return file_put_contents($path . '/' . $this->name, $this->getFileContent());
    }

    public function downloadToClient(): void
    {
        header("Content-disposition: attachment;filename=" . $this->name);
        echo $this->getFileContent();
    }

    private function getFileContent(): bool|string
    {
        try {
            $response = CTClient::getClient()->get($this->fileUrl);
            return $response->getBody();
        } catch (GuzzleException $e) {
            //ignore
            return false;
        }
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

}