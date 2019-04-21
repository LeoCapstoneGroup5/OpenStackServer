#!/bin/bash
OS_TOKEN="$(./parseProjectToken.sh)"
nameVar=$(cat /tmp/vmName);
imageVar=$(cat /tmp/vmImage);
flavorVar=$(cat /tmp/vmFlavor);
curl -X POST -s http://192.168.1.253:8774/v2.1/servers \
    -d '{"server": { "name": '$nameVar', "imageRef": '$imageVar', "flavorRef": '$flavorVar', "networks": [{"uuid":"edb66dc2-91ba-4a74-bcd5-e650637f618a"}]}}' \
	-H "X-Auth-Token: $OS_TOKEN" \
    -H "Content-Type: application/json" > /var/tmp/instanceID
