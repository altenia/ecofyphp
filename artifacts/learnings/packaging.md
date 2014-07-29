Composer Packaging
==================

In order to make a package. Two essential steps + one optional step is required.

## 1. Step one: Put the project in Github. ##
A commonly used project directory structure is:
	src - All the library source files go here. Folders are organized hierarchicaly by the namespace.
	tsts - All the phpunit tests files go here.
	composer.json
	LICENSE
	phpunit.xml
	README.md

## 2. Step two: Create a composer.json file in the library. ##
composer.json file:

	{
	    "name": "<github-account>/<repo-name>",
	    "autoload": {
	        "psr-0" : {
	            "<folder>" : "src"
	        }
	    }
	}
Example:

	{
	    "name": "altenia/ecofy",
	    "autoload": {
	        "psr-0" : {
	            "Altenia\\Ecofy" : "src"
	        }
	    },

	}

Once you have the library project with the composer.json file correctly configured pushed to GitHub, you can the easily include the library by requiring it in the project's composer.json.

The followig is the composer.json file of the project that uses the library:
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/altenia/ecofy"
    }
],

Then run `composer update`

## 2. Step three (optional): Register with Packagist. ##
Register the library so it is known to the community.

Source[1]

[1] http://knpuniversity.com/screencast/question-answer-day/create-composer-package