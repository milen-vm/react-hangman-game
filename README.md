Task 2 - Hangman game
=====================
**Final product:**

A classical hangman game (player vs computer). A random word should be selected from a MySQL table (the words can be manually inserted in the table in advance), the letters count is presented to the user. It should be possible for the user to select only 1 letter at a time. If the player selects a letter that exists in the word, user interface should be updated accordingly so the selected letter is presented. If the player selects an incorrect letter, than a new element should be added to the hangman picture (or whathever interface you decide to use). A list of selected letters should be presented.
The game ends when the user guesses the word or run out of letter choices.

Implement a backend API.
Implement an appropriate front-end that communicates with the backend API via ajax http requests. 

Please implement front-end and back-end validation where needed.

For further guidance, please check the wire-frames attached under docs/hangman dir.  

Technology stack should be:

* Backend - PHP or Node.js (you can use a framework of your choise)
* DB - MySQL
* Front-end - You decide

Views / Sections

* Game view - contains game front-end representation where the player/user inputs the letters one by one
* Games history list - a table (with clickable rows loading the "Game history details") with the following columns: Word to guess, Selected letters, Win (yes / no possible values), datetime (format: YYYY-MM-DD HH:MM:SS).
* Game history details page - the user can select and review a game he has played via the "Game history list" section. 
