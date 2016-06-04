![Hydra](https://raw.githubusercontent.com/tetreum/hydra/master/images/logo.png)

# Hydra  [![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE) [![Issues](https://img.shields.io/github/issues/tetreum/hydra.svg?style=flat)](https://github.com/tetreum/hydra/issues)

Automatically replicates the latest uploaded torrents from one user to multiple pastebin like sites. (Pastes can be public or private).

![Hydra](https://raw.githubusercontent.com/tetreum/hydra/master/images/1.png)

# Available pastebin providers

- Pastebin:
    - To get the API key, login & visit http://pastebin.com/api
    - A PRO account is recommended otherwise, you will have to fill a captcha for each created paste...
 

# Setup

1. Run ```composer install```
2. Setup your user data & keys in conf.php
3. Edit cronjobs/checkUploads.php to set the desired user to copy his uploads.
4. Create a cron to execute ```php cronjobs/checkUploads.php``` or manually execute it.

# Requirements

- PHP >=5.5
- composer (getcomposer.org)