<?php


namespace CTApi\Models;


use CTApi\Models\Traits\FillWithData;

class PermissionChurchService
{
    use FillWithData;

    protected ?bool $view = null;
    protected array $view_servicegroup = [];
    protected array $edit_servicegroup = [];
    protected ?bool $view_history = null;
    protected array $view_events = [];
    protected array $edit_events = [];
    protected ?bool $edit_template = null;
    protected ?bool $manage_absent = null;
    protected array $view_fact = [];
    protected array $edit_fact = [];
    protected ?bool $export_facts = null;
    protected array $view_agenda = [];
    protected array $edit_agenda = [];
    protected array $edit_agenda_templates = [];
    protected array $view_songcategory = [];
    protected array $edit_songcategory = [];
    protected ?bool $view_song_statistics = null;
    protected ?bool $use_ccli = null;
    protected ?bool $edit_masterdata = null;

    /**
     * @return bool|null
     */
    public function getView(): ?bool
    {
        return $this->view;
    }

    /**
     * @param bool|null $view
     * @return PermissionChurchService
     */
    public function setView(?bool $view): PermissionChurchService
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewServicegroup(): array
    {
        return $this->view_servicegroup;
    }

    /**
     * @param array $view_servicegroup
     * @return PermissionChurchService
     */
    public function setViewServicegroup(array $view_servicegroup): PermissionChurchService
    {
        $this->view_servicegroup = $view_servicegroup;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditServicegroup(): array
    {
        return $this->edit_servicegroup;
    }

    /**
     * @param array $edit_servicegroup
     * @return PermissionChurchService
     */
    public function setEditServicegroup(array $edit_servicegroup): PermissionChurchService
    {
        $this->edit_servicegroup = $edit_servicegroup;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewHistory(): ?bool
    {
        return $this->view_history;
    }

    /**
     * @param bool|null $view_history
     * @return PermissionChurchService
     */
    public function setViewHistory(?bool $view_history): PermissionChurchService
    {
        $this->view_history = $view_history;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewEvents(): array
    {
        return $this->view_events;
    }

    /**
     * @param array $view_events
     * @return PermissionChurchService
     */
    public function setViewEvents(array $view_events): PermissionChurchService
    {
        $this->view_events = $view_events;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditEvents(): array
    {
        return $this->edit_events;
    }

    /**
     * @param array $edit_events
     * @return PermissionChurchService
     */
    public function setEditEvents(array $edit_events): PermissionChurchService
    {
        $this->edit_events = $edit_events;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditTemplate(): ?bool
    {
        return $this->edit_template;
    }

    /**
     * @param bool|null $edit_template
     * @return PermissionChurchService
     */
    public function setEditTemplate(?bool $edit_template): PermissionChurchService
    {
        $this->edit_template = $edit_template;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getManageAbsent(): ?bool
    {
        return $this->manage_absent;
    }

    /**
     * @param bool|null $manage_absent
     * @return PermissionChurchService
     */
    public function setManageAbsent(?bool $manage_absent): PermissionChurchService
    {
        $this->manage_absent = $manage_absent;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewFact(): array
    {
        return $this->view_fact;
    }

    /**
     * @param array $view_fact
     * @return PermissionChurchService
     */
    public function setViewFact(array $view_fact): PermissionChurchService
    {
        $this->view_fact = $view_fact;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditFact(): array
    {
        return $this->edit_fact;
    }

    /**
     * @param array $edit_fact
     * @return PermissionChurchService
     */
    public function setEditFact(array $edit_fact): PermissionChurchService
    {
        $this->edit_fact = $edit_fact;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExportFacts(): ?bool
    {
        return $this->export_facts;
    }

    /**
     * @param bool|null $export_facts
     * @return PermissionChurchService
     */
    public function setExportFacts(?bool $export_facts): PermissionChurchService
    {
        $this->export_facts = $export_facts;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewAgenda(): array
    {
        return $this->view_agenda;
    }

    /**
     * @param array $view_agenda
     * @return PermissionChurchService
     */
    public function setViewAgenda(array $view_agenda): PermissionChurchService
    {
        $this->view_agenda = $view_agenda;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditAgenda(): array
    {
        return $this->edit_agenda;
    }

    /**
     * @param array $edit_agenda
     * @return PermissionChurchService
     */
    public function setEditAgenda(array $edit_agenda): PermissionChurchService
    {
        $this->edit_agenda = $edit_agenda;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditAgendaTemplates(): array
    {
        return $this->edit_agenda_templates;
    }

    /**
     * @param array $edit_agenda_templates
     * @return PermissionChurchService
     */
    public function setEditAgendaTemplates(array $edit_agenda_templates): PermissionChurchService
    {
        $this->edit_agenda_templates = $edit_agenda_templates;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewSongcategory(): array
    {
        return $this->view_songcategory;
    }

    /**
     * @param array $view_songcategory
     * @return PermissionChurchService
     */
    public function setViewSongcategory(array $view_songcategory): PermissionChurchService
    {
        $this->view_songcategory = $view_songcategory;
        return $this;
    }

    /**
     * @return array
     */
    public function getEditSongcategory(): array
    {
        return $this->edit_songcategory;
    }

    /**
     * @param array $edit_songcategory
     * @return PermissionChurchService
     */
    public function setEditSongcategory(array $edit_songcategory): PermissionChurchService
    {
        $this->edit_songcategory = $edit_songcategory;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewSongStatistics(): ?bool
    {
        return $this->view_song_statistics;
    }

    /**
     * @param bool|null $view_song_statistics
     * @return PermissionChurchService
     */
    public function setViewSongStatistics(?bool $view_song_statistics): PermissionChurchService
    {
        $this->view_song_statistics = $view_song_statistics;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUseCcli(): ?bool
    {
        return $this->use_ccli;
    }

    /**
     * @param bool|null $use_ccli
     * @return PermissionChurchService
     */
    public function setUseCcli(?bool $use_ccli): PermissionChurchService
    {
        $this->use_ccli = $use_ccli;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditMasterdata(): ?bool
    {
        return $this->edit_masterdata;
    }

    /**
     * @param bool|null $edit_masterdata
     * @return PermissionChurchService
     */
    public function setEditMasterdata(?bool $edit_masterdata): PermissionChurchService
    {
        $this->edit_masterdata = $edit_masterdata;
        return $this;
    }
}