#!/bin/bash
OS_TOKEN="$(./parseProjectToken.sh)"
instanceID="$(./parseInstanceID.sh)";
curl -X POST -s http://192.168.1.253:8774/v2.1/servers/$instanceID/action \
    -d '{"os-getVNCConsole": {"type": "novnc"}}' \
	-H "X-Auth-Token: $OS_TOKEN" \
    -H "Content-Type: application/json" | python -m json.tool > /var/tmp/vmURL
