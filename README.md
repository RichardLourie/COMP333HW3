# COMP333HW3

Directory: 
/backendbasics
This folder contains the files and folders to be placed in the htdocs folder of XAMPP. It contains the backend code that controls all of our data logic. To clarify: the contents of this folder should be placed in htdocs folder. 

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

React Start Instructions:
1. clone the repository onto your computer
2. in terminal, cd into base directory->...->comp333hw3->hw3
3. run 'npm start' and the application should open in your browser
4. error messages are printed in the console

Directory Structure:
comp333hw3(main):
<img width="919" alt="Screen Shot 2023-11-08 at 1 32 55 PM" src="https://github.com/RichardLourie/COMP333HW3/assets/144484549/fcc9d06f-19d9-4712-b13f-5a7109e9ff17">

hw3(react app):
<img width="917" alt="Screen Shot 2023-11-08 at 1 42 43 PM" src="https://github.com/RichardLourie/COMP333HW3/assets/144484549/297e3fac-ae72-4120-a6d1-ce3fa5136872">

src(react app files):
<img width="917" alt="Screen Shot 2023-11-08 at 1 33 14 PM" src="https://github.com/RichardLourie/COMP333HW3/assets/144484549/d551a241-ab64-4ece-bea4-5b675f5b8878">

htdocs(xampp):
<img width="916" alt="Screen Shot 2023-11-08 at 1 43 41 PM" src="https://github.com/RichardLourie/COMP333HW3/assets/144484549/fc0c40ad-51a1-4935-878e-79569cfad90c">
