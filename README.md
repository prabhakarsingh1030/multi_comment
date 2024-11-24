# Multi-Level Commenting System with Recursive Depth Check

It is a nested commenting based project having multiple nested comments upto depth level 3 . i.e maximum upto 3 comments.
Primarirly Focused on the Working Of the commnets and replies functionality.Restricting users to add comments above depth level 3.
Hiding All the buttons when depth level reaches 3.



###  Prerequisites
PHP ^8.x
Laravel ^9.x
A database (MySQL)
Node.js and npm

 

------------- Points ---------------

### Steps Clone the repository:

git clone <https://github.com/prabhakarsingh1030/multi_comment.git>
 cd < your own directory > 

 Install dependencies:

composer install Configure environment variables:

Rename .env.example to .env. Update database and other configuration details in .env. Generate the application key:

php artisan key:generate Run migrations.

php artisan migrate Serve the application:

php artisan serve

### After Installation How to Check Its Working

1. First You Need to Add Post By going to
http://127.0.0.1:8000/

2. After Submitting Post You can Check All Post by clicking navbar "All Post".

3. After Clicking Specific Post You wil be Able to Add Comments to that blog.

4. Now Add Yor First Comment using The textArea and Submit.

5. After Submitting Yor Commentt ,IF you wish to reply to that comment , you can reply by just clicking Reply Link below the Comment box. After clicking link  a new form will appear on the bottom of page , Insert your message and press the submit button.
6. After reply if you want to reply to that previous reply , click  on right side of comment and submit form.

7. To delete Empty comments, just run the command 

 php artisan comments:delete-empty 

8. To schedule it manually run command

 php artisan schedule:run 



### Things That i have used 
1. I have Used laravel  blade template to display all the comments and replies.
2. Used controller to restrict depth level. 
3.  Used if's conditon to disable button on depth wise 
4. I have used Color Combination to display comments and theirs replies to differentaite.
5. Used CLI Command to delete empty comments.


Github Repository link
https://github.com/prabhakarsingh1030/multi_comment.git