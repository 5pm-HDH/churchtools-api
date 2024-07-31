# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

### Added
- Retrieve, create and delete SongArrangement comments ([PR187](https://github.com/5pm-HDH/churchtools-api/pull/187))
- Get GroupTypes ([PR188](https://github.com/5pm-HDH/churchtools-api/pull/188), [PR198](https://github.com/5pm-HDH/churchtools-api/pull/198))
- Get GroupTypeRoles ([PR197](https://github.com/5pm-HDH/churchtools-api/pull/197))
- PHP coding standard ([PR193](https://github.com/5pm-HDH/churchtools-api/pull/193))
- Added new property 'postsEnabled' to the group type model ([PR204](https://github.com/5pm-HDH/churchtools-api/pull/204))

### Changed

### Fixed
- PHPUnit and PHP8.1 compatibility ([PR181](https://github.com/5pm-HDH/churchtools-api/pull/181))
- Fix GroupHierarchie ([PR192](https://github.com/5pm-HDH/churchtools-api/pull/192))
- Fix action dependency ([PR195](https://github.com/5pm-HDH/churchtools-api/pull/195))
- Fix GroupHierarchie test, Fix DB-Fields test ([PR192](https://github.com/5pm-HDH/churchtools-api/pull/192), [PR194](https://github.com/5pm-HDH/churchtools-api/pull/194))
- Fix breaking changes Event-API ([PR196](https://github.com/5pm-HDH/churchtools-api/pull/196))
- Issue search for person ([PR210](https://github.com/5pm-HDH/churchtools-api/pull/210))
- Fix issue with changelog ([PR213](https://github.com/5pm-HDH/churchtools-api/pull/213))

## [2.0.0]

### Added

**New Requests:**
- Get config request `ConfigRequest:getConfig()` ([PR175](https://github.com/5pm-HDH/churchtools-api/pull/175))
- Get SongStatistic `SongStatisticRequest::all()` ([PR140](https://github.com/5pm-HDH/churchtools-api/pull/140), [PR164](https://github.com/5pm-HDH/churchtools-api/pull/164))
- Song-Tags (`$song->requestTags()`) and Group-Tags (`$group->requestTags()`) ([PR168](https://github.com/5pm-HDH/churchtools-api/pull/168))
- Get CombinedAppointment consisting of appointment, booking and event ([PR174](https://github.com/5pm-HDH/churchtools-api/pull/174))

**New Properties:**
- Add Address-Property on Appointment ([PR137](https://github.com/5pm-HDH/churchtools-api/pull/137))
- Group-member-fields and DBFields-API ([PR147](https://github.com/5pm-HDH/churchtools-api/issues/147))
- All date properties get DateTime-Getter (`$vaccationAbsence->getEndDateAsDateTime()`) ([PR167](https://github.com/5pm-HDH/churchtools-api/pull/167))
- Appointment property for calculated and base StartDate/EndDate ([PR177](https://github.com/5pm-HDH/churchtools-api/pull/177))
- Add ImageUrlBanner to GroupInformation data ([PR136](https://github.com/5pm-HDH/churchtools-api/pull/136))
- Add Image-Property to Appointment ([PR174](https://github.com/5pm-HDH/churchtools-api/pull/174))

**Configuration:**
- Add HTTP-Log to log http request data ([PR137](https://github.com/5pm-HDH/churchtools-api/pull/137))
- Pagination Page-Size Option `CTConfig::setPaginationPageSize(400)` ([PR163](https://github.com/5pm-HDH/churchtools-api/pull/163))
- CTSession to handle multiple ct-instances and login-tokens ([PR170](https://github.com/5pm-HDH/churchtools-api/pull/170))

**Authentication:**
- Add multi-factor authentication support ([PR146](https://github.com/5pm-HDH/churchtools-api/pull/146))

### Changed

**Breaking Changes:**
- Refactor Imports to follow PSR-4 ([PR165](https://github.com/5pm-HDH/churchtools-api/pull/165))
- Reorganize Codebase ([PR173](https://github.com/5pm-HDH/churchtools-api/pull/173))

- Authenticate CT-API-Client with cookie session instead of sending api-key in every request. ([PR142](https://github.com/5pm-HDH/churchtools-api/pull/142))
- Authenticate with UserId and LoginToken ([PR155](https://github.com/5pm-HDH/churchtools-api/pull/155), [PR156](https://github.com/5pm-HDH/churchtools-api/pull/156), [PR157](https://github.com/5pm-HDH/churchtools-api/pull/157))

**Intern Changes:**
- Add integration-test that interact with a reallife churchtools instance ([PR143](https://github.com/5pm-HDH/churchtools-api/pull/143), [PR144](https://github.com/5pm-HDH/churchtools-api/pull/144), [PR149](https://github.com/5pm-HDH/churchtools-api/pull/149), [PR153](https://github.com/5pm-HDH/churchtools-api/pull/153))
- Update Dependencies ([PR154](https://github.com/5pm-HDH/churchtools-api/pull/154))
- Update tested CT-Version in Docs ([PR178](https://github.com/5pm-HDH/churchtools-api/pull/178), [PR159](https://github.com/5pm-HDH/churchtools-api/pull/159))
- Replace Psalm PHP with PHP-Stan ([PR166](https://github.com/5pm-HDH/churchtools-api/pull/166))
- Upgrade Monolog to v3 ([PR171](https://github.com/5pm-HDH/churchtools-api/pull/171))
- Upgrade required PHP version from 8.0 to 8.1 ([PR171](https://github.com/5pm-HDH/churchtools-api/pull/171))

## Upgrade Guide - Upgrading from v1 to v2

For version 2 we refactor the complete code base to provide a better overview and split the code in the diffrent churchtools parts (groups, events, calendars, bookings). To migrate your from version 1 to 2 please check out this upgrade guide:

### High Impact Changes:

**Reorganizce Coadebase and refactor imports ([PR173](https://github.com/5pm-HDH/churchtools-api/pull/173), [PR165](https://github.com/5pm-HDH/churchtools-api/pull/165))**

Please update the imports in your code for each Request and Model. You can make use of your IDE's intellisense or refer to the [documentation](https://github.com/5pm-HDH/churchtools-api#requests-and-models) to find the correct namespaces.

**Upgrade PHP Version to 8.1 and dump support for 8.0 ([PR171](https://github.com/5pm-HDH/churchtools-api/pull/171))**

With security support for PHP 8.0 set to expire on November 26, the focus will shift away from 8.0 in favor of embracing new language features in PHP 8.1. You can find more information about supported PHP versions at https://www.php.net/supported-versions.php.

Update your PHP Version on your system and reinstall the composer dependencies.

### Medium Impact Changes:

**Changed Authentication of CT-Client ([PR142](https://github.com/5pm-HDH/churchtools-api/pull/142))**

The authentication method for the churchtools API has been updated. Previously, the API-token was included in every request. Now, authentication will be based on the provided cookie session, which will significantly improve request speed. To be up to date with the authentication methods please check out the [documentation](https://github.com/5pm-HDH/churchtools-api/blob/master/docs/out/CTConfig.md#2-authentication). As a result of this change, the Config API has also been modified:

- `CTConfig::validateApiKey()` is replaced with `CTConfig::validateAuthentication()`
- `CTConfig::authWithLoginToken($userId, $loginToken)` now only needs loginToken as parameter, because userId is not required: `CTConfig::authWithLoginToken($loginToken)`.
- `AuthRequest::retrieveApiToken()` now needs the userId as parameter.

### Low Impact Changes:

**Upgrade Monolog to v3 ([PR171](https://github.com/5pm-HDH/churchtools-api/pull/171))**

We upgraded monolog to v3 to be compatible with Laravel 10. There is now action required.

**Ugrade Guzzle from 7.4 to 7.7 ([PR154](https://github.com/5pm-HDH/churchtools-api/pull/154))**

No action required.

### Contributors:

Special thanks to the dedicated contributors who are the driving force behind this project, advancing it, enhancing its quality, and introducing new features.

- [@stollr](https://github.com/stollr) enhanced the person-api and implemented the capability to update data in churchtools and create new persons.
- [@devdot](https://github.com/devdot) upgraded Monolog to ensure compatibility with Laravel 10.
- [@a-schild](https://github.com/a-schild) provided valuable input for the appointment API, included the configuration request, and introduced the CombinedAppointment request.
- [@BiKi05](https://github.com/BiKi05) provided the inspiration for the song-statistic API and the DateTime cast.
- [@piridium](https://github.com/piridium) implemented a security fix.
- [@castilma](https://github.com/castilma) proposed documentation for handling exceptions.

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

