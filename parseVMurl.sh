#!/bin/bash
sed -n 's/"url": //p' /var/tmp/vmURL | tr -d '", ' | sed 's/.*://'
