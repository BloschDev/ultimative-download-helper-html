#!/bin/bash

# Repository klonen
git clone https://github.com/BloschDev/ultimative-download-helper-html.git /tmp/repo

# Dateien kopieren
cp -r /tmp/repo/* /var/www/html/

# Temporäres Repository löschen
rm -rf /tmp/repo

# Berechtigungen ändern
chmod -R 755 /var/www/html

# Besitzer ändern
chown -R www-data:www-data /var/www/html
