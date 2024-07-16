#!/bin/bash

# Repository klonen
git clone https://github.com/BloschDev/ultimative-download-helper-html.git /tmp/repo

# Dateien kopieren
cp -r /tmp/repo/* /var/www/html/
mv /var/www/html/deploy.sh /var/www/
# Temporäres Repository löschen
rm -rf /tmp/repo

# Berechtigungen ändern
chmod -R 755 /var/www/html
chmod 755 /var/www/deploy.sh

# Besitzer ändern
chown -R www-data:www-data /var/www/html
