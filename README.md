<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Flexico Fleet Management


### Progress

### Functional
Create a database for the MySQL source based on the included data structure. - done

Write an Artisan console command to create a vehicle and save to the database. - done

### Create new Vehicle command
* php artisan create:vehicle

Create API endpoints for;

      Returning all vehicles from the different sources

      Fetch vehicle data based on the source and identifier - done

      Update vehicles which are stored in the MySQL database - Done

Create an API that is capable of:

     a. Retrieve vehicle data based on source type and identifier. - done
     b. Update vehicle data in the MySQL database (identifier, make, model, year). - done
     c. Return response on all the requests. - done
    Cover your code with unit and feature tests accordingly.

### Non-functional

    Create a new empty branch, give it a sensible. - done
    Keep the code simple, but do apply design patterns and engineering principles. -done
    Do not re-invent the wheel. Use packages where possible but dont over-use them either. -done

### Bonus points

    Create API documentation using Postman, Paw and/or OpenAPI.
    Enforce PSR-2 coding styles
        Create a composer command to be able to repeatedly execute the check and fix.
