# Codeigniter3 Login Application
Login, Logout, Create New User with Permissions on Codeigniter 3

This application was built as a templete for anyone who needs login/out features on a codeigniter web application which also supports creating new users and permissions.

##Features
- Create new users from your application
- Change user permissions
- Easy force of Login/Admin privileges
- Redirect to previouse page after login

##Installation
1. Clone this project onto your server
2. Add the following to your Apache server configuration or allow .htaccess overrides.
```apache
    <Directory /var/www/html/gallery.williambargent>
         AllowOverride All
   </Directory>
```
or
```apache
   <Directory /var/www/html/>
      AllowOverride All
      RewriteEngine on
      RewriteCond $1 !^(index\.php|resources|robots\.txt)
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule ^(.*)$ index.php/$1 [L,QSA]
   </Directory>
```
3. Add a databases and set your URL in the `application/config/database.php` and `application/config/config.php`
4. Run the following to create the desired tables in your database,

```sql
CREATE TABLE `users` (
  `uid` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `account_type` varchar(10) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE `permissions` (
  `uid` int(4) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `new_user` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
```

5. Add your domain to the `$config['base_url'] = '';` in `applications/config/config.php`
6. Navigate to domain.com/setup to create the admin user.
7. Delete the setup controller and view for security. `applications/controllers/Setup.php` and `applications/views/setup.php`
