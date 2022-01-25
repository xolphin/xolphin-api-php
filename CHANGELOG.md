# Changelog

All notable changes to the wrapper will be documented in this file.

## [3.0.0]
### Updated
- Dropped support for all versions below PHP 7.4
- Some minor code-style changes
- Made class properties typed and worked on type consistency
- Updated guzzle from `6.x|7.x` to `^7.4`
- Minor changes in the readme
- Updated the phpunit.xml configuration file
- Changed the response base pagination into a Pagination class see Issue:#23
### Added
- Added support for PHP 8.0
- Added the `disableFreeSan` field for requests.
- Added an interface for the requests
- Added tests for the ApiRequests
### Removed
- Dropped support for all versions below PHP 7.4
- Removed functions previously marked deprecated
- Removed deprecated RequestDCV class
- Removed EncryptionEverywhere support

## [2.0.1]

### Updated

- Returntype of getMessage method (issue #18)

## [2.0.0]

### Updated

- Support for PHP upgraded to >= 7.2
- Support for PHP 5.6 is now on deprecated. Latest version supporting this is 1.8.4
- Refactored UnitTests for compatibility with PHPUnit 8
- Removed method sendComodoSAEmail on Request Endpoint
- Lowered Endpoint class creation count ($client->certificate()->... is now $client->certificates->...)

### Added

- Created seperate namespace for Helpers that return API Strings

## [1.8.3]

### Added

- Added support for SSLCheck
- Added support for Invoices
- Added support for scheduling validation calls

### Updated

- Updated Client with remaining request count
- Added sa_email and referenceOrderNr to Request (Pull request #12)
- Deprecated sendComodoSAEmail, replaced by sendSectigoSAEmail

## [1.6.2]

### Updated

- Made the request notes visible in the request endpoint

## [1.6.1]

### Updated

- Error handling in Client (pull request #5)
- Correct extra domain and price information for MDC in support/products

## [1.6.0]

### Added

- Compatability with Xolphin REST Api v1.6.0
- Support for the new Comodo DCV method
- Supports the uniqueValueDcv (optional) to send an own unique DCV token
- Compatability with Encryption Everywhere

### Updated

- Better error handling
- Updated markup of the code
