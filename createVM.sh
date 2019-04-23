#!/bin/bash
OS_TOKEN="$(./parseProjectToken.sh)"
nameVar=$(cat /var/www/html/tmp/vmName);
imageVar=$(cat /var/www/html/tmp/vmImage);
flavorVar=$(cat /var/www/html/tmp/vmFlavor);
curl -X POST -s http://192.168.1.253:8774/v2.1/servers \
    -d '{"server": { "name": '$nameVar', "imageRef": '$imageVar', "flavorRef": '$flavorVar', "networks": [{"uuid":"edb66dc2-91ba-4a74-bcd5-e650637f618a"}]}}' \
	-H "X-Auth-Token: $OS_TOKEN" \
    -H "Content-Type: application/json" > /var/www/html/tmp/instanceID
