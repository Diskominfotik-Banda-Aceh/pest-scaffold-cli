Table of contents
=================
<!--ts-->
   * [Table of contents](#table-of-contents)
   * [Pest PHP Scaffold CLI](#pest-php-scaffold-cli)
      * [Installation](#installation)
          * [Pass a custom path](#pass-a-custom-path)
      * [Usage](#usage)
      * [Changelog](#changelog)
      * [Contributing](#contributing)
      * [Security](#security)
      * [About](#about)
      * [License](#license)
<!--te-->

Pest PHP Scaffold CLI
===

This project delivers a simple set of Console Commands to generate a directory structure for scaffold pest PHP test.

Installation
---
Install this command as a global composer package

```bash
$ composer require diskominfotik-banda-aceh/pest-scaffold-cli
```
Copy this provider to the `config/app.php`
```bash
DiskominfotikBandaAceh\PestScaffoldCli\Providers\PestTestProvider::class,
```

Usage
---

You can then create a new repository by calling the following command:

```bash
$ php artisan make:pest ModelName
```

This command will create a directory named `ModelNameController` in tests/Feature/Http/Controller and will create a basic setup for create, read, update, delete test controller.

The directory structure will look like following:

```bash
├── .gitignore
├── CHANGELOG.md
├── composer.json
├── README.md
├── tests/
│   ├── Feature
│      ├── Http
│          ├── Controller
│             ├── ModelNameController

```

All the files and classes will have set the correct names and namespaces, but remember that the generator is just creating a starting point. You should go through the files and add stuff that is missing.

### Pass a custom path

You can also pass an second argument specifying the path where the tests should be generated.

```bash
$ php artisan make:pest ModelName --path="\Feature\Http\Controller"
```

Above example would generate the scaffold test at `./tests/Feature/Http/Controller/ModelNameController`. This can be handy if you want to use this generator within an existing Laravel project.

### The `--crud=c,r,u,d` option

By default you will get all of the test scaffold but you can add `c` or `r` or `u` or `d` for specific file. 

```bash
$ php artisan make:pest ModelName --crud=c,r,u,d
```

Changelog
---
Check [CHANGELOG](CHANGELOG.md) for the changelog

Contributing
---
*Information will follow soon*


Security
---
If you discover any security related issues, please email diskominfotikbna@gmail.com or use the issue tracker of GitHub.

About
---
Diskominfotik Banda Aceh is a government from Banda Aceh, Banda Aceh creating custom digital solutions. Visit [our website](https://bandaacehkota.go.id) to find out more about us.

License
---
The MIT License (MIT). Please see [License File](https://github.com/Diskominfotik-Banda-Aceh)
for more information.
