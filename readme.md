
Sports Pro Technical Support System

Name: Samar Chauhan
⸻
<img width="1440" height="769" alt="Screenshot 2025-07-25 at 9 36 08 PM" src="https://github.com/user-attachments/assets/253ddad5-661b-42b9-9905-36544c6d4ceb" />

<img width="1440" height="778" alt="Screenshot 2025-07-25 at 9 36 55 PM" src="https://github.com/user-attachments/assets/df5b2acf-2e0f-488f-ae21-15c41ac4f422" />

<img width="1440" height="780" alt="Screenshot 2025-07-25 at 9 37 12 PM" src="https://github.com/user-attachments/assets/d190154f-40b4-4fb0-9166-d7f0a6478227" />

<img width="1439" height="778" alt="Screenshot 2025-07-25 at 9 37 25 PM" src="https://github.com/user-attachments/assets/b821a407-733c-44b6-8af4-c663c45c3fae" />

<img width="1440" height="780" alt="Screenshot 2025-07-25 at 9 37 38 PM" src="https://github.com/user-attachments/assets/d75adc1f-7940-4dd8-b750-26734775ce37" />

<img width="1440" height="774" alt="Screenshot 2025-07-25 at 9 37 52 PM" src="https://github.com/user-attachments/assets/7cb65b0a-4267-4985-93e3-f54cf1823e2c" />

<img width="1440" height="778" alt="Screenshot 2025-07-25 at 9 38 03 PM" src="https://github.com/user-attachments/assets/fdf55f6f-ccda-4331-9221-6ae9e5eee23e" />

<img width="1440" height="776" alt="Screenshot 2025-07-25 at 9 38 19 PM" src="https://github.com/user-attachments/assets/e06bb3e3-32aa-4b28-9158-c8546d0a335a" />

<img width="1440" height="766" alt="Screenshot 2025-07-25 at 9 38 39 PM" src="https://github.com/user-attachments/assets/250b231d-cae3-4904-8d5e-49da6854917a" />



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
