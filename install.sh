#!/usr/bin/env bash
cp .env.example .env
cp docker-compose.override.example.yml docker-compose.override.yml

chmod 0777 storage/ -R
docker-compose build
docker-compose up -d

