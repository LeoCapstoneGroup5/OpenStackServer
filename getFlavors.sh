#!/bin/bash
OS_TOKEN="$(./parseToken.sh)"
curl -s http://192.168.1.253:8774/v2.1/flavors \
	-H "X-Auth-Token: $OS_TOKEN"
