#!/bin/bash
OS_TOKEN="$(./parseProjectToken.sh)"
curl -s http://192.168.1.253:8774/v2.1/servers \
-H "X-Auth-Token: $OS_TOKEN"
