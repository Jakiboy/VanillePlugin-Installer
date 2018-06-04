#!/bin/bash

printf "Plugin name : "
read NAME

printf "Plugin namespace : "
read NAMESPACE

printf "Plugin description : "
read DESCRIPTION

printf "Composer init ? (y/n) : "
read COMPOSER

clear

DEFAULTNAMESPACE="VanilleNameSpace"
DEFAULTNAME="\[VanilleName\]"
DEFAULDESCRIPTION="\[VanilleDescription\]"

echo "Remove git files..."
rm -rf .git

echo "Generating plugin ->"

# Build main file
echo 'Building main file...'

mv $DEFAULTNAMESPACE $NAMESPACE

cd $NAMESPACE

mv $DEFAULTNAMESPACE.php $NAMESPACE.php

cp $NAMESPACE.php $NAMESPACE.tmp
sed "s/$DEFAULTNAMESPACE/$NAMESPACE/g" $NAMESPACE.tmp > $NAMESPACE.php
rm $NAMESPACE.tmp

cp $NAMESPACE.php $NAMESPACE.tmp
sed "s/$DEFAULTNAME/$NAME/g" $NAMESPACE.tmp > $NAMESPACE.php
rm $NAMESPACE.tmp

cp $NAMESPACE.php $NAMESPACE.tmp
sed "s/$DEFAULDESCRIPTION/$DESCRIPTION/g" $NAMESPACE.tmp > $NAMESPACE.php
rm $NAMESPACE.tmp

cp uninstall.php uninstall.tmp
sed "s/$DEFAULTNAMESPACE/$NAMESPACE/g" uninstall.tmp > uninstall.php
rm uninstall.tmp

clear

# Build language files
cd languages

echo 'Building language files...'

find . -type f -print0 | xargs -0 -n 1 sed -i -e "s/$DEFAULTNAMESPACE/$NAMESPACE/g"
find . -type f -print0 | xargs -0 -n 1 sed -i -e "s/$DEFAULTNAME/$NAME/g"

mv $DEFAULTNAMESPACE.pot $NAMESPACE.pot
mv $DEFAULTNAMESPACE-fr_FR.po $NAMESPACE-fr_FR.po

echo 'Compile mo file...'
msgfmt -o $NAMESPACE-fr_FR.mo $NAMESPACE-fr_FR.po

clear

# Build core files
cd ..
cd core

echo 'Building core files...'

find . -type f -print0 | xargs -0 -n 1 sed -i -e "s/$DEFAULTNAMESPACE/$NAMESPACE/g"
find . -type f -print0 | xargs -0 -n 1 sed -i -e "s/$DEFAULTNAME/$NAME/g"

if [ "$COMPOSER" == "y" ]; then
	echo "Composer install..."
	composer install
fi

echo "Done!"