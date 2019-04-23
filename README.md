# OpenStackServer
A quickly thrown together web server that uses BASH scripts and PHP to make calls to OpenStack locally. Fair warning that due to the incredibly limited time, this project takes many shortcuts.

Index.php and createVM.sh are where most of the actual functionality comes from. Most of the other files are just there for parsing or getting something from the OpenStack server to display on the web page.

# Quick Note
Apache either has to own the /var/www/html/ folder or has to have write permission in order for this to properly work. It creates and parses several files with the various API call data.
