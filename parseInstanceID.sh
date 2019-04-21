#!/bin/bash
python -m json.tool /var/tmp/instanceID > /var/tmp/instanceIDCleaned
sed -n 's/"id": //p' /var/tmp/instanceIDCleaned | tr -d '", '
