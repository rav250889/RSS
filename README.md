<html>
<body>
  <h1>RSS Apliccation</h1>
  <p><b>Create database in MySQL</b></p>
  <p>create database "any name";</p><br>
  <p><b>Create table rss with columns "id, user, fees, title, link" in your database</b></p>
  <p>create table rss (id serial PRIMARY KEY, user VARCHAR(50), feed VARCHAR(100), title VARCHAR(200), link VARCHAR(200);</p><br>
  <p><b>Change your database connection in file "connection.php</b></p>
  <p>$connection = mysqli_connect("your server address", " your user name", "your password", "your database name");
</body>
</html>
