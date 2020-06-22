<html>
<body>
  <h1>RSS Application</h1>
  <p><b>Create database in MySQL</b></p>
  <p>create database "any name";</p><br>
  <p><b>Create table rss with columns "id, user, feed, title, link" in your database</b></p>
  <p>create table rss (id serial PRIMARY KEY, user VARCHAR(50), feed VARCHAR(100), title VARCHAR(200), link VARCHAR(200);</p><br>
  <p><b>Create table send with column "api" and generate your sendgrid api key (www.sendgrid.com). Now you must putin your key to api column</b></p>
  <p>create table send (api VARCHAR(500));</p>
  <p>INSERT INTO `send`(`api`) VALUES ("your api key");</p>
  <p><b>Change your database connection in file "connection.php"</b></p>
  <p>$connection = mysqli_connect("your server address", " your user name", "your password", "your database name");
</body>
</html>
