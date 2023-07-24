[![N|Solid](https://s3.eu-west-2.amazonaws.com/parent-documents/assets/parent_logo.png)](http://parent.eu)

## Challenge Idea

## For Backend Application (Senior Backend Application) 
for Full stack Application will write Backend Application Beside the Part of Angular Application
---------------------------
We have two providers collect data from them in json files we need to read and make some filter operations on them to get the result


- `DataProviderX` data is stored in [DataProviderX.json]
- `DataProviderY` data is stored in [DataProviderY.json]


`DataProviderX  schema is 
```
{
  parentAmount:200,
  Currency:'USD',
  parentEmail:'parent1@parent.eu',
  statusCode:1,
  registerationDate: '2018-11-30',
  parentIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613'
}
```

we have three status for `DataProviderX` 

- `authorised` which will have statusCode `1`
- `decline` which will have statusCode `2`
- `refunded` which will have statusCode `3`


`DataProviderY  schema is 
```
{
  balance:300,
  currency:'AED',
  email:'parent2@parent.eu',
  status:100,
  created_at: '22/12/2018',
  id: '4fc2-a8d1'
}
```

we have three status for `DataProviderY` 

- `authorised` which will have statusCode `100`
- `decline` which will have statusCode `200`
- `refunded` which will have statusCode `300`


## Acceptance Criteria

Using PHP Laravel, implement this API endpoint `/api/v1/users`

- it should list all users which combine transactaions from all the available provider`DataProviderX` and `DataProviderY` )
- it should be able to filter resullt by payment providers for example `/api/v1/users?provider=DataProviderX` it should return users from DataProviderX
- it should be able to filter result three statusCode (`authorised`, `decline`, `refunded`) for example /api/v1/users?statusCode=authorised it should return all users from all providers that have status code authorised
- it should be able to filer by amount range for example `/api/v1/users?balanceMin=10&balanceMax=100` it should return result between 10 and 100 including 10 and 100
- it should be able to filer by `currency` 
- it should be able to combine all this filter together 

## The Evaluation

Task will be evaluated based on

1. Code quality
2. Application performance in reading large files 
3. Code scalability : ability to add  `DataProviderZ` by small changes
4. Unit tests coverage
5. Docker


---------------------------


## Frontend Assessment Full stack Developer Application
---------------------------

Using Angular, consume this API endpoints you have created above

Create an Application that uploads the various above types scheme

- it should list all users which combine transactaions from all the available provider`DataProviderX` and `DataProviderY` )
- it should be able to filter resullt by payment providers for example `/api/v1/users?provider=DataProviderX` it should return users from DataProviderX
- it should be able to filter result three statusCode (`authorised`, `decline`, `refunded`) for example /api/v1/users?statusCode=authorised it should return all users from all providers that have status code authorised
- it should be able to filer by amount range for example `/api/v1/users?balanceMin=10&balanceMax=100` it should return result between 10 and 100 including 10 and 100
- it should be able to filer by `currency` 
- it should be able to combine all this filter together 


## The Evaluation of Angular Application

Task will be evaluated based on

1. Code quality
2. Application performance in reading large files 
3. Code scalability : ability to add  `DataProviderZ` by small changes 


## Solution   Description:
This project implements a full-stack application using Laravel for the backend and Angular for the frontend. The backend application provides API endpoints to upload and process data from DataProviderX.json and DataProviderY.json files. Users can also retrieve and filter user data from both providers.

The backend application includes the following features:

API endpoint /api/v1/import-data to upload and process the JSON data from DataProviderX.json and DataProviderY.json.
API endpoint /api/v1/users to retrieve and filter user data from both providers based on payment providers, status codes, amount range, and currency.
The frontend application is built with Angular and consumes the API endpoints provided by the backend to display the user data in a data table with various filter options.

## Steps to Run the Application:
Before running the application, make sure you have Docker and Angular CLI installed on your system.

## 1. Run Docker:
To set up the backend application and database using Docker, follow these steps:
# Navigate to the root directory of the project

```bash
cd backend
```
# Build and run the Docker containers
```bash
docker-compose up -d
```

This will set up the backend application and MySQL database using Docker containers.

## 2. Run Migrations and Seed:
Next, run the database migrations and seed the database with initial data using the following commands
```bash
# Access the Laravel Docker container
docker exec -it laravel bash
```
```bash
# Inside the container, run the migrations and seed
php artisan migrate --seed
exit
```
This will create the necessary tables and seed the database with sample data from the seeders.

## 3. Run Angular Server:
To run the frontend Angular application, follow these steps:
```bash
# Navigate to the root directory of the project
cd frontend

# Install Angular dependencies
npm install

# Start the Angular development server
ng serve
```
The Angular development server will start, and you can access the application at http://localhost:4200/.

Usage:
Upload Data: To upload the DataProviderX.json and DataProviderY.json files, go to the welcome page and click on the "Upload Data" link. Select the files and the provider from the dropdown, then click the "Submit" button to import the data.

View Users: To view and filter the users, go to the user list page by clicking on the "Users" link. You can apply filters based on the payment provider, status code, amount range, and currency to view specific user data.

Now, you have a fully functional backend and frontend application running. Enjoy exploring the user data and filtering options!