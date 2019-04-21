#!/bin/bash
OS_TOKEN="$(./parseToken.sh)"
curl -s http://192.168.1.253:9292/v2/images \
	-H "X-Auth-Token: $OS_TOKEN"
