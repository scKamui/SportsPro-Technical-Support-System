
Sports Pro Technical Support System

Name: Samar Chauhan
⸻

Overview of the Application

The app starts on a main landing page (home.php) where users can choose to log in as an admin, technician, or customer. Each role is given access to different functionality:

Administrator - (username: admin and password: sesame )

Admins are redirected to a dashboard (index.php) after login. From there, they can:
	•	Manage products (view, add, delete)
	•	Manage technicians (view, add, delete)
	•	Search for and edit customer information
	•	Register products for customers
	•	Create incidents on behalf of customers
	•	Assign incidents to technicians
	•	View all incidents in the system (assigned and unassigned)

All admin functionality is protected by session-based access control.

⸻

Technician

Technicians log in with their email and a password (set to sesame).
Once logged in, they are taken to the “Select Incident” page which:
	•	Lists all open incidents assigned to them
	•	Lets them pick an incident to update
	•	If no incidents are assigned, shows a message and a link to view newly assigned incidents (if available)
	•	Displays a message showing the logged-in technician’s name and a Logout button

⸻

Customer

Customers log in with their email and a password (sesame).
After login, they are taken to the product registration screen, which:
	•	Lets them register products under their account
	•	Prevents duplicate registrations
	•	Shows a confirmation or error message based on the result
	•	Displays the logged-in customer’s name and provides a Logout button

⸻

Features and Design Notes
	The application uses PHP sessions to manage authentication and protect all key pages
	Navigation is consistent across roles, with a logo header, Home button, and Logout button
	UI is styled using a single CSS file (main.css)
	All database interactions use prepared statements to prevent SQL injection
	Forms are validated for required input
	When no records are found (e.g., in a customer search or incident list), the app shows a helpful message instead of showing nothing

⸻

How to Run the App
	1.	Start Apache and MySQL in XAMPP
	2.	Import the tech_support.sql database using phpMyAdmin
	3.	Open this URL in your browser:
http://localhost/COMP3541_A3_Samar_Chauhan/index.php




	The application was developed and tested using XAMPP
	Only sample data is used – no real customer or technician data

****This is an academic project. All data is sample/fake, and credentials are local-only.**** 
