#/bin/sh
# Perfect Server dengan ISP Config 2.3 [Ubuntu-9.10]
# <me@simukti.net>
# Diolah dari howtoforge
# hostname: server1
# Domain: example.com
-----------------------------------
sudo su
nano /etc/hostname
#server1
nano /etc/hosts
#127.0.1.1 server1
#192.168.73.10 server1.example.com server1
reboot
-----------------------------------
sudo su
dpkg-reconfigure dash
#Install dash as /bin/sh? <-- No
-----------------------------------
# buang app-armor
sudo /etc/init.d/apparmor stop
sudo update-rc.d -f apparmor remove
sudo aptitude remove apparmor apparmor-utils
-----------------------------------
# install ini dalam 1 baris
sudo apt-get install binutils cpp fetchmail flex gcc libarchive-zip-perl 
libc6-dev libcompress-zlib-perl libdb4.6-dev libpcre3 
libpopt-dev lynx m4 make ncftp 
nmap openssl perl perl-modules unzip zip 
zlib1g-dev autoconf automake1.9 libtool bison autotools-dev g++ build-essential
-----------------------------------
# install quota
sudo apt-get install quota
# lakukan langkah ini cuma klo butuh quota
sudo nano /etc/fstab
# /etc/fstab: static file system information.
#
# Use 'blkid -o value -s UUID' to print the universally unique identifier
# for a device; this may be used with UUID= as a more robust way to name
# devices that works even if disks are added and removed. See fstab(5).
#
# <file system> <mount point>   <type>  <options>       <dump>  <pass>
proc            /proc           proc    defaults        0       0
/dev/mapper/server1-root /               ext4    errors=remount-ro,usrjquota=aquota.user,grpjquota=aquota.group,jqfmt=vfsv0 0       1
# /boot was on /dev/sda5 during installation
UUID=9ea34148-31b7-4d5c-baee-c2e2022562ea /boot           ext2    defaults        0       2
/dev/mapper/server1-swap_1 none            swap    sw              0       0
/dev/scd0       /media/cdrom0   udf,iso9660 user,noauto,exec,utf8 0       0
/dev/fd0        /media/floppy0  auto    rw,user,noauto,exec,utf8 0       0

# perintah
touch /aquota.user /aquota.group
chmod 600 /aquota.*
mount -o remount /

quotacheck -avugm
quotaon -avug
-----------------------------------
# install BIND9 chrooted
sudo apt-get install bind9
#stop dulu dns service.nya
sudo /etc/init.d/bind9 stop
#edit config default bind9
sudo nano /etc/default/bind9
#
# run resolvconf?
RESOLVCONF=yes

# startup options for the server
OPTIONS="-u bind -t /var/lib/named"
#

sudo mkdir -p /var/lib/named/etc
sudo mkdir /var/lib/named/dev
sudo mkdir -p /var/lib/named/var/cache/bind
sudo mkdir -p /var/lib/named/var/run/bind/run

#pindahkan config dari /etc
mv /etc/bind /var/lib/named/etc

#buat symlink biar gak bentrok waktu update bind nanti
ln -s /var/lib/named/etc/bind /etc/bind

# buat random device dan null, dan set file perms
mknod /var/lib/named/dev/null c 1 3
mknod /var/lib/named/dev/random c 1 8
chmod 666 /var/lib/named/dev/null /var/lib/named/dev/random
chown -R bind:bind /var/lib/named/var/*
chown -R bind:bind /var/lib/named/etc/bind

# buat file ini
nano /etc/rsyslog.d/bind-chroot.conf
#isikan ini
$AddUnixListenSocket /var/lib/named/dev/log

#restart logging daemon
/etc/init.d/rsyslog restart

#start bind
/etc/init.d/bind9 start
-----------------------------------
# Install MySQL
apt-get install mysql-server mysql-client libmysqlclient15-dev

#rubah bind addr biar bisa dari network
nano /etc/mysql/my.cnf
#bind-address           = 127.0.0.1

#cek service MySQL
netstat -tap | grep mysql
-----------------------------------
# Install Postfix dengan SMTP-AUTH dan TLS
apt-get install postfix libsasl2-2 sasl2-bin libsasl2-modules procmail
#General type of mail configuration: <-- Internet Site
#System mail name: <-- server1.example.com

dpkg-reconfigure postfix
#General type of mail configuration: <-- Internet Site
#System mail name: <-- server1.example.com
#Root and postmaster mail recipient: <-- [blank]
#Other destinations to accept mail for (blank for none): <-- server1.example.com, localhost.example.com, localhost.localdomain, localhost
#Force synchronous updates on mail queue? <-- No
#Local networks: <-- 127.0.0.0/8 [::ffff:127.0.0.0]/104 [::1]/128
#Use procmail for local delivery? <-- Yes
#Mailbox size limit (bytes): <-- 0
#Local address extension character: <-- +
#Internet protocols to use: <-- all

postconf -e 'smtpd_sasl_local_domain ='
postconf -e 'smtpd_sasl_auth_enable = yes'
postconf -e 'smtpd_sasl_security_options = noanonymous'
postconf -e 'broken_sasl_auth_clients = yes'
postconf -e 'smtpd_sasl_authenticated_header = yes'
postconf -e 'smtpd_recipient_restrictions = permit_sasl_authenticated,permit_mynetworks,reject_unauth_destination'
postconf -e 'inet_interfaces = all'
echo 'pwcheck_method: saslauthd' >> /etc/postfix/sasl/smtpd.conf
echo 'mech_list: plain login' >> /etc/postfix/sasl/smtpd.conf

#buat sertifikat untuk TLS
mkdir /etc/postfix/ssl
cd /etc/postfix/ssl/
openssl genrsa -des3 -rand /etc/hosts -out smtpd.key 1024

chmod 600 smtpd.key
openssl req -new -key smtpd.key -out smtpd.csr

openssl x509 -req -days 3650 -in smtpd.csr -signkey smtpd.key -out smtpd.crt

openssl rsa -in smtpd.key -out smtpd.key.unencrypted

mv -f smtpd.key.unencrypted smtpd.key
openssl req -new -x509 -extensions v3_ca -keyout cakey.pem -out cacert.pem -days 3650

#pastikan myhostname.nya benar
postconf -e 'myhostname = server1.example.com'

postconf -e 'smtpd_tls_auth_only = no'
postconf -e 'smtp_use_tls = yes'
postconf -e 'smtpd_use_tls = yes'
postconf -e 'smtp_tls_note_starttls_offer = yes'
postconf -e 'smtpd_tls_key_file = /etc/postfix/ssl/smtpd.key'
postconf -e 'smtpd_tls_cert_file = /etc/postfix/ssl/smtpd.crt'
postconf -e 'smtpd_tls_CAfile = /etc/postfix/ssl/cacert.pem'
postconf -e 'smtpd_tls_loglevel = 1'
postconf -e 'smtpd_tls_received_header = yes'
postconf -e 'smtpd_tls_session_cache_timeout = 3600s'
postconf -e 'tls_random_source = dev:/dev/urandom'

# pastikan isi file main.cnf seperti di contoh file: perfectServer_ISP_CONFIG2_main.cf.txt

mkdir -p /var/spool/postfix/var/run/saslauthd

#lalu edit /etc/default/saslauthd untuk mengaktifkan saslauthd. 
#Set START to yes and change the line
START=yes
OPTIONS="-c -m /var/run/saslauthd" 
#menjadi 
OPTIONS="-c -m /var/spool/postfix/var/run/saslauthd -r"

#tambahkan user postfix sasl
adduser postfix sasl

#jalankan postfix dan sasl
/etc/init.d/postfix restart
/etc/init.d/saslauthd start

#coba cek 
telnet localhost 25
ehlo localhost
#klo uda seperti dibawah ini berarti sudah benar
telnet localhost 25
Trying ::1...
Connected to localhost.localdomain.
Escape character is '^]'.
220 server1.example.com ESMTP Postfix (Ubuntu)
ehlo localhost
250-server1.example.com
250-PIPELINING
250-SIZE 10240000
250-VRFY
250-ETRN
250-STARTTLS
250-AUTH PLAIN LOGIN
250-AUTH=PLAIN LOGIN
250-ENHANCEDSTATUSCODES
250-8BITMIME
250 DSN
quit
221 2.0.0 Bye
Connection closed by foreign host.

-----------------------------------
# Install Courier-IMAP/Courier-POP3
apt-get install courier-authdaemon courier-base courier-imap courier-imap-ssl courier-pop courier-pop-ssl courier-ssl gamin libgamin0 libglib2.0-0
#Create directories for web-based administration? <-- No
#SSL certificate required <-- Ok

#buang sertifikat bawaan instalasi courier
cd /etc/courier
rm -f /etc/courier/imapd.pem
rm -f /etc/courier/pop3d.pem

# edit imapd.cnf
nano /etc/courier/imapd.cnf
#isikan CN=server1.example.com
#sesuai FQDN name servermu

#edit pop3d.cnf
nano /etc/courier/pop3d.cnf
#isikan CN=server1.example.com
#sesuai FQDN name servermu

#lalu buat sertifikat lagi
mkimapdcert
mkpop3dcert

# restart service IMAP dan POP3
/etc/init.d/courier-imap-ssl restart
/etc/init.d/courier-pop-ssl restart

#NOTE: klo gak pingin pake ISPConfig, suruh postfix pake Maildir/
#postconf -e 'home_mailbox = Maildir/'
#postconf -e 'mailbox_command ='
#/etc/init.d/postfix restart
#
# *Please note: You do not have to do this if you intend to use ISPConfig on your system as ISPConfig does the necessary configuration using procmail recipes. 
# But please go sure to enable Maildir under Management -> Server -> Settings -> EMail in the ISPConfig web interface. 
#


-----------------------------------
# Install Apache/PHP5/Ruby/Python/WebDAV
apt-get install apache2 apache2-doc apache2-mpm-prefork apache2-utils apache2-suexec libexpat1 ssl-cert

# lalu install PHP, Ruby, Python sbagai apache-module
apt-get install libapache2-mod-php5 libapache2-mod-ruby libapache2-mod-python 
php5 php5-common php5-curl php5-dev php5-gd php5-idn php-pear 
php5-imagick php5-imap php5-mcrypt php5-memcache php5-mhash php5-ming 
php5-mysql php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl

#lalu edit mod_userdir
nano /etc/apache2/mods-available/dir.conf
#ganti baris DIrectoryIndex
#<IfModule mod_dir.c>
#          #jadi seperti ini
#         DirectoryIndex index.html index.htm index.shtml index.cgi index.php index.php3 index.pl index.xhtml
#</IfModule>

#aktifkan module yang dperlukan
a2enmod ssl
a2enmod rewrite
a2enmod suexec
a2enmod include
a2enmod dav_fs
a2enmod dav

#restart apache
/etc/init.d/apache2 restart

#aktifkan MIME ruby
nano /etc/mime.types
#application/x-ruby

# restart lagi apache.nya
/etc/init.d/apache2 restart

#disable.kan PHP secara global biar persite punya setting sendiri2
nano /etc/mime.types
#comment baris dibawah ini
[...]
#application/x-httpd-php                                phtml pht php
#application/x-httpd-php-source                 phps
#application/x-httpd-php3                       php3
#application/x-httpd-php3-preprocessed          php3p
#application/x-httpd-php4                       php4
[...]

#edit konfigurasi php5
nano /etc/apache2/mods-enabled/php5.conf
<IfModule mod_php5.c>
#  AddType application/x-httpd-php .php .phtml .php3
#  AddType application/x-httpd-php-source .phps
</IfModule>

# restart lagi apache.nya
/etc/init.d/apache2 restart
-----------------------------------
# Install FTP Server [ProFTPd]
apt-get install proftpd ucf
#Run proftpd: <-- standalone

#edit proftpd config
nano /etc/proftpd/proftpd.conf
[...]
DefaultRoot ~
IdentLookups off
ServerIdent on "FTP Server ready."
[...]

# buat symlink proftpd.conf untuk ISPCOnfig2
ln -s /etc/proftpd/proftpd.conf /etc/proftpd.conf

#restart service proftpd
/etc/init.d/proftpd restart

-----------------------------------
# install webalizer
sudo apt-get install webalizer
-----------------------------------
#sinkronkan jam dengan NTP [klo ada akses internet]
# apt-get install ntp ntpdate
-----------------------------------
#install modul perl untuk spamassasin bawaan ISPConfig2
install libhtml-parser-perl libdb-file-lock-perl libnet-dns-perl
-----------------------------------
# Download ISPConfig2
#rubah stdio.h di baris 651, ganti getline dengan parseline
nano /usr/include/stdio.h
#jadikan seperti dbawah ini
[...]
   This function is not part of POSIX and therefore no official
   cancellation point.  But due to similarity with an POSIX interface
   or due to the implementation it is a cancellation point and
   therefore not marked with __THROW.  */
extern _IO_ssize_t parseline (char **__restrict __lineptr,
                            size_t *__restrict __n,
                            FILE *__restrict __stream) __wur;
#endif
[...]
#klo uda installl ispconfig, rubah lagi baris itu ke awal
-----------------------------------
# catetan untuk SuExec
#jika ingin menjalankan suexec di ispconfig, webroot harus /var/www
/usr/lib/apache2/suexec -V
#outputnya harus seperti di bawah ini :
root@server1:~# /usr/lib/apache2/suexec -V
 -D AP_DOC_ROOT="/var/www"
 -D AP_GID_MIN=100
 -D AP_HTTPD_USER="www-data"
 -D AP_LOG_EXEC="/var/log/apache2/suexec.log"
 -D AP_SAFE_PATH="/usr/local/bin:/usr/bin:/bin"
 -D AP_UID_MIN=100
 -D AP_USERDIR_SUFFIX="public_html"