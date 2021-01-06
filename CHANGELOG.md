# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.2.0] - 2021-01-06

### Changed
- **[BC BREAK]** Bump minimal PHP version to 8.*
- **[BC BREAK]** Change payload results class name based on their parent
- Use constructor property promotion
- Remove obsolete ```get_class``` from exceptions
- Use a null safe operator in ```RequestAccessor```
- Define return value of ```Metadata```

## [0.1.1] - 2021-01-05

### Added
- Create a CHANGELOG.md in the root directory 

### Changed
- Rename ```ProcessResultMiddleware``` to ```TransformResultMiddleware```

## Fixed
- Fix a default redirect status code
- Fix reference variable name for ```RequestAccessor```

[Unreleased]: https://github.com/Tuzex/responder/compare/v0.2.0...HEAD
[0.2.0]: https://github.com/Tuzex/responder/releases/tag/v0.2.0
[0.1.1]: https://github.com/Tuzex/responder/releases/tag/v0.1.1
