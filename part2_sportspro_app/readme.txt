COMP 3541 – Assignment 2 (Part 2)  
Name: Samar Chauhan

This part of the assignment is a PHP and MySQL web application that works with the `tech_support` database. It simulates a support system for a company called SportsPro. I used XAMPP and phpMyAdmin to run and test the app locally.

All tasks from the assignment have been completed and tested. Below is a breakdown of what each task does and which files are included.

------------------------------------------------------------
Task 1 – Manage Products
Files: product_manager.php, product_add.php

- Lets an admin view, add, and delete products
- New products require product code, name, version, and release date
- Release date can be any valid format

------------------------------------------------------------
Task 2 – Manage Technicians
Files: technician_manager.php, technician_add.php

- Displays a list of technicians
- Admin can add a new technician or delete existing ones
- All fields are required and validated

------------------------------------------------------------
Task 3 – Manage Customers
Files: customer_search.php, customer_edit.php, customer_add.php

- Admin can search for customers by last name
- Can view/update existing customer info or add a new one
- Country dropdown is populated from the database
- All input fields are validated before saving

------------------------------------------------------------
Task 4 – Register Product (Customer)
Files: register_login.php, register_product.php

- Customer logs in using their email
- A dropdown lists all available products
- Customers can register a product, and duplicates are not allowed

------------------------------------------------------------
Task 5 – Create Incident (Support Staff)
Files: incident_get_customer.php, incident_create.php

- Support staff searches for a customer by email
- Shows only products that customer has registered
- Staff can submit a title and description to create a new incident
- Successful submissions are added to the `incidents` table

------------------------------------------------------------
Other Files:
- db.php → Handles the database connection
- main.css → Contains all basic styles
- index.php → Main homepage with navigation links to each task

------------------------------------------------------------
How to Run the Application:
1. Start Apache and MySQL in XAMPP
2. Go to:  
   http://localhost/COMP3541_A2_Samar_Chauhan/part2_sportspro_app/index.php
3. Use the menu to test each section

------------------------------------------------------------
Notes:
- All features are tested and working
- SQL file `tech_support.sql` was successfully imported using phpMyAdmin
- Sessions are used for customer and staff workflows (product registration & incidents)

****This is an academic project. All data is sample/fake, and credentials are local-only.****