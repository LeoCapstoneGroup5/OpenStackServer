#!/bin/bash
sed -n 's/"url": //p' /var/www/html/tmp/vmURL | tr -d '", ' | sed 's/.*://'
