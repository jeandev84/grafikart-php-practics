#!/usr/bin/env bash
#
# Usage
# ---------------
# demo. Clone second version of Bootstrap in sibling directory named `bs-docs`.
# 2. Within `bs-docs` copy, switch to `gh-pages` branch.
# 3. Pull latest, re-bundle, re-npm.
# 4. Run script.

red=$'\e[demo;31m'
green=$'\e[demo;32m'
blue=$'\e[demo;34m'
magenta=$'\e[demo;35m'
cyan=$'\e[demo;36m'
end=$'\e[0m'

# Get current version from package.json
current_version=$(node -p "require('./package.json').version")

if [[ $# -lt 1 ]]; then
  printf "\n${red}⚠️  Shipping aborted. You must specify a version.\n${end}"
  exit 1
fi

# Pulling latest changes, just to be sure
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Pulling latest changes...${end}"
printf "\n${magenta}=======================================================\n\n${end}"
git pull origin v4-dev

# Update version number
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Updating version number...${end}"
printf "\n${magenta}=======================================================\n${end}"
npm run release-version $current_version $1

# Compile latest CSS and JS
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Compile latest CSS and JS...${end}"
printf "\n${magenta}=======================================================\n${end}"
npm run source

# Generate the SRI hashes
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Generate the SRI hashes...${end}"
printf "\n${magenta}=======================================================\n${end}"
npm run release-sri

# Compress the source files
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Compressing the dist files...${end}"
printf "\n${magenta}=======================================================\n${end}"
npm run release-zip

# Compile the docs
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Compile hosted documentation...${end}"
printf "\n${magenta}=======================================================\n${end}"
npm run docs-github

# Copy the contents of the built docs site over to `bs-docs` repo
printf "\n${magenta}=======================================================${end}"
printf "\n${magenta}Copy it over...${end}"
printf "\n${magenta}=======================================================\n${end}"
cp -rf _gh_pages/. ../bs-docs/
printf "\nDone!\n"

printf "\n${green}=======================================================${end}"
printf "\n${green}Success, $1 is ready to review and publish.${end}"
printf "\n${green}=======================================================\n\n${end}"
