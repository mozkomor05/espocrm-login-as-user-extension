# Module - Login as User

Adds "Login as User" feature for administrators, making it, for example, easier to debug ACL.

## Table of Contents

* [Introduction](#introduction)
* [Requires](#requires)
* [Installation](#installation)
    * [Pre-build extension release](#pre-build-extension-release)
    * [Build from source](#build-from-source)

## Introduction

Adds "Login as User" feature for administrators, making it, for example, easier to debug ACL.

## Requires

- EspoCRM >= 7.0
- PHP >= 7.4

## Installation

### Pre-build extension release

1. Download the latest release from [Release page](https://github.com/mozkomor05/espocrm-login-as-user-extension/releases/latest).
2. Go to **Administration** -> **Extensions** and upload the downloaded file.

### Build from source

1. Make sure than `node`, `npm` and `composer` are installed.
2. Clone the repository.
3. Run `npm install`.
4. Run `grunt package`. This will create a `dist` folder with the final extension package..

#### Deploying

Optionally you can create a `.env` file based on the `.env.template` file. The `.env` file will be used to deploy the
extension to an existing EspoCRM installation.

**Linux example**

```shell
mv .env.template .env
vim .env # edit the file
grunt deploy # deploy the extension
```
