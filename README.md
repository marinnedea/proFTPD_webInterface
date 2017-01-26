# proFTPD_webInterface
Another ProFTPD web interface built in PHP with MySQL backend.

# About the Web Interface
- the whole code is based on the https://github.com/thedigicraft/Atom.CMS project. I only used the "admin area" of the project and customized it according to my needs.

# Requirements
- proFTPD compiled with mysql support. I used the official instructions on http://www.proftpd.org/docs/howto/SQL.html but changed a bit the DB to match my setup and what I had in mind. Check the attached ftps.sql file for DB setup.
- A webserver running on the same machine with the proFTPD server. I used the steps in this tutorial: https://www.howtoforge.com/tutorial/install-apache-with-php-and-mysql-lamp-on-debian-jessie/ 

# Default credentials:
- username: test@user.com
- password: Passw0rd

The above should be changed to something more secure.

# Installation
- download the project files on your system.
- with an text editor ( I prefer notepad++ on windows systems and nano on GNU/linux systems) modify the following files:
  - /config/connection.php - change:
    - my_server_address with your server address ( usually localhost )
    - my_user with the user needed to access your mysql DB
    - my_password with the paswword of the user set to access your mysql DB
    - my_database with your mysql DB name
  - /config/setup.php - change in the line <$site_title = 'FTPS - My Site';> the FTPS - My Site with your own site name.
  - import the ftps.sql file in your DB (make sure is the same DB you set in the above files)
- just copy the whole content of the project in a directory of your choice in your webserver. ( e.g. /var/www/ftpadmin ) 
- access it (open it in browser, eg: http://192.168.1.100/ftpadmin) and login with the credentials provided above.
- the interface itself is very self intuitive, just experiment with it and ofcourse, feel free to change it/improve it.

# proFTPD config file changes
- use the attached proftpd.conf and modules.conf files as an example on how your files should look like. 
- copy "as it is" the lines from 90 to 143 from my sample proftpd.conf file in your proftpd.conf file and make sure there are no conflicts with already existing settings.
- for the modules, for every uncommented module in modules.conf make sure you DO HAVE the module installed. Please refer to the http://proftpd.org page for instructions.

# Support
Unfortunatelly, I don't have the time for it. Everything is provided as it is. If you need support, please rememeber that I would probably never answer your question in time. 

# To do
I should completelly rewrite and clean the code. There are many chunks of code just lying around in pages, that could be transformed in some specific functions and called only when needed.,, but didn't had the time to organize it. I tried to comment and document the code as much as I could, but most of the code was writen on necessity basis.
So, while is not very clean (I shouldn't use "clean" in here at all), it does work.

If and when I'll have the time, I'll continue to update it.

#Feel free to contribute.



