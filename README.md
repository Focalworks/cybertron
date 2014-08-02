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

### Sentry user and Permission
This module is a ready made user management and permission management module. Once this module is enabled and the Migrations are executed, this module creates a default Super Admin user and also creates a permission matrix system. The permission Matrix is a custom module which is using the Sentry groups along with custom tables to manage the permission management screen similar to drupal.

There will be a single function which can be used to check the access of a user based on the group he is in and the permission which his particular group has. 
[Note: This module depends completly on Sentry module]

#### How to use
To use this module, first we need to add the Service provider in app.php

    'Amitavroy\Sentryuser\SentryuserServiceProvider'

Once this is added, we need to run the migrations for this package and so a few additional tables are created and a default user with role Super Admin is created.

a) permissions b) permissision in groups.

##### Users
The user module has the basic login functionality which is internally using Sentry module. There is edit profile page where user can update his First name, Last name and also change his password.

##### Permissions
The permission setting page can be accessed from the top menu if you are using the complete Github application or through this url: "user/permission/list".