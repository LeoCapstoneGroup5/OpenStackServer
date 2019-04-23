#!/bin/bash
python -m json.tool /var/www/html/tmp/instanceID > /var/www/html/tmp/instanceIDCleaned
sed -n 's/"id": //p' /var/www/html/tmp/instanceIDCleaned | tr -d '", '
