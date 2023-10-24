> This project is probably deprecated. Do not use if you don't know what you did.
> AT YOUR OWN RISK !

# quai-antique
Quai Antique is a Savoyard restaurant website built with the Symfony web framework and Tailwind CSS. The website was developed and hosted on Laragon. This website is my final exam for my school. If you have any opinion/advice or other to give me, contact me by email: loisdupasquier21@gmail.com 

# Technologies Used:
- Symfony 6.2.* (A PHP framework for building web applications.)
- TailwindCSS 3.2.4 (A utility-first CSS framework for building responsive and customizable user interfaces.)
- Laragon: A local web development environment for Windows.

# Builded with:
- Encore Webpack
 
# Setting up the project on local
1. Download .zip repository.

- Install laragon, composer, and NodeJS.
- https://laragon.org/download/index.html
- https://getcomposer.org/download/
- https://nodejs.org/en/download/ and download Longterm support version (LTS)


 Verify composer installation with `composer -v`.
 Verify NodeJS installation with `node -v`. 

 PHP is installed by default by Laragon.
 If you are not in PHP 8.1, follow this guide: https://medium.com/@oluwaseye/add-different-php-versions-to-your-laragon-installation-d2526db5c5f1

2. When laragon is successfully installed, open your folder explorer. Go at this path:
 `C:/laragon/www/`

 Drag and drop the .zip file, unzip it inside the folder. After unzip, you can remove .zip.


3. Run composer install for obtain all the necessary dependencies for Symfony.

![image](https://user-images.githubusercontent.com/58104051/220336025-ba9f2fe8-c734-475d-9095-da80cd56e35d.png)


4. Run npm install for obtain all the necessary dependencies for tailwind.

![image](https://user-images.githubusercontent.com/58104051/220336133-69e0bcca-a09c-4f6b-acef-adc07417a54c.png)


5. Run your laragon.

![image](https://user-images.githubusercontent.com/58104051/220337253-aa238652-f2b2-45cb-88d7-a8d68ffcde2c.png)


6. In my part, I configured laragon to simply have to write in url: http://quai-antique.local.
(Right click, preferences)
![image](https://user-images.githubusercontent.com/58104051/213677753-079cb3fb-48b5-405b-ab74-7290ad595240.png)

7. Now you can type this in your browser: http://quai-antique.local/

8. Done !

# How create database?
If the quai_antique is successfully installed on your computer, you can now take care of the database.

1. In the project, at the root, you must have an .env file. Config it.

![image](https://user-images.githubusercontent.com/58104051/220340407-dafa49db-8061-410f-aacd-20c843543ba0.png)

2. Restart laragon (click on "Recharger" or "Refresh").

3. Now you need to create your database, in Laragon. Follow this:

![image](https://user-images.githubusercontent.com/58104051/220366562-677343b1-01a6-4a83-9e81-f89dd768a0f5.png)


 and follow this
(Copy this SQL request) `CREATE DATABASE IF NOT EXISTS yourDatabase;`

![image](https://user-images.githubusercontent.com/58104051/220342720-1a742b82-fb0f-436b-ab57-f7c5c541ba68.png)

4. Your database is now created. Normally, in migration, you have the latest version of my database.
Just simply run:
`php bin/console doctrine:migrations:migrate`

6. Your database and tables are now created and ready to use !

If you have any problem with the installation, contact me at this email: loisdupasquier21@gmail.com

# How create admin user? 

1. First, create a securised password. I recommend this website for that: https://www.dashlane.com/fr/personal-password-manager/password-generator

2. Copy your password, paste it on a .txt file for example go in VSCODE and type this:

![image](https://user-images.githubusercontent.com/58104051/220362457-04ac5f08-f236-4274-8143-2e8cdedfbc16.png)

If you make a right click, nothing happens, don't panic. Your password is simply hidden.
Press enter, and you get your hashed password.

3. Now, return in HeidiSQL, and type this:
(replace the fields with the necessary information, for example 'mon-mail@exemple.com' -> loisdupasquier21@gmail.com)

`INSERT INTO customer (email, password, guest_number, allergies, roles) VALUES ('mon-mail@exemple.com', 'hashed_password', 'number_of_guest (max 8)', 'mes_allergies', '["ROLE_ADMIN"]');`

4. Your admin account is now created. Log in, then enter this URL to get started:
`http://quai_antique.local/admin`

# Licensing
This project is licensed under the MIT License.

# Terms of use
1. Any Digital Campus Live school learner must notify me in case of reuse of the code provided in this repo. 
I will not be held responsible for any undesirable use of my code (cheating, hacking, etc.)

2. Do not use this code for malicious purposes.

3. Give me a advice, let's not waste our time.


