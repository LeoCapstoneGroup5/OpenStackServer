#!/bin/bash
OS_TOKEN="$(./parseToken.sh)"
curl -i \
  -H "Content-Type: application/json" \
  -d '
{ "auth": {
    "identity": {
      "methods": ["password"],
      "password": {
        "user": {
          "name": "admin",
          "domain": { "id": "default" },
          "password": "9b33887587994c06"
        }
      }
    },
    "scope": {
      "project": {
        "name": "admin",
        "domain": {"id": "default" }
       }
     }
  }
}' \
  "http://192.168.1.253:5000/v3/auth/tokens" > projecttoken
