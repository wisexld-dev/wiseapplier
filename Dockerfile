# Use the official MySQL image as the base image
FROM mysql:latest

# Set environment variables for MySQL
ENV MYSQL_DATABASE=${DB_DATABASE} \ MYSQL_ROOT_PASSWORD=${DB_PASSWORD}

#Expose the default MySQL port
EXPOSE 3306