# FE21-CR11-MichaelR

For this CodeReview, the following criteria were graded:
 
- Create a database (cr11_petadoption_yourname) and add sufficient test data (at least 4 small animals, 4 large animals and 4 seniors) 
- Display all animals on a single web page (home.php).      
- Display all senior animals on a single web page (senior.php).
- Create a registration and login system.
- Create separate sessions for normal users and administrators. 
- Create an admin panel. Only the admin is able to create, update and delete data about animals within the admin panel. The normal user will be able to see everything that was created for this website, without having administrative privileges in changing the data. 

**Bonus points**

Pet Adoption

- In order to accomplish this task, a new table PetAdoption will need to be created. This table should hold the userId and the petId plus other information that you may think is relevant.
- Each Pet should have a button "Take me home" that if the user clicks on it, it should pick the pet. When it does, a new record should be created in the table PetAdoption.
