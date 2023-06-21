<?php


namespace CTApi\Models\Groups\PublicGroup;


use CTApi\CTConfig;
use CTApi\Models\Groups\Group\Group;
use CTApi\Traits\Model\FillWithData;

class PublicGroup extends Group
{
    use FillWithData;

    protected ?string $autoAccept = null;
    protected ?bool $allowWaitinglist = null;
    protected ?string $waitinglistMaxPersons = null;
    protected ?string $maxMemberCount = null;
    protected ?string $currentMemberCount = null;
    protected ?string $requestedPlacesCount = null;
    protected ?string $requestedWaitinglistPlacesCount = null;
    protected ?bool $canSignUp = null;
    protected array $signUpConditions = [];
    protected ?string $signUpHeadline = null;

    protected function fillArrayType(string $key, array $data): void
    {
        parent::fillArrayType($key, $data);
    }

    protected function fillNonArrayType(string $key, $value): void
    {
        parent::fillNonArrayType($key, $value);
    }

    public function generateRegistrationLink(string $groupHash): string
    {
        $url = CTConfig::getApiUrl();

        if (!is_null($url) && '/' != substr($url, -1)) {
            $url .= '/';
        }

        $url .= 'publicgroup/' . $this->getId();

        $url .= '?hash=' . $groupHash;

        return $url;
    }

    /**
     * @return string|null
     */
    public function getAutoAccept(): ?string
    {
        return $this->autoAccept;
    }

    /**
     * @param string|null $autoAccept
     * @return PublicGroup
     */
    public function setAutoAccept(?string $autoAccept): PublicGroup
    {
        $this->autoAccept = $autoAccept;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAllowWaitinglist(): ?bool
    {
        return $this->allowWaitinglist;
    }

    /**
     * @param bool|null $allowWaitinglist
     * @return PublicGroup
     */
    public function setAllowWaitinglist(?bool $allowWaitinglist): PublicGroup
    {
        $this->allowWaitinglist = $allowWaitinglist;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWaitinglistMaxPersons(): ?string
    {
        return $this->waitinglistMaxPersons;
    }

    /**
     * @param string|null $waitinglistMaxPersons
     * @return PublicGroup
     */
    public function setWaitinglistMaxPersons(?string $waitinglistMaxPersons): PublicGroup
    {
        $this->waitinglistMaxPersons = $waitinglistMaxPersons;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMaxMemberCount(): ?string
    {
        return $this->maxMemberCount;
    }

    /**
     * @param string|null $maxMemberCount
     * @return PublicGroup
     */
    public function setMaxMemberCount(?string $maxMemberCount): PublicGroup
    {
        $this->maxMemberCount = $maxMemberCount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrentMemberCount(): ?string
    {
        return $this->currentMemberCount;
    }

    /**
     * @param string|null $currentMemberCount
     * @return PublicGroup
     */
    public function setCurrentMemberCount(?string $currentMemberCount): PublicGroup
    {
        $this->currentMemberCount = $currentMemberCount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRequestedPlacesCount(): ?string
    {
        return $this->requestedPlacesCount;
    }

    /**
     * @param string|null $requestedPlacesCount
     * @return PublicGroup
     */
    public function setRequestedPlacesCount(?string $requestedPlacesCount): PublicGroup
    {
        $this->requestedPlacesCount = $requestedPlacesCount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRequestedWaitinglistPlacesCount(): ?string
    {
        return $this->requestedWaitinglistPlacesCount;
    }

    /**
     * @param string|null $requestedWaitinglistPlacesCount
     * @return PublicGroup
     */
    public function setRequestedWaitinglistPlacesCount(?string $requestedWaitinglistPlacesCount): PublicGroup
    {
        $this->requestedWaitinglistPlacesCount = $requestedWaitinglistPlacesCount;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCanSignUp(): ?bool
    {
        return $this->canSignUp;
    }

    /**
     * @param bool|null $canSignUp
     * @return PublicGroup
     */
    public function setCanSignUp(?bool $canSignUp): PublicGroup
    {
        $this->canSignUp = $canSignUp;
        return $this;
    }

    /**
     * @return array
     */
    public function getSignUpConditions(): array
    {
        return $this->signUpConditions;
    }

    /**
     * @param array $signUpConditions
     * @return PublicGroup
     */
    public function setSignUpConditions(array $signUpConditions): PublicGroup
    {
        $this->signUpConditions = $signUpConditions;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSignUpHeadline(): ?string
    {
        return $this->signUpHeadline;
    }

    /**
     * @param string|null $signUpHeadline
     * @return PublicGroup
     */
    public function setSignUpHeadline(?string $signUpHeadline): PublicGroup
    {
        $this->signUpHeadline = $signUpHeadline;
        return $this;
    }
}