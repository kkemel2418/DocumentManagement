# DocumentManagement

# Document Management Service

The Document Management Service is an application that allows the creation and management of contracts and invoices, in addition to offering functionalities for viewing and generating documents in PDF format.

## Functionalities

- Creation and management of contracts.
- Creation and management of invoices.
- Visualization and generation of documents in PDF.

## Technologies Used

- PHP 8.1.0
- Laravel 8
- Docker
- MySQL
- Dompdf (for generating PDFs)

## Installation

1. Clone this repository to your local machine.
2. Make sure you have Docker installed on your machine.
3. Navigate to the project's root directory in the terminal.
4. Run the following command to build and run the Docker container:

docker-compose up -d

5. Install Composer dependencies by running the following command inside the container:

docker-compose exec app composer install

6. Create the database tables and perform the migrations:

docker-compose exec app php artisan migrate

7. Access the application in your browser using:

http://localhost:8000


## How to use

- To create a contract or an invoice, fill in the required fields in the corresponding form.
- To view or download a PDF document, navigate to the corresponding page

POSTMAN
Link:
https://kaliamin.postman.co/workspace/New-Team-Workspace~f00cb03d-a8e8-4e62-ba53-88701bdf945b/collection/14051827-e5fdb38c-1306-493b-ac9e-bffee77996de?action=share&creator=14051827

In postman there is a json model for each action of each of the two types of documents

**  In folder : 'DocumentManagementService\resources\views'
There are two PDF templates one of each contract type

POSTMAN DOC
https://documenter.getpostman.com/view/14051827/2s9Y5SVkTM




