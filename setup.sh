# Script to setup the server for the first time

# Clone the website project & navigate to the dir
git clone https://github.com/Walshf0411/GroceryAdmin.git && cd GroceryAdmin

# Pull in the dependencies
# Incase you get an error like
# - intervention/image <version> requires ext-fileinfo * -> the requested PHP
# extension fileinfo is missing from your system.
# enable the extension fileinfo in php.ini by setting extension=fileinfo
# For shared hosting https://stackoverflow.com/questions/34368178/how-to-enable-extension-fileinfo-so-in-my-shared-hosting
composer update

# Create a file .env and add the environment details

# Run the application & hit the url deploy
php artisan serve &

# HIt the setup url to copy all the files to public_html folder and create symlinks
curl -XPOST localhost:8000/deploy/asdfghjkl

echo "Php artisan service was started in background as part of this script, please manually kill the process!"
