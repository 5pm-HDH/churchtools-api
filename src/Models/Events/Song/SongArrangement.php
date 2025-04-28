<?php

namespace CTApi\Models\Events\Song;

use CTApi\Interfaces\UpdatableModel;
use CTApi\Models\AbstractModel;
use CTApi\Models\Common\Domain\Meta;
use CTApi\Models\Common\File\File;
use CTApi\Models\Events\SongStatistic\SongStatistic;
use CTApi\Models\Events\SongStatistic\SongStatisticRequest;
use CTApi\Traits\Model\ExtractData;
use CTApi\Traits\Model\FillWithData;
use CTApi\Traits\Model\MetaAttribute;

class SongArrangement extends AbstractModel implements UpdatableModel
{
    use FillWithData;
    use MetaAttribute;
    use ExtractData;

    protected ?string $name = null;
    protected ?bool $isDefault = null;
    /**
     * @deprecated use key instead
     */
    protected ?string $keyOfArrangement = null;
    protected ?string $key = null;
    /**
     * @deprecated use tempo instead
     */
    protected ?string $bpm = null;
    protected ?string $tempo = null;
    protected ?string $beat = null;
    protected ?string $duration = null;
    /**
     * @deprecated use description instead
     */
    protected ?string $note = null;
    protected ?string $description = null;
    protected ?string $sourceName = null;
    protected ?string $sourceReference = null;
    
    protected array $links = [];
    protected array $files = [];

    public static function getModifiableAttributes(): array
    {
        return [
            "name",
            "keyOfArrangement",
            "bpm",
            "beat",
            "duration",
            "note",
        ];
    }

    protected function fillArrayType(string $key, array $data): void
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
                $this->fillDefault($key, $data);
        }
    }

    public function requestSongStatistic(): ?SongStatistic
    {
        if ($this->getId() != null) {
            return SongStatisticRequest::find($this->getIdOrFail());
        }
        return null;
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
        $requestedFiles = $this->getFiles();

        if (!is_null($fileExtension)) {
            $requestedFiles = array_filter($requestedFiles, function ($file) use ($fileExtension) {
                return str_ends_with($file->getName(), $fileExtension);
            });
        }

        foreach ($requestedFiles as $file) {
            if (str_contains(strtolower($file->getName()), strtolower($filename))) {
                return $file;
            }
        }
        return null;
    }

    /**
     * Method returns first Link that matches the given in url.
     *
     * @param string $url
     * @return File|null
     */
    public function requestFirstLink(string $url): ?File
    {
        foreach ($this->getLinks() as $link) {
            if (str_contains(strtolower($link->getFileUrl()), strtolower($url))) {
                return $link;
            }
        }
        return null;
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
     * @return bool|null
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool|null $isDefault
     * @return SongArrangement
     */
    public function setIsDefault(?bool $isDefault): SongArrangement
    {
        $this->isDefault = $isDefault;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }
    
    /**
     * @param string|null $key
     * @return SongArrangement
     */
    public function setKey(?string $key): SongArrangement
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string|null
     * @deprecated use key instead
     */
    public function getKeyOfArrangement(): ?string
    {
        return $this->keyOfArrangement;
    }

    /**
     * @param string|null $keyOfArrangement
     * @return SongArrangement
     * @deprecated use key instead
     */
    public function setKeyOfArrangement(?string $keyOfArrangement): SongArrangement
    {
        $this->keyOfArrangement = $keyOfArrangement;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTempo() : ?string
    {
        return $this->tempo;
    }
    
    /**
     * @param string|null $tempo
     * @return SongArrangement
     */
    public function setTempo($tempo) : SongArrangement
    {
        $this->tempo = $tempo;
        return $this;
    }
    
    /**
     * @return string|null
     * @deprecated use tempo instead
     */
    public function getBpm(): ?string
    {
        return $this->bpm;
    }

    /**
     * @param string|null $bpm
     * @return SongArrangement
     * @deprecated use tempo instead
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
     * @deprecated use description instead
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     * @return SongArrangement
     * @deprecated use description instead
     */
    public function setNote(?string $note): SongArrangement
    {
        $this->note = $note;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    /**
     * @param string|null $description
     * @return SongArrangement
     */
    public function setDescription(?string $description): SongArrangement
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getSourceName(): ?string
    {
        return $this->sourceName;
    }
    
    /**
     * @param string|null $sourceName
     * @return SongArrangement
     */
    public function setSourceName(?string $sourceName): SongArrangement
    {
        $this->sourceName = $sourceName;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getSourceReference(): ?string
    {
        return $this->sourceReference;
    }
    
    /**
     * @param string|null $sourceReference
     * @return SongArrangement
     */
    public function setSourceReference(?string $sourceReference): SongArrangement
    {
        $this->sourceReference = $sourceReference;
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
