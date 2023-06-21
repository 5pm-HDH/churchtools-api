<?php


namespace CTApi\Models;


use CTApi\Models\Interfaces\UpdatableModel;
use CTApi\Models\Traits\ExtractData;
use CTApi\Models\Traits\FillWithData;
use CTApi\Models\Traits\MetaAttribute;
use CTApi\Requests\SongRequest;
use CTApi\Requests\SongStatisticRequest;
use CTApi\Requests\SongTagRequestBuilder;

class Song extends AbstractModel implements UpdatableModel
{
    use FillWithData, MetaAttribute, ExtractData;

    protected ?string $arrangementId = null;
    protected ?string $name = null;
    protected ?string $arrangement = null;
    protected array $arrangements = [];
    protected ?SongCategory $category = null;
    protected ?string $category_id = null;
    protected ?bool $shouldPractice = null;
    protected ?string $author = null;
    protected ?string $ccli = null;
    protected ?string $copyright = null;
    protected ?string $note = null;
    protected ?string $key = null;
    protected ?string $bpm = null;
    protected ?bool $isDefault = null;

    static function getModifiableAttributes(): array
    {
        return [
            "name",
            "category_id",
            "shouldPractice",
            "author",
            "copyright",
            "ccli"
        ];
    }

    protected function fillArrayType(string $key, array $data): void
    {
        switch ($key) {
            case "category":
                $this->setCategory(SongCategory::createModelFromData($data));
                $this->setCategoryId($this->getCategory()?->getId());
                break;
            case "arrangements":
                $this->setArrangements(SongArrangement::createModelsFromArray($data));
                break;
            case "meta":
                $this->setMeta(Meta::createModelFromData($data));
                break;
            default:
                $this->fillDefault($key, $data);
        }
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        switch ($key) {
            case "songId":
                $this->setId($value);
                break;
            case "title":
                $this->setName($value);
                break;
            case "category":
                $this->setCategory(SongCategory::createModelFromData(["name" => $value]));
                break;
            default:
                $this->fillDefault($key, $value);
        }
    }

    public function requestSelectedArrangement(): ?SongArrangement
    {
        $songId = $this->getId();
        $selectedArrangementId = $this->getArrangementId();

        if (is_null($songId) || is_null($selectedArrangementId)) {
            return null;
        }

        $song = SongRequest::find((int)$songId);

        if (is_null($song)) {
            return null;
        }

        $selectedArrangement = null;
        foreach ($song->getArrangements() as $arrangement) {
            if ($arrangement->getId() == $selectedArrangementId) {
                $selectedArrangement = $arrangement;
            }
        }

        return $selectedArrangement;
    }

    public function requestTags(): ?SongTagRequestBuilder
    {
        if($this->id != null){
            return new SongTagRequestBuilder($this->getIdAsInteger());
        }
        return null;
    }

    /**
     * @param string|null $id
     * @return Song
     */
    public function setId(?string $id): Song
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArrangementId(): ?string
    {
        return $this->arrangementId;
    }

    /**
     * @param string|null $arrangementId
     * @return Song
     */
    public function setArrangementId(?string $arrangementId): Song
    {
        $this->arrangementId = $arrangementId;
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
     * @return Song
     */
    public function setName(?string $name): Song
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArrangement(): ?string
    {
        return $this->arrangement;
    }

    /**
     * @param string|null $arrangement
     * @return Song
     */
    public function setArrangement(?string $arrangement): Song
    {
        $this->arrangement = $arrangement;
        return $this;
    }

    /**
     * @return array
     */
    public function getArrangements(): array
    {
        return $this->arrangements;
    }

    /**
     * @param array $arrangements
     * @return Song
     */
    public function setArrangements(array $arrangements): Song
    {
        $this->arrangements = $arrangements;
        return $this;
    }

    /**
     * @return SongCategory|null
     */
    public function getCategory(): ?SongCategory
    {
        return $this->category;
    }

    /**
     * @param SongCategory|null $category
     * @return Song
     */
    public function setCategory(?SongCategory $category): Song
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategoryId(): ?string
    {
        return $this->category_id;
    }

    /**
     * @param string|null $category_id
     * @return Song
     */
    public function setCategoryId(?string $category_id): Song
    {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShouldPractice(): ?bool
    {
        return $this->shouldPractice;
    }

    /**
     * @param bool|null $shouldPractice
     * @return Song
     */
    public function setShouldPractice(?bool $shouldPractice): Song
    {
        $this->shouldPractice = $shouldPractice;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     * @return Song
     */
    public function setAuthor(?string $author): Song
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCcli(): ?string
    {
        return $this->ccli;
    }

    /**
     * @param string|null $ccli
     * @return Song
     */
    public function setCcli(?string $ccli): Song
    {
        $this->ccli = $ccli;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    /**
     * @param string|null $copyright
     * @return Song
     */
    public function setCopyright(?string $copyright): Song
    {
        $this->copyright = $copyright;
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
     * @return Song
     */
    public function setNote(?string $note): Song
    {
        $this->note = $note;
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
     * @return Song
     */
    public function setKey(?string $key): Song
    {
        $this->key = $key;
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
     * @return Song
     */
    public function setBpm(?string $bpm): Song
    {
        $this->bpm = $bpm;
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
     * @return Song
     */
    public function setIsDefault(?bool $isDefault): Song
    {
        $this->isDefault = $isDefault;
        return $this;
    }
}