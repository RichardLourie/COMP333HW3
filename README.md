# COMP333HW3

Directory: 
/backendbasics
This folder contains the files and folders to be placed in the htdocs folder of XAMPP. It contains the backend code that controls all of our data logic. 

/backendbasics/index.php
This file directs the API calls to the relevant controllers

/backendbasics/model 
This folder contains the Database.php file, SongModel.php file, UserModel.php file.

The model files extend the database and contain functions relevant to the ratings and users tables (respectively). Database contains general purpose stuff that is relevant to all models. 

/backendbasics/Controller/Api
This folder contains BaseController.php, SongController.php, UserController.php. SongController and UserController extend BaseController and take API requests for users and ratings (respectively) and direct them to the relevant model functions. BaseController contains setup relevant to all controllers. 

/backendbasics/inc 
This contains connection misc setup stuff that is used in other files. 

Some of the basic structure was inspired by the REST API tutorial that was suggested by prof. Some of the code was written with help from ChatGPT. 

