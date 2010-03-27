README
======

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or 
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.
and this is my current apache virtual host configuration for this project :

Listen 12005
NameVirtualHost *:12005
<VirtualHost *:12005>
    ServerAdmin webmaster@dummy-host.example.com
    # point this to your own absolute path
    DocumentRoot "D:\_sharecode\simuktiblogspot\php\zf\simukti-zf-db-sakila/public"
    <Directory "D:\_sharecode\simuktiblogspot\php\zf\simukti-zf-db-sakila/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
    ErrorLog "logs/virtualHostsError.log" # make sure this file is exist on your apache log folder
    CustomLog "logs/virtualHostsAccess.log" common # make sure this file is exist on your apache log folder
</VirtualHost>


Setting Up Your MySQL Database
==============================

For this project, I use SAKILA database (MySQL example).
Download it from here : http://dev.mysql.com/doc/index-other.html