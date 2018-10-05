# Contributing to Deity MagentoApi code

First of all, thank you for taking the time to contribute! We embrace every commit, big or small.

The following is a set of guidelines for contributing to Deity Falcon. Please follow these guidelines as close as possible.

## Code of Conduct

By participating in this project, you and everyone else is expected to uphold to our Code of Conduct. Please report unacceptable behaviour to info@deity.io

## If you just have a question

Please don't file an issue to ask a question. You'll get faster results by using the resources below

## Contribution requirements

1. Contributions must adhere to the [Magento coding standards](https://devdocs.magento.com/guides/v2.2/coding-standards/bk-coding-standards.html).
2. Pull requests (PRs) must be accompanied by a meaningful description of their purpose. Comprehensive descriptions increase the chances of a pull request being merged quickly and without additional clarification requests.
3. Commits must be accompanied by meaningful commit messages. Please see the [Pull Request Template](PULL_REQUEST_TEMPLATE.md) for more information.
4. PRs which include bug fixes must be accompanied with a step-by-step description of how to reproduce the bug.
3. PRs which include new logic or new features must be submitted along with:
* Unit/integration test coverage
4. For larger features or changes, please [open an issue](https://github.com/deity-io/falcon-magento2-module/issues) to discuss the proposed changes prior to development. This may prevent duplicate or unnecessary effort and allow other contributors to provide input.

## How can I contribute?

If you'd like to contribute, start by searching through the issues and pull requests to see whether someone else has raised a similar idea or question.

## Minor issues

Under minor issues we understand:

- Typo fixes
- Small formatting fixes
- Adding/clearing non-trivial commented code

It is not necessary to create an issue for these, please create a pull request directly.

## Reporting Bugs

Before reporting please check if someone else has not already reported the same bug.

Please include the following in the report

- Steps to reproduce
- Expected and actual result
- Information of your environment
- Be as specific as possible

**Security vulnerabilities should be mailed directly to info@deity.io**

## Features/enhancements

New ideas and feature suggestions should be communicated first. Please use the community boards.

## Conventional commits

Based on https://conventionalcommits.org/

```
<type>[optional scope]: <description>

[optional body]

[optional footer]
```

- `BREAKING CHANGE:` - a commit that has the text BREAKING CHANGE: at the beginning of its optional body or footer section introduces a breaking API change (correlating with MAJOR in semantic versioning). A BREAKING CHANGE can be part of commits of any type.
- `fix:` - a commit that patches a bug in your codebase (this correlates with PATCH in semantic versioning).
- `feat:` - a commit that introduces a new feature to the codebase (this correlates with MINOR in semantic versioning).
- `improvement:` - a commit that improves a current implementation without adding a new feature or fixing a bug
- `build:` - a commit that with changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm)
- `ci:` - a commit that with changes to our CI configuration files and scripts (example scopes: Travis, Circle, BrowserStack, SauceLabs)
- `docs:` - a commit that with changes documentation only changes
- `perf:` - a commit with changes that improves performance
- `refactor:` - a commit with changes that neither are fixes a bug nor adds a feature
- `style:` - a commit with that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)
- `test:` - a commit with adding missing tests or correcting existing tests

#### Examples

- Commit message with description and breaking change in body:

```
feat: allow provided config object to extend other configs
BREAKING CHANGE:`extends`key in config file is now used for extending other config files
```

- Commit message with no body:

```
docs: correct spelling of CHANGELOG
```

- Commit message with scope:

```
feat(lang): added polish language
```

- Commit message for a fix using an (optional) issue number:

```
fix: minor typos in code

see the issue for details on the typos fixed

fixes issue #12
```