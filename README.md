WiseApplier - Auto Job Applier Tool
-----------

This project is an idea I came up with after receiving (insert large number here) negative responses to job applications.
It consists of a script that would crawl the web searching job opportunities that match a user profile (skillset, location/remote opportunity, etc)
and summarize it in a web page. I might add some funcionalities later, like word recognition, so it can do an action automatically or uppon a button click (e.g "email" => Send Email).
By now, this is just an Laravel Application with JWT Authentication.
  
Installation
-----------
1. Clone this repository:
   ```
   git clone https://github.com/donburgareli/wiseapplier.git
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. Setup Docker MySQL, phpMyAdmin and Database:
   ```
   docker build .
   docker-compose up -d
   ```
   phpMyAdmin will be on localhost:1337, be sure to change .env.example to .env and fill database details before running this, it would be used to create the database.

4. Run the artisan server.
   ```
   php artisan serve
   ```

Contributing
-----------
Contributions are welcome! Here's how you can contribute:
- Fork the repository
- Create your feature branch (`git checkout -b feature/YourFeature`)
- Commit your changes (`git commit -am 'Add some feature'`)
- Push to the branch (`git push origin feature/YourFeature`)
- Create a new Pull Request

License
-----------

MIT License
