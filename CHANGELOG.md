# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

### Added
- Add Address-Property to Appointment ([PR137](https://github.com/5pm-HDH/churchtools-api/pull/137))
- Add SongStatistic ([PR140](https://github.com/5pm-HDH/churchtools-api/pull/140))
- Add multi-factor authentication support ([PR146](https://github.com/5pm-HDH/churchtools-api/pull/146))

### Changed
- Authenticate CTClient with session cookie instead of api-key ([PR142](https://github.com/5pm-HDH/churchtools-api/pull/142))
- GH-Action for integration-tests ([PR143](https://github.com/5pm-HDH/churchtools-api/pull/143), [PR144](https://github.com/5pm-HDH/churchtools-api/pull/144), [PR149](https://github.com/5pm-HDH/churchtools-api/pull/149), [PR153](https://github.com/5pm-HDH/churchtools-api/pull/153))
- Update Dependencies ([PR154](https://github.com/5pm-HDH/churchtools-api/pull/154))
- Authenticate with UserId and LoginToken ([PR155](https://github.com/5pm-HDH/churchtools-api/pull/155), [PR156](https://github.com/5pm-HDH/churchtools-api/pull/156))

### Fixed

- Add ImageUrlBanner to GroupInformation data ([PR136](https://github.com/5pm-HDH/churchtools-api/pull/136))

## [1.3.6] - 2023-04-05

### Added
- Request Ajax-Api ([AjaxApi-Trait](src/Requests/Traits/AjaxApi.php))
- Update Song-Arrangement ([PR121](https://github.com/5pm-HDH/churchtools-api/pull/121))
- Update Song ([PR122](https://github.com/5pm-HDH/churchtools-api/pull/122))
- Update GroupMembers ([PR124](https://github.com/5pm-HDH/churchtools-api/pull/124))
- CCLI-Request Lyrics and Chordsheet ([PR127](https://github.com/5pm-HDH/churchtools-api/pull/127), [PR131](https://github.com/5pm-HDH/churchtools-api/pull/131))
- Extended exception handling of invalid or empty email addresses passed to the person API ([PR125](https://github.com/5pm-HDH/churchtools-api/pull/125))
- Group-Meetings Request ([PR130](https://github.com/5pm-HDH/churchtools-api/pull/130))

### Changed

- Sending API key as HTTP header instead of query param in FileRequestBuilder ([PR126](https://github.com/5pm-HDH/churchtools-api/pull/126))
- Update ChurchTools from 3.90.0 to 3.91.1 ([PR129](https://github.com/5pm-HDH/churchtools-api/pull/129))
- Improved the formatting of ChurchTool's error response ([PR132](https://github.com/5pm-HDH/churchtools-api/pull/132))
- Breaking-Change: Wrap Song-Lyrics with Model ([PR133](https://github.com/5pm-HDH/churchtools-api/pull/133))

## [1.3.5] - 2022-09-22

### Added
- Create, update and delete person ([PR84](https://github.com/5pm-HDH/churchtools-api/pull/84), [PR88](https://github.com/5pm-HDH/churchtools-api/pull/88), [PR91](https://github.com/5pm-HDH/churchtools-api/pull/91), [PR105](https://github.com/5pm-HDH/churchtools-api/pull/105), [PR107](https://github.com/5pm-HDH/churchtools-api/pull/107), [PR93](https://github.com/5pm-HDH/churchtools-api/pull/93), [PR100](https://github.com/5pm-HDH/churchtools-api/pull/100), [PR109](https://github.com/5pm-HDH/churchtools-api/pull/109))
- New API-Requests
  - [Calendar-API](https://github.com/5pm-HDH/churchtools-api/pull/92)
  - [Permission-API](https://github.com/5pm-HDH/churchtools-api/pull/102)
  - [Person-API - Retrieve Birthdays](https://github.com/5pm-HDH/churchtools-api/pull/104)
  - [Person-API - Retrieve Tags](https://github.com/5pm-HDH/churchtools-api/pull/110)
  - [Absence-API](https://github.com/5pm-HDH/churchtools-api/pull/111)
  - [File-API](https://github.com/5pm-HDH/churchtools-api/pull/114)
  - [Search-API](https://github.com/5pm-HDH/churchtools-api/pull/116)
- Serialize Models to Data-Array for JSON-Export ([PR103](https://github.com/5pm-HDH/churchtools-api/pull/103))

### Changed

- Refactor: Move generated Doc-Files to out-Folder ([PR89](https://github.com/5pm-HDH/churchtools-api/pull/89))
- Refactor: Cache Api-key over multiple Integration-Tests ([PR113](https://github.com/5pm-HDH/churchtools-api/pull/113))
- Refactor FillWithData: Cast types ([PR101](https://github.com/5pm-HDH/churchtools-api/pull/101))
- Refactor CTClient: transform inheritance from GuzzleClient to composition-relation ([PR83](https://github.com/5pm-HDH/churchtools-api/pull/83))
- Refactor: Create Abstract Model to cast id ([PR118](https://github.com/5pm-HDH/churchtools-api/pull/118))

### Fixed
- Fix: Status-Code handling and Exception-handling ([PR99](https://github.com/5pm-HDH/churchtools-api/pull/99))
- Fix: Use Query-Parameters for Where-Clause ([PR106](https://github.com/5pm-HDH/churchtools-api/pull/106))


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

