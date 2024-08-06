### **Introduction**
This is a dummy project based on the analysis of the laundry system in Indonesia. This project was built using Laravel 8 and MySQL. This project also provides dummy data using Laravel features called "Factory" and "Faker", so if necessary, follow the steps to install/run the project locally. 

### **Schema Database**
![image](https://github.com/user-attachments/assets/cdc25450-1e33-490d-a322-04e470f8fd26)


### **Features**
`GET` - Requests to retrieve the information from the module
`POST` - Create a data based on request
`PATCH` - Update a data
`DELETE` - Delete the data 

### **How to Install/Run the Project in Local**

1. Clone the Project
```bash
git clone https://github.com/Hosea-Portfolio/RestAPI-Laundry-Store-Laravel
cd Hosea-Portfolio/RestAPI-Laundry-Store-Laravel
```
2. Composer Update/Composer Install
3. Copy .env.example and change the name of file to .env
4. Generate key
```bash
php artisan key:generate
```
5. Change the DB information based on your device setting
6. Add additional code faker (If necessary)
```bash
FAKER_LOCALE=id_ID
```
7. Do seed the database
```bash
php artisan db:seed
php artisan migrate --seed OR php artisan migrate:fresh --seed
```
8. The project is ready in your local
```bash
php artisan serve
```

### **List Endpoint API**
<h3>Endpoint Customer</h3>
<ul>
    <li>Fetch Customer Data : http://127.0.0.1:8000/api/customer</li>
    <li>Show Customer Data Based on ID : http://127.0.0.1:8000/api/customer/:id</li>
    <li>Create a Customer Data : http://127.0.0.1:8000/api/customer</li>
    <li>Update a Customer Data : http://127.0.0.1:8000/api/customer/:id</li>
    <li>Delete a Customer Data: http://127.0.0.1:8000/api/customer/:id </li> 
</ul>

<h3>Endpoint Payment Status</h3>
<ul>
    <li>Fetch Payment Status Data : http://127.0.0.1:8000/api/payment-status</li>
    <li>Show Payment Status Data Based on ID : http://127.0.0.1:8000/api/payment-status/:id</li>
    <li>Create a Payment Status Data : http://127.0.0.1:8000/api/payment-status</li>
    <li>Update a Payment Status Data : http://127.0.0.1:8000/api/payment-status/:id</li>
    <li>Delete a Payment Status Data: http://127.0.0.1:8000/api/payment-status/:id </li> 
</ul>


<h3>Endpoint Payment Type</h3>
<ul>
    <li>Fetch Payment Type Data : http://127.0.0.1:8000/api/payment-type</li>
    <li>Show Payment Type Data Based on ID : http://127.0.0.1:8000/api/payment-type/:id</li>
    <li>Create a Payment Type Data : http://127.0.0.1:8000/api/payment-type</li>
    <li>Update a Payment Type Data : http://127.0.0.1:8000/api/payment-type/:id</li>
    <li>Delete a Payment Type Data: http://127.0.0.1:8000/api/payment-type/:id </li> 
</ul>

<h3>Endpoint Laundry Type</h3>
<ul>
    <li>Fetch Laundry Type Data : http://127.0.0.1:8000/api/laundry-type</li>
    <li>Show Laundry Type Data Based on ID : http://127.0.0.1:8000/api/laundry-type/:id</li>
    <li>Create a Laundry Type Data : http://127.0.0.1:8000/api/laundry-type</li>
    <li>Update a Laundry Type Data : http://127.0.0.1:8000/api/laundry-type/:id</li>
    <li>Delete a Laundry Type Data: http://127.0.0.1:8000/api/laundry-type/:id </li> 
</ul>

h3>Endpoint Transaction</h3>
<ul>
    <li>Fetch Transaction Data : http://127.0.0.1:8000/api/transaction</li>
    <li>Show Transaction Data Based on ID : http://127.0.0.1:8000/api/transaction/:id</li>
    <li>Create a Transaction Data : http://127.0.0.1:8000/api/transaction</li>
    <li>Update a Transaction Data : http://127.0.0.1:8000/api/transaction/:id</li>
    <li>Delete a Transaction Data: http://127.0.0.1:8000/api/transaction/:id </li> 
</ul>






