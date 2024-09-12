# Bookstore Backend API

## Overview

This project is the backend API for a bookstore application built with Laravel. It provides a RESTful API for managing book records and is distributed as a ZIP file.

## Setup Instructions

1. **Extract the ZIP File**  
   Unzip the provided file to your desired location.

2. **Install Dependencies**  
   Navigate to the project directory and install the necessary PHP dependencies using Composer.

3. **Configure the Environment**  
   Copy the `.env.example` file to `.env`. Update the `.env` file with your PostgreSQL database credentials, including host, port, database name, username, and password.

4. **Generate Application Key**  
   Generate a unique application key for your project using the Laravel command.

5. **Run Migrations**  
   Apply the database migrations to create the required tables in your PostgreSQL database.

## Database Details

The application uses PostgreSQL as its database. The main table, `books`, includes the following fields:
- `author`: The author of the book.
- `title`: The title of the book.
- `publish_date`: The date when the book was published.
- `isbn`: The unique ISBN of the book.
- `summary`: A brief summary of the book.
- `price`: The price of the book.
- `on_store`: The quantity of the book available in the store.

## Model Factories

The `BookFactory` is used to generate sample data for testing. It defines how book attributes are generated, such as author names, titles, publication dates, ISBNs, summaries, prices, and availability.

## API Endpoints

The API includes the following endpoints:

- **List Books**: Retrieve a list of all books in the database.
- **Create Book**: Add a new book by providing details such as author, title, publish date, ISBN, summary, price, and availability.
- **View Book**: Get detailed information about a specific book using its ID.
- **Update Book**: Modify the details of an existing book using its ID. This includes updating attributes and handling duplicate ISBNs.
- **Delete Book**: Remove a book from the database using its ID, with error handling for cases where the book is not found.

## Models

The `Book` model represents the structure of book records in the database. It includes attributes such as author, title, publish date, ISBN, summary, price, and availability.

## Testing

Feature tests are provided to verify the functionality of the API endpoints. Tests cover scenarios such as listing all books, creating new books (including handling duplicate ISBNs), viewing specific books, updating book details, and deleting books. These tests ensure that the API operates correctly and handles errors appropriately.


