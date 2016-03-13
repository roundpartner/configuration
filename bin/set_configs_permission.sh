#!/usr/bin/env bash
if [ ! -e $1vendor/roundpartner/configuration/configs ]
then
	mkdir -p $1vendor/roundpartner/configuration/configs
fi
chmod a+w $1vendor/roundpartner/configuration/configs
