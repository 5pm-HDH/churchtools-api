<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;

class SongArrangement
{
    use FillWithData, MetaAttribute;

    protected ?string $id;
    protected ?string $name;
    protected ?string $isDefault;
    protected ?string $keyOfArrangement;
    protected ?string $bpm;
    protected ?string $beat;
    protected ?string $duration;
    protected ?string $note;
    protected array $links = [];
    protected array $files = [];

    protected function fillArrayType(string $key, array $data)
    {
        switch ($key) {
            case "files":
                $this->setFiles(File::createModelsFromArray($data));
                break;
            case "links":
                $this->setLinks(File::createModelsFromArray($data));
                break;
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            default:
                $this->{$key} = $data;
        }
    }

    /**
     * Method returns the first file that matches the filename and the file extension.
     *
     * @param string $filename
     * @param string|null $fileExtension
     * @return File|null
     */
    public function requestFirstFile(string $filename, ?string $fileExtension = null): ?File
    {
        $files = $this->getFiles();

        if (!is_null($fileExtension)) {
            $files = array_filter($files, function ($file) use ($fileExtension) {
                return str_ends_with($file->getName(), $fileExtension);
            });
        }

        return $this->filterFileArray($files, $filename);
    }

    /**
     * Method returns first Link that matches the given in url.
     *
     * @param string $url
     * @return File|null
     */
    public function requestFirstLink(string $url): ?File
    {
        return $this->filterFileArray($this->getLinks(), $url);
    }

    private function filterFileArray($fileArray, $filename): ?File
    {
        foreach ($fileArray as $file) {
            if (str_contains(strtolower($file->getName()), strtolower($filename))) {
                return $file;
            }
        }
        return null;
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
     * @return SongArrangement
     */
    public function setId(?string $id): SongArrangement
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
     * @return SongArrangement
     */
    public function setName(?string $name): SongArrangement
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsDefault(): ?string
    {
        return $this->isDefault;
    }

    /**
     * @param string|null $isDefault
     * @return SongArrangement
     */
    public function setIsDefault(?string $isDefault): SongArrangement
    {
        $this->isDefault = $isDefault;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKeyOfArrangement(): ?string
    {
        return $this->keyOfArrangement;
    }

    /**
     * @param string|null $keyOfArrangement
     * @return SongArrangement
     */
    public function setKeyOfArrangement(?string $keyOfArrangement): SongArrangement
    {
        $this->keyOfArrangement = $keyOfArrangement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBpm(): ?string
    {
        return $this->bpm;
    }

    /**
     * @param string|null $bpm
     * @return SongArrangement
     */
    public function setBpm(?string $bpm): SongArrangement
    {
        $this->bpm = $bpm;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBeat(): ?string
    {
        return $this->beat;
    }

    /**
     * @param string|null $beat
     * @return SongArrangement
     */
    public function setBeat(?string $beat): SongArrangement
    {
        $this->beat = $beat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string|null $duration
     * @return SongArrangement
     */
    public function setDuration(?string $duration): SongArrangement
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return SongArrangement
     */
    public function setNote(?string $note): SongArrangement
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array $links
     * @return SongArrangement
     */
    public function setLinks(array $links): SongArrangement
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param array $files
     * @return SongArrangement
     */
    public function setFiles(array $files): SongArrangement
    {
        $this->files = $files;
        return $this;
    }

}