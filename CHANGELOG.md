# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

### Added
- [Added method to update person data](https://github.com/5pm-HDH/churchtools-api/pull/84)
- [Added modifiable-attributes to person-api docs](https://github.com/5pm-HDH/churchtools-api/pull/88)
- [Added method to delete person records](https://github.com/5pm-HDH/churchtools-api/pull/91)
- [Added Calendar-Request](https://github.com/5pm-HDH/churchtools-api/pull/92)
- [Added Permission-Request](https://github.com/5pm-HDH/churchtools-api/pull/102)

### Changed
- [Refactor CTClient:](https://github.com/5pm-HDH/churchtools-api/pull/83) transform inheritance from GuzzleClient to composition-relation
- [Move generated Doc-Files to `out`-Folder](https://github.com/5pm-HDH/churchtools-api/pull/89)
- [Create UpdatableMode-Interface for type safety](https://github.com/5pm-HDH/churchtools-api/pull/93)
- [Status-Code handling and Exception-handling](https://github.com/5pm-HDH/churchtools-api/pull/99)
- [Refactor delete person](https://github.com/5pm-HDH/churchtools-api/pull/100)
- [Refactor FillWithData](https://github.com/5pm-HDH/churchtools-api/pull/101)

### Fixed


## [1.3.4] - 2022-06-22

### Added
- [Resource and Bookings - API](https://github.com/5pm-HDH/churchtools-api/pull/78)

### Changed

### Fixed

- [Guzzle-Security Patch #1](https://github.com/5pm-HDH/churchtools-api/pull/76)
- [Guzzle-Security Patch #2](https://github.com/5pm-HDH/churchtools-api/pull/77)

## [1.3.3] - 2022-06-03

### Added
- [Banner-Image for Group](https://github.com/5pm-HDH/churchtools-api/issues/65)

### Changed

### Fixed
- Cross-domain cookie leakage in Guzzle - [SecurityFix](https://github.com/5pm-HDH/churchtools-api/pull/71)
- [Manual Pagination](https://github.com/5pm-HDH/churchtools-api/issues/68)

## [1.3.2] - 2022-02-11

### Added

### Changed
- refactor [DocGenerator](https://github.com/5pm-HDH/churchtools-api/pull/66): move PHP-Code to Unit-Tests.

### Fixed
- Fix security issue: [
  Improper Input Validation in guzzlehttp/psr7](https://github.com/5pm-HDH/churchtools-api/pull/67)

## [1.3.1] - 2022-02-11

### Fixed

- add TargetGroup, GroupPlace to [Group-Information](https://github.com/5pm-HDH/churchtools-api/pull/64)
- generate Registration-Link in [PublicGroup](https://github.com/5pm-HDH/churchtools-api/pull/64)

## [1.3.0] - 2022-02-11

### Added

- Group-Hierarchie: [add Group-Hierachie-API](https://github.com/5pm-HDH/churchtools-api/pull/58) to request Parents and Children of Groups.
- Public Group: [add Public-Group-API](https://github.com/5pm-HDH/churchtools-api/pull/59)

## [1.2.0] - 2022-01-12

### Added
- Group: [add Group-API](https://github.com/5pm-HDH/churchtools-api/pull/47)
- Event-Calendar: [add Calendar-Attribut for Event](https://github.com/5pm-HDH/churchtools-api/pull/52)
- Wiki-Files: [request Files from Wiki-Page](https://github.com/5pm-HDH/churchtools-api/pull/54)
- Static code analysis tool: [add Psalm as static code analysis tool](https://github.com/5pm-HDH/churchtools-api/pull/55)

### Changed
- Refactoring:
  - [introduce namespace to test-suites, update phpunit-configuration](https://github.com/5pm-HDH/churchtools-api/pull/46)
  - [create AbstractRequestBuilder to simplify RequestBuilder implementation](https://github.com/5pm-HDH/churchtools-api/pull/48)
- DocGeneration
  - [generate Docs with executable Code-Examples](https://github.com/5pm-HDH/churchtools-api/pull/56)

### Fixed
- Error Handling: [reorganize CTExceptions](https://github.com/5pm-HDH/churchtools-api/pull/53)

## [1.1.0] - 2021-06-10

### Added

- CTConfig: [add Cache mechanism](https://github.com/5pm-HDH/churchtools-api/issues/29)

- CTLog: [add Monolog as Logger-Framework](https://github.com/5pm-HDH/churchtools-api/issues/25)
- Models:
    - [Service / ServiceGroup - Models](https://github.com/5pm-HDH/churchtools-api/issues/23)
    - [EventService](https://github.com/5pm-HDH/churchtools-api/issues/23) to retrieve the Services of an Event
    - [WikiCategory / WikiPage / WikiSearchResult](https://github.com/5pm-HDH/churchtools-api/issues/33)
    - [Process WikiPages to Tree](https://github.com/5pm-HDH/churchtools-api/issues/35)
- Requests:
    - [ServiceRequest / ServiceGroupRequest](https://github.com/5pm-HDH/churchtools-api/issues/23)
    - [WikiCategoryRequest / WikiSearchRequest](https://github.com/5pm-HDH/churchtools-api/issues/33)

### Changed

- Models:
    - Person: add [requestEvents-Method](https://github.com/5pm-HDH/churchtools-api/issues/24) to retrieve upcoming
      events for person

### Fixed

- File: `requestFirstLink($url)` filters in the attribute fileUrl not in attribute name code

## [1.0.0] - 2021-04-20

### Added

- CTConfig: [set](https://github.com/5pm-HDH/churchtools-api/issues/4)
  & [validate API-Token](https://github.com/5pm-HDH/churchtools-api/issues/1)
- Models:
    - process the [meta-information](https://github.com/5pm-HDH/churchtools-api/issues/10) of models (creator, editor)
- File/Link:
    - [create downloadable FileUrl](https://github.com/5pm-HDH/churchtools-api/issues/6)
    - [requestFirstFile(...) / requestFirstLink(...) methods on Arrangement](https://github.com/5pm-HDH/churchtools-api/issues/13)

### Changed

- Models: Refactor [`requestXYZ`-Methods](https://github.com/5pm-HDH/churchtools-api/issues/16)

### Fixed

