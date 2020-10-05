# Quick Start

## Starter Kit
We provide a starter kit [awema-pl-project](https://github.com/awema-pl/awema-pl) for you.

## Installation
We are hosted on a package management platform [Package Kit](https://www.awema.pl). For start of work you have to create an account (if non-exist), create a project and get an `API` token to get the possibility to install our packages.

**Step-by-step way:**
1. Create an account on [Package Kit](https://www.awema.pl/register)
2. Follow the link to [create an project](https://www.awema.pl/projects#add_project)
3. Connect one or more packages to your new project
4. Copy your `API` token for the project
5. Add the config to `composer.json`

```json
{
 "repositories": [{
   "type": "composer",
   "url": "https://repo.awema.pl",
   "options":  {
     "http": {
       "header": [
         "API-TOKEN: <!-- API token from awema.pl -->"
       ]
     }
   }
 }]
}
```

**Enjoy!** Now, you are ready to install our modules in standard way like:

```bash
composer require awema-pl/{package-name}
```