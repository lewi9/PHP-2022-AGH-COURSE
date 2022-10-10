#!/bin/bash

cd ../php_2022_g2
cp "$1/" "../php_2022_g2_adam_lewinski/$1/" -r

cd ../php_2022_g2
cp "bitbucket-pipelines.yml" "../php_2022_g2_adam_lewinski/bitbucket-pipelines.yml"

cd ../php_2022_g2
cp "index.ipynb" "../php_2022_g2_adam_lewinski/index.ipynb"
