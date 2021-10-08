## Laravel with Vue js Example (Login, Registration, Dashboard, User Info, User Info Edit and Logout)

Here I'm going to show, how to use vue js with laravel and make a Login, Registration, Dashboard, User Info, User Info Edit and Logout page

## Install

I have uploaded the example project here. But the github do not allow to upload the Vendor and Node Module files to there server. So, we need run some command to run this project locally



### Step

- Download the project from here as zip file
- Open a directory "laravel-vue" in your XAMPP htdocs root directory or in your server root directory
- Unzip the file to the directory "laravel-vue"
- Run the CMD with the pach of your directory "laravel-vue"
- Run the command "composer install"
- Run the command "npm install"
- Go to the .env file and set your database
- Now start your XAMPP or Server Control panel and start apache and MySql server
- Run "php artisan migrate:refresh --seed"
- Now open your web browser and go to "http://localhost/laravel-vue/public"
- Done!!

## Change Config

If you run this project in a sub directory or others then you need to change the
API Server url. You can also change the APP_KEY and APP_SECRET.
The configuration file path "resources/js/config.js" 

After changing the config.js file you need to run the command "npm run dev"

### API_SERVER, APP_KEY and APP_SECRET

- Go to the file "resources/js/config.js"
- Set API_SERVER Url information
- Save the file
- Run "npm run dev"
- Done!!
