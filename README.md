
![logo](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/logo.png)

Web Appointment System For Doctors, allowing patients to take online appointments.

# Installation

Follow the instruction below to install DocAppoint.

1. Clone the git repository `git@github.com:iamharshthakkar/DocAppoint.git` or download this project as zip.
2. Set the correct directory permissions `chmod -R 755 ./` Depending on your server configuration, it might be necessary to set whole write permissions (777) to the files and folders above. You can also start testing with lower permissions due to security reasons (644 for example) as long as your php process can write to those files.
3. Import SQL source file to your database which is present in `SQL IMPORT` folder inside the project.
4. You do not need to `composer install` because required dependencies are already installed.

# Server configuration
To install DocAppoint, you need a web server running PHP 5.2+ and any flavor of MySQL 5.0+ (MySQL, MariaDB, Percona Server, etc) You will also need a database administration tool, such as phpMyAdmin, in order to manage a database for DocAppoint. I recommend the Apache or Nginx web servers. (You can signup at [Tech Tethers](https://techtethers.com/) for web hosting.)

# Features
DocAppoint features are bifurcated into various modules:
- User Management
- Appointment Booking
- Payments
- Time Slots Generation
- Search Management

## Patient's Account
#### Register & Login
To register for patient's account, click on Login/Signup button on the top of the page, and then click Register Now. After successful registration patient will be automatically redirected to home page so the user can perform other actions.

#### Search For Doctor
For searching a doctor, patient can navigate to home page, and then patient can search for specific doctors according to inputs.

#### Appointment Booking
After searching for doctors, patients can select a doctor and available date/time for booking an appointment.  

#### View Doctor Profile
Patients can also view doctor's profile of a particular doctor, with all details. This action can be done before or after booking an appointment with a doctor.

#### View All Appointments For A Patient
To view all confirmed, cancelled or closed appointments, patient can navigate to My Appointments page.

#### Change Profile
Patients can also view and update profile.

#### Change Password
Inorder to change the password patient can navigate to Change Password Page.

## Doctor's Account
#### Register & Login
To register for doctors's account, click on Login/Signup button on the top of the page, and then click Register Now. And then click on Are you a Doctor link to go to Doctor's registration page. After successful registration admin needs to verify and active the doctor's account, but for now doctor's account are already activated because development of admin account is still in progress.

Note: After signing-in as a doctor, doctors are restricted to view public pages except Doctor's Public Profile page.

#### View All Appointments From A All Patients (For Particular Doctor)
To check or update appointments from patients, doctors can navigate to My Appointments page.

#### View All Patients
Here doctors can view all his/her patients who has taken appointment from that particular doctor.

#### Schedule Timings Appointment
DocAppoint also gives feature to generate time slots automatically for doctors according to their available business hours.

#### Change Profile
Doctors can also view and update profile. Also via this page, doctors can view or update his public profile page, which is visible to patient or visited users.

#### View Profile Page
This is a page where patients can get detailed information about the doctor.

#### Change Password
Inorder to change the password, doctor can navigate to Change Password Page.

# Screenshot
![screenshot1](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/features/macbookpro13_front.png)
![screenshot2](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/features/macbookpro13_front%20(1).png)
![screenshot3](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/features/macbookpro13_front%20(2).png)
![screenshot4](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/features/macbookpro13_front%20(3).png)
![screenshot5](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/features/macbookpro13_front%20(4).png)
![screenshot6](https://raw.githubusercontent.com/iamharshthakkar/DocAppoint/master/assets/img/features/macbookpro13_front%20(5).png)
# Support
#### If you need help using DocAppoint, contact the: harsh.thakkar1235@gmail.com.

# Author
Designed & Developed with ❤️ By [Harsh Thakkar](mailto:harsh.thakkar1235@gmail.com)

## Thank you for exploring...
