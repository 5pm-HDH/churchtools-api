# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased] - 2021-04-21

### Added

- CTLog: [add Monolog as Logger-Framework](https://github.com/5pm-HDH/churchtools-api/issues/25)
- Models:
  - [Service / ServiceGroup - Models](https://github.com/5pm-HDH/churchtools-api/issues/23)
  - [EventService](https://github.com/5pm-HDH/churchtools-api/issues/23) to retrieve the Services of an Event
- Requests:
  - [ServiceRequest / ServiceGroupRequest](https://github.com/5pm-HDH/churchtools-api/issues/23)
  
### Changed

- TODO

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

