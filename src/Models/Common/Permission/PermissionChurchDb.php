<?php

namespace CTApi\Models\Common\Permission;

use CTApi\Traits\Model\FillWithData;

class PermissionChurchDb
{
    use FillWithData;

    protected ?bool $view_birthdaylist = null;
    protected ?bool $view_memberlist = null;
    protected ?bool $view = null;
    protected array $security_level_person = [];
    protected array $security_level_group = [];
    protected array $security_level_view_own_data = [];
    protected array $security_level_edit_own_data = [];
    protected array $view_grouptype = [];
    protected ?bool $view_statistics = null;
    protected ?bool $view_tags = null;
    protected ?bool $view_history = null;
    protected array $view_comments = [];
    protected ?bool $view_archive = null;
    protected ?bool $complex_filter = null;
    protected ?bool $administer_global_filters = null;
    protected ?bool $push_pull_archive = null;
    protected ?bool $edit_relations = null;
    protected ?bool $create_person = null;
    protected ?bool $delete_person = null;
    protected ?bool $export_data = null;
    protected ?bool $write_access = null;
    protected array $view_alldata = [];
    protected ?bool $send_sms = null;
    protected array $view_station = [];
    protected ?bool $edit_bulkletter = null;
    protected ?bool $create_print_labels = null;
    protected array $view_group = [];
    protected ?bool $administer_groups = null;
    protected ?bool $edit_masterdata = null;

    protected function fillNonArrayType(string $key, $value): void
    {
        $key = str_replace("/", "_", $key);
        $this->fillDefault($key, $value);
    }

    /**
     * @return bool|null
     */
    public function getViewBirthdaylist(): ?bool
    {
        return $this->view_birthdaylist;
    }

    /**
     * @param bool|null $view_birthdaylist
     * @return PermissionChurchDb
     */
    public function setViewBirthdaylist(?bool $view_birthdaylist): PermissionChurchDb
    {
        $this->view_birthdaylist = $view_birthdaylist;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewMemberlist(): ?bool
    {
        return $this->view_memberlist;
    }

    /**
     * @param bool|null $view_memberlist
     * @return PermissionChurchDb
     */
    public function setViewMemberlist(?bool $view_memberlist): PermissionChurchDb
    {
        $this->view_memberlist = $view_memberlist;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getView(): ?bool
    {
        return $this->view;
    }

    /**
     * @param bool|null $view
     * @return PermissionChurchDb
     */
    public function setView(?bool $view): PermissionChurchDb
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return array
     */
    public function getSecurityLevelPerson(): array
    {
        return $this->security_level_person;
    }

    /**
     * @param array $security_level_person
     * @return PermissionChurchDb
     */
    public function setSecurityLevelPerson(array $security_level_person): PermissionChurchDb
    {
        $this->security_level_person = $security_level_person;
        return $this;
    }

    /**
     * @return array
     */
    public function getSecurityLevelGroup(): array
    {
        return $this->security_level_group;
    }

    /**
     * @param array $security_level_group
     * @return PermissionChurchDb
     */
    public function setSecurityLevelGroup(array $security_level_group): PermissionChurchDb
    {
        $this->security_level_group = $security_level_group;
        return $this;
    }

    /**
     * @return array
     */
    public function getSecurityLevelViewOwnData(): array
    {
        return $this->security_level_view_own_data;
    }

    /**
     * @param array $security_level_view_own_data
     * @return PermissionChurchDb
     */
    public function setSecurityLevelViewOwnData(array $security_level_view_own_data): PermissionChurchDb
    {
        $this->security_level_view_own_data = $security_level_view_own_data;
        return $this;
    }

    /**
     * @return array
     */
    public function getSecurityLevelEditOwnData(): array
    {
        return $this->security_level_edit_own_data;
    }

    /**
     * @param array $security_level_edit_own_data
     * @return PermissionChurchDb
     */
    public function setSecurityLevelEditOwnData(array $security_level_edit_own_data): PermissionChurchDb
    {
        $this->security_level_edit_own_data = $security_level_edit_own_data;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewGrouptype(): array
    {
        return $this->view_grouptype;
    }

    /**
     * @param array $view_grouptype
     * @return PermissionChurchDb
     */
    public function setViewGrouptype(array $view_grouptype): PermissionChurchDb
    {
        $this->view_grouptype = $view_grouptype;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewStatistics(): ?bool
    {
        return $this->view_statistics;
    }

    /**
     * @param bool|null $view_statistics
     * @return PermissionChurchDb
     */
    public function setViewStatistics(?bool $view_statistics): PermissionChurchDb
    {
        $this->view_statistics = $view_statistics;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewTags(): ?bool
    {
        return $this->view_tags;
    }

    /**
     * @param bool|null $view_tags
     * @return PermissionChurchDb
     */
    public function setViewTags(?bool $view_tags): PermissionChurchDb
    {
        $this->view_tags = $view_tags;
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
     * @return PermissionChurchDb
     */
    public function setViewHistory(?bool $view_history): PermissionChurchDb
    {
        $this->view_history = $view_history;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewComments(): array
    {
        return $this->view_comments;
    }

    /**
     * @param array $view_comments
     * @return PermissionChurchDb
     */
    public function setViewComments(array $view_comments): PermissionChurchDb
    {
        $this->view_comments = $view_comments;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getViewArchive(): ?bool
    {
        return $this->view_archive;
    }

    /**
     * @param bool|null $view_archive
     * @return PermissionChurchDb
     */
    public function setViewArchive(?bool $view_archive): PermissionChurchDb
    {
        $this->view_archive = $view_archive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getComplexFilter(): ?bool
    {
        return $this->complex_filter;
    }

    /**
     * @param bool|null $complex_filter
     * @return PermissionChurchDb
     */
    public function setComplexFilter(?bool $complex_filter): PermissionChurchDb
    {
        $this->complex_filter = $complex_filter;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdministerGlobalFilters(): ?bool
    {
        return $this->administer_global_filters;
    }

    /**
     * @param bool|null $administer_global_filters
     * @return PermissionChurchDb
     */
    public function setAdministerGlobalFilters(?bool $administer_global_filters): PermissionChurchDb
    {
        $this->administer_global_filters = $administer_global_filters;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPushPullArchive(): ?bool
    {
        return $this->push_pull_archive;
    }

    /**
     * @param bool|null $push_pull_archive
     * @return PermissionChurchDb
     */
    public function setPushPullArchive(?bool $push_pull_archive): PermissionChurchDb
    {
        $this->push_pull_archive = $push_pull_archive;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditRelations(): ?bool
    {
        return $this->edit_relations;
    }

    /**
     * @param bool|null $edit_relations
     * @return PermissionChurchDb
     */
    public function setEditRelations(?bool $edit_relations): PermissionChurchDb
    {
        $this->edit_relations = $edit_relations;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCreatePerson(): ?bool
    {
        return $this->create_person;
    }

    /**
     * @param bool|null $create_person
     * @return PermissionChurchDb
     */
    public function setCreatePerson(?bool $create_person): PermissionChurchDb
    {
        $this->create_person = $create_person;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDeletePerson(): ?bool
    {
        return $this->delete_person;
    }

    /**
     * @param bool|null $delete_person
     * @return PermissionChurchDb
     */
    public function setDeletePerson(?bool $delete_person): PermissionChurchDb
    {
        $this->delete_person = $delete_person;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getExportData(): ?bool
    {
        return $this->export_data;
    }

    /**
     * @param bool|null $export_data
     * @return PermissionChurchDb
     */
    public function setExportData(?bool $export_data): PermissionChurchDb
    {
        $this->export_data = $export_data;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getWriteAccess(): ?bool
    {
        return $this->write_access;
    }

    /**
     * @param bool|null $write_access
     * @return PermissionChurchDb
     */
    public function setWriteAccess(?bool $write_access): PermissionChurchDb
    {
        $this->write_access = $write_access;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewAlldata(): array
    {
        return $this->view_alldata;
    }

    /**
     * @param array $view_alldata
     * @return PermissionChurchDb
     */
    public function setViewAlldata(array $view_alldata): PermissionChurchDb
    {
        $this->view_alldata = $view_alldata;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSendSms(): ?bool
    {
        return $this->send_sms;
    }

    /**
     * @param bool|null $send_sms
     * @return PermissionChurchDb
     */
    public function setSendSms(?bool $send_sms): PermissionChurchDb
    {
        $this->send_sms = $send_sms;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewStation(): array
    {
        return $this->view_station;
    }

    /**
     * @param array $view_station
     * @return PermissionChurchDb
     */
    public function setViewStation(array $view_station): PermissionChurchDb
    {
        $this->view_station = $view_station;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEditBulkletter(): ?bool
    {
        return $this->edit_bulkletter;
    }

    /**
     * @param bool|null $edit_bulkletter
     * @return PermissionChurchDb
     */
    public function setEditBulkletter(?bool $edit_bulkletter): PermissionChurchDb
    {
        $this->edit_bulkletter = $edit_bulkletter;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCreatePrintLabels(): ?bool
    {
        return $this->create_print_labels;
    }

    /**
     * @param bool|null $create_print_labels
     * @return PermissionChurchDb
     */
    public function setCreatePrintLabels(?bool $create_print_labels): PermissionChurchDb
    {
        $this->create_print_labels = $create_print_labels;
        return $this;
    }

    /**
     * @return array
     */
    public function getViewGroup(): array
    {
        return $this->view_group;
    }

    /**
     * @param array $view_group
     * @return PermissionChurchDb
     */
    public function setViewGroup(array $view_group): PermissionChurchDb
    {
        $this->view_group = $view_group;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdministerGroups(): ?bool
    {
        return $this->administer_groups;
    }

    /**
     * @param bool|null $administer_groups
     * @return PermissionChurchDb
     */
    public function setAdministerGroups(?bool $administer_groups): PermissionChurchDb
    {
        $this->administer_groups = $administer_groups;
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
     * @return PermissionChurchDb
     */
    public function setEditMasterdata(?bool $edit_masterdata): PermissionChurchDb
    {
        $this->edit_masterdata = $edit_masterdata;
        return $this;
    }
}
