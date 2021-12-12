# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.10.1] - 2021-12-12

### Changed
- Fix `Template` payload name

## [0.10.0] - 2021-12-11

### Changed
- **[BC BREAK]** Add SF6 support
- **[BC BREAK]** Extract `flashMessage` from `Resource`
- **[BC BREAK]** Focus `FlashMessageEmitter` only on `Redirect
- **[BC BREAK]** Rename `ResponseFactory` main directory
- **[BC BREAK]** Remove `ContextResponder::extend` public method
- **[BC BREAK]** Rename `ContextResponder` to `FlexibleResponder`
- **[BC BREAK]** Rework response resources
- **[BC BREAK]** Rework HTTP headers
- **[BC BREAK]** Split to create `MultipartContentDisposition` HTTP header
- Bump PHP version to 8.1 and higher
- Rework `StatusCode` to `Enum`
- Bump PHPStan library

## [0.9.0] - 2021-11-29

### Changed
- **[BC BREAK]** Add SF6 support
- Bump PHPStan library

## [0.8.2] - 2021-14-11

### Changed
- Add JPG file resources
- Add ZIP file resources

## [0.8.0] - 2021-10-11

### Changed
- **[BC BREAK]** Rename `ResponseResource` to `Resource`
- **[BC BREAK]** Rename `ResponseResource` static factories

## [0.7.0] - 2021-09-28

### Changed
- **[BC BREAK]** Rename `ResponseDefinition` to `ResponseResource`

## [0.6.0] - 2021-08-31

### Changed
- **[BC BREAK]** Use `ResponseDefinition` instead of obsolete `Result`
- **[BC BREAK]** Remove `Responder` interface
- Create static factories for HTTP headers
- Make `ContentDisposition` private constructor

## [0.5.0] - 2021-07-04

### Changed
- **[BC BREAK]** Rename `Data::define` to `Date::send`
- **[BC BREAK]** Define `JsonData::define` to `JsonData::send`
- **[BC BREAK]** Define `HtmlContent::define` to `HtmlContent::send`
- **[BC BREAK]** Define `Plaintext::define` to `Plaintext::send`
- **[BC BREAK]** Define `Template::define` to `Template::render`
- **[BC BREAK]** Define `TwigTemplate::define` to `TwigTemplate::render`
- **[BC BREAK]** Define `ReferrerRedirect::define` to `ReferrerRedirect::order`
- **[BC BREAK]** Define `RouteRedirect::define` to `RouteRedirect::order`
- **[BC BREAK]** Define `UrlRedirect::define` to `UrlRedirect::order`
- **[BC BREAK]** Define `UriRedirect::define` to `UriRedirect::order`
- Rename `FlexResponder` to `PipeResponder`

## [0.4.0] - 2021-02-16

### Changed
- **[BC BREAK]** Rename `RedirectResponseFactory` to `UrlRedirectResponseFactory`
- **[BC BREAK]** Define `Responder` as a interface
- Implement `FlexResponder` supporting middlewares

## [0.3.0] - 2021-02-12

### Added
- Add support of a flash messaging
- Implement `ResponseFactory` for specific results
- Implement `UriProvider` and `ReferrerProvider` based on Symfony `Request`
- Define XML mime type

### Changed
- **[BC BREAK]** Change payload results class name
- **[BC BREAK]** Remove getter method prefixes
- Define `UriProvider` as an interface
- Define `ReferrerProvider` as an interface

### Remove
- **[BC BREAK]** Remove result transformers
- **[BC BREAK]** Remove metadata

## [0.2.0] - 2021-01-06

### Changed
- **[BC BREAK]** Bump minimal PHP version to 8.*
- **[BC BREAK]** Change payload results class name based on their parent
- Use constructor property promotion
- Remove obsolete `get_class` from exceptions
- Use a null safe operator in `RequestAccessor`
- Define return value of `Metadata`

## [0.1.1] - 2021-01-05

### Added
- Create a CHANGELOG.md in the root directory 

### Changed
- Rename `ProcessResultMiddleware` to `TransformResultMiddleware`

## Fixed
- Fix a default redirect status code
- Fix reference variable name for `RequestAccessor`

[Unreleased]: https://github.com/Tuzex/responder/compare/v0.10.1...HEAD
[0.10.1]: https://github.com/Tuzex/responder/releases/tag/v0.10.1
[0.10.0]: https://github.com/Tuzex/responder/releases/tag/v0.10.0
[0.9.0]: https://github.com/Tuzex/responder/releases/tag/v0.9.0
[0.8.2]: https://github.com/Tuzex/responder/releases/tag/v0.8.2
[0.8.0]: https://github.com/Tuzex/responder/releases/tag/v0.8.0
[0.7.0]: https://github.com/Tuzex/responder/releases/tag/v0.7.0
[0.6.0]: https://github.com/Tuzex/responder/releases/tag/v0.6.0
[0.5.0]: https://github.com/Tuzex/responder/releases/tag/v0.5.0
[0.4.0]: https://github.com/Tuzex/responder/releases/tag/v0.4.0
[0.3.0]: https://github.com/Tuzex/responder/releases/tag/v0.3.0
[0.2.0]: https://github.com/Tuzex/responder/releases/tag/v0.2.0
[0.1.1]: https://github.com/Tuzex/responder/releases/tag/v0.1.1
