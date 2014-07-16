## Cybertron workbench

### Mailing Package
This package is intended to handle mailing for any site. This module will provide a single function which will allow sending email and also manage a history in a DB.

Currently this mail suppoerts SMTP email sending but will add more methods so that it can be used in any kind of situation.

#### How to use
To use this module, first we need to add the Service provider in app.php

    'Amitavroy\Mailing\MailingServiceProvider'

Once the provider is added, we need to configure the mail.php config file with the SMTP details which will be used to send emails.

Once the configuration is done, we can do something like this

    $MailTracker = new MailTracker;
    $MailTracker->sendMail($mail_to, $mail_from, $mail_subject, $mail_body, $mail_to_name, $mail_from_name);

And this will send the email and save information is the DB also.

## Laravel PHP Framework

[![Latest Stable Version](https://poser.pugx.org/laravel/framework/version.png)](https://packagist.org/packages/laravel/framework) [![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.png)](https://packagist.org/packages/laravel/framework) [![Build Status](https://travis-ci.org/laravel/framework.png)](https://travis-ci.org/laravel/framework) [![License](https://poser.pugx.org/laravel/framework/license.png)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.